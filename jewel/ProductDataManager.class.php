<?php
/**
 * Manages the data updates for product	 description, price.
 * 2009-01
 */
class ProductDataManager extends DbManager {
	const VERSION = '1';

	const SQL_SELECT_PRODUCT_BY_CODE = 'sqlprod1';
	const sqlprod1 = 'SELECT id, category, style, type, material
		from product
		where category = :category
		  and style    = :style
		  and type     = :type
		  and material = :material; ';
	
	// productdata
	
	const SQL_SELECT_PRODUCTDATA = 'sql1'; 
	const sql1 =
		'SELECT pd.productid
 		   FROM productdata pd
		  WHERE pd.productid = :productid ';
	
	const SQL_INSERT_PRODUCTDATA = 'sql2';
	const sql2 =
		'INSERT INTO productdata (
			productid,
			description,
			created
		) VALUES (
			:productid,
			:description,
			now()
		); ';
	
	const SQL_UPDATE_DECRIPTION = 'sql3';
	const sql3 =
		'UPDATE productdata
		    SET description = :description
		  WHERE productid   = :productid ;';

	// productoption
	
	const SQL_SELECT_PRODUCTOPTION = 'sql4';
	const sql4 =
		'SELECT *
 		   FROM productoption po
		  WHERE po.productid = :productid
		    AND po.seq       = :seq ';

	const SQL_SELECT_PRODUCTOPTIONS = 'sql5';
	const sql5 =
		'SELECT *
 		   FROM productoption po
		  WHERE po.productid = :productid ';

	const SQL_SELECT_MAX_PRODUCTOPTION_SEQ = 'sql6';
	const sql6 =
		'SELECT MAX(po.seq)
 		   FROM productoption po
		  WHERE po.productid = :productid ';
	
	
	const SQL_INSERT_PRODUCTOPTION = 'sql7';
	const sql7 =
		'INSERT INTO productoption SET
			productid = :productid,
			seq       = :seq,
			optiontype = :optiontype,
			value     = :value,
			price     = :price,
			created   = NOW(); ';
	
	const SQL_UPDATE_PRICE = 'sql8';
	const sql8 =
		'UPDATE productoption
		    SET price      = :price,
		        optiontype = :optiontype,
		        value      = :value
		  WHERE productid  = :productid 
		    AND seq        = :seq  ;';
	
	const SQL_DELETE_PRODUCTOPTION = 'sql9';
	const sql9 =
		'DELETE FROM productoption
		  WHERE productid  = :productid 
		    AND seq        = :seq  ;';
	
	const SQL_SELECT_PRODUCT_DESCRIPTION = 'sqlv1';
	const sqlv1 =
		'SELECT pc.id, pc.code, pd.description
  		   FROM productcode pc
  		   LEFT OUTER JOIN productdata pd
    	     ON pd.productid = pc.id
 		  WHERE pc.id        = :productid ;';
	
	/**
	 * @param $productcode
	 * @return Product
	 */
	public function getProductByCode($productcode) {
	 	$category = substr($productcode, 0, 1);
	 	$i = strpos($productcode, '-', 1) + 1;
	 	$style = substr($productcode, 1, $i - 2);
	 	$j = strpos($productcode, '-', $i) + 1;
	 	$type = substr($productcode, $i, $j - 1 - $i);
	 	$material = substr($productcode, $j);
		$stmt = $this->getSqlStatement(self::SQL_SELECT_PRODUCT_BY_CODE);
		$stmt->bindParam(':category', $category, PDO::PARAM_STR);
		$stmt->bindParam(':style',    $style, PDO::PARAM_STR);
		$stmt->bindParam(':type',     $type, PDO::PARAM_STR);
		$stmt->bindParam(':material', $material, PDO::PARAM_STR);
		$success = $stmt->execute();
		if (!$success) {
			$msg = $stmt->errorInfo();
			throw new Exception("Select product[$productcode] failed: $msg", $stmt->errorCode());
		}
		$product = $stmt->fetchObject('Product');
		if (!$product) {
			throw new Exception("Product[$productcode] not found");
		}
		$stmt->closeCursor();
		return $product;
	}

	public function updateDescription(ProductData $data) {
		// Exist?
		$stmt = $this->getSqlStatement(self::SQL_SELECT_PRODUCTDATA);
		$stmt->bindParam(':productid', $data->productid, PDO::PARAM_INT);
		$success = $stmt->execute();
		if ($success) {
			$result = $stmt->fetch();
			$stmt->closeCursor();
			if (!$result) {
				// Insert
				$this->insertProductData($data);
			} else {
				// Update
				$this->updateProductDescription($data);
			}
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Select productdata[$data->productid] failed: $msg", $stmt->errorCode());
		}
	}
	
	private function updateProductDescription(ProductData &$data) {
		$stmt = $this->getSqlStatement(self::SQL_UPDATE_DECRIPTION);
		$stmt->bindParam(':productid', $data->productid, PDO::PARAM_INT);
		$stmt->bindParam(':description', $data->description);
		$success = $stmt->execute();
		if ($success) {
			return true;
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Update productdata failed: $msg", $stmt->errorCode());
		}
	}
	private function insertProductData(ProductData &$data) {
		$stmt = $this->getSqlStatement(self::SQL_INSERT_PRODUCTDATA);
		$stmt->bindParam(':productid', $data->productid, PDO::PARAM_INT);
		$stmt->bindParam(':description', $data->description);
		$success = $stmt->execute();
		if ($success) {
			return true;
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Insert productdata failed: $msg", $stmt->errorCode());
		}
	}
			
	public function updatePrice(ProductOption &$data) {
		// Exist?
		// execute() resets its bound vars to String, so externalize int values.
		$id = $data->productid;
		$seq = $data->seq;
		$productOption = $this->getProductOption($id, $seq);
		if ($productOption == null) {
			//echo ' insert ';
			$this->insertProductOption($data);
		} else {				
			//echo ' update ';
			$this->updateProductPrice($data);
		}
	}

	public function getProductOptions($productid) {
		$stmt = $this->getSqlStatement(self::SQL_SELECT_PRODUCTOPTIONS);
		$stmt->bindParam(':productid', $productid, PDO::PARAM_INT);
		$success = $stmt->execute();
		if ($success) {
			$productOption = $stmt->fetchObject('ProductOption');
			while ($productOption != null) {
				$list[]= $productOption;
				$productOption = $stmt->fetchObject('ProductOption');
			}
			$stmt->closeCursor();
			return $list;
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Get productoptions failed: $msg", $stmt->errorCode());
		}
	}

	/**
	 * @param $productid
	 * @param $seq
	 * @return ProductOption
	 */
	public function getProductOption($productid, $seq) {
		//$stmt = $this->getStmtSelectProductOption();
		$stmt = $this->getSqlStatement(self::SQL_SELECT_PRODUCTOPTION);
		$stmt->bindParam(':productid', $productid, PDO::PARAM_INT);
		$stmt->bindParam(':seq', $seq, PDO::PARAM_INT);
		$success = $stmt->execute();
		if ($success) {
			$productOption = $stmt->fetchObject('ProductOption');
			$stmt->closeCursor();
			return $productOption;
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Get productoption failed: $msg", $stmt->errorCode());
		}
	}
		
	private function updateProductPrice(ProductOption &$data) {
		$stmt = $this->getSqlStatement(self::SQL_UPDATE_PRICE);
		$stmt->bindParam(':productid', $data->productid, PDO::PARAM_INT);
		$stmt->bindParam(':seq', $data->seq, PDO::PARAM_INT);
		$stmt->bindParam(':optiontype', $data->optiontype);
		$stmt->bindParam(':value', $data->value);
		$stmt->bindParam(':price', $data->price);
		$success = $stmt->execute();
		if ($success) {
			return true;
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Update productoption failed: $msg", $stmt->errorCode());
		}
	}
	
	public function deleteProductOption(ProductOption &$data) {
		$stmt = $this->getSqlStatement(self::SQL_DELETE_PRODUCTOPTION);
		$stmt->bindParam(':productid', $data->productid, PDO::PARAM_INT);
		$stmt->bindParam(':seq', $data->seq, PDO::PARAM_INT);
		$success = $stmt->execute();
		if ($success) {
			return true;
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Delete productoption failed: $msg", $stmt->errorCode());
		}
	}

	public function insertProductOption(ProductOption &$data) {
		$stmt = $this->getSqlStatement(self::SQL_INSERT_PRODUCTOPTION);
		$stmt->bindParam(':productid', $data->productid, PDO::PARAM_INT);
		$stmt->bindParam(':seq', $data->seq, PDO::PARAM_INT);
		$stmt->bindParam(':optiontype', $data->optiontype);
		$stmt->bindParam(':value', $data->value);
		$stmt->bindParam(':price', $data->price);
		$success = $stmt->execute();
		if ($success) {
			return true;
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Insert productoption failed: $msg", $stmt->errorCode());
		}
	}
	
	public function getNextOptionSeq($id) {
		$stmt = $this->getSqlStatement(self::SQL_SELECT_MAX_PRODUCTOPTION_SEQ);
		$stmt->bindParam(':productid', $id, PDO::PARAM_INT);
		$success = $stmt->execute();
		if ($success) {
			$result = $stmt->fetchColumn();
			$stmt->closeCursor();
			if ($result === false) {
				return 0;
			} else {				
				$seq = (int) $result;
				$seq++;
				return $seq;
			}
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Select productoption max failed: $msg", $stmt->errorCode());
		}
	}

	/**
	 * @param $id
	 * @return ItemView
	 */
	public function getItem($id) {
		$stmt = $this->getSqlStatement(self::SQL_SELECT_PRODUCT_DESCRIPTION);
		$stmt->bindParam(':productid', $id, PDO::PARAM_INT);
		$success = $stmt->execute();
		if ($success) {
			$item = $stmt->fetchObject('ItemView');
			$stmt->closeCursor();
		} else {
			$msg = $stmt->errorInfo();
			throw new Exception("Get item failed: $msg", $stmt->errorCode());
		}
		$options = $this->getProductOptions($id);
		$item->options = $options;
		return $item;
	}
}
?>