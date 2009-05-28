<?php
/*
 * Read items from a config file, create db product row if item has no id,
 * and create new config file with the id.
 * 2009-01
 */
class ConfigToProduct {
	private static $sqlinsert = 'INSERT into product (
		category,
		style,
		type,
		material
	) values(
		:category,
		:style,
		:type,
		:material
	); ';
	private $stmtinsert;
	
	private static $sqlselect = 'SELECT id
		from product
		where category = :category
		  and style = :style
		  and type = :type
		  and material = :material; ';
	private $stmtselect;
	
	private $pdo;

	private $file;
	
	public function load($file) {
		$filepath = DOCPATH.$file;
		echo "Start of registering new items in db for $filepath...<br>\n";
		$lines = file($filepath);
		try {
			if ($this->pdo == null) {
				include DOCPATH.'mdl/db/Db.class.php';
				$this->pdo = Db::factory()->getPdo();
			}
			$count = 0;
			$filechange = false;
			$newconfig = '';
			foreach ($lines as $line) {
				$data = $this->doLine($line);
				if ($data != null) {
					$newconfig .= $data->item . ' ' . $data->id . "\r\n";
				}
				if ($data->change) {
					$filechange = true;
					if ($data->insert) {
						$count++;
					}
				}
			}
			echo "<br>\n";
			// Create updated config file?
			if ($filechange) {
				$newfile = $filepath.'.new';
				if (file_exists($newfile)) {
					unlink($newfile);
				}
				//echo $newconfig;
				$bytes = file_put_contents($newfile, $newconfig);
				// Rename
				$savefile = $filepath.'.old';
				if (file_exists($savefile)) {
					unlink($savefile);
				}
				echo "Saving old config as $savefile <br>\n";
				rename($filepath, $savefile);
				echo "Updating config $filepath <br>\n";
				rename($newfile, $filepath);
			}
			return $count;
			
		} catch (PDOException $e) {
			echo " DB failure: $e <br>\n";
			Logger::error('ConfigToProduct: '.$e->getMessage());
		}
	}
	
	private function doLine($line) {
	   	$line = trim($line);
	    echo " [$line] ";
	    
	    // Get item, id from line
	    
		$data = $this->getLineItem($line);
		$data->change = false;
		$data->insert = false;
		// If already has id, return   
		if ($data->id) 
			return $data;
			 
		$data->change = true;
		
		// Check if item exists in db
	    $product = $this->makeProduct($data->item);
		$id = $this->getProductId($product);
		if ($id != null) {
			$data->id = $id;
			return $data;
		}
		// Does not exist - insert in db
		try {
			$product = $this->insertProductRow($product);
			$data->id = $product->id;
			$data->insert = true;
			return $data;
		} catch (PDOException $e) {
			$msg = " $line: ". $e->getMessage();
			echo "\n $msg <br>\n";
			Logger::error(__CLASS__.$msg);
		}
		return null;
	}

	private function getLineItem($line) {
	   	$data = new Context;
	    // Get item, id from line
    	$i = strpos($line, ' ');
		if ($i) {
			$data->item = substr($line, 0, $i);
			$data->id = (int) substr($line, $i);
		} else {
			$data->item = $line;
			$data->id = null;
		}
		return $data;
	}
	
	private function makeProduct($productcode) {
		$product = new Product();
	 	$product->category = substr($productcode, 0, 1);
	 	$i = strpos($productcode, '-', 1) + 1;
	 	$product->style = substr($productcode, 1, $i - 2);
	 	$j = strpos($productcode, '-', $i) + 1;
	 	$product->type = substr($productcode, $i, $j - 1 - $i);
	 	$product->material = substr($productcode, $j);
		return $product;
	}
	
	private function getProductId($product) {
		$stmt = $this->getStmtSelect($this->pdo);
		$stmt->bindParam(':category', $product->category, PDO::PARAM_STR);
		$stmt->bindParam(':style', $product->style, PDO::PARAM_INT);
		$stmt->bindParam(':type', $product->type, PDO::PARAM_STR);
		$stmt->bindParam(':material', $product->material, PDO::PARAM_STR);
		$success = $stmt->execute();
		if ($success) {
			$result = $stmt->fetchColumn();
			$stmt->closeCursor();
			return $result;
		}
	    return null;
	}
	
	private function insertProductRow(&$product) {
		$stmt = $this->getStmtInsert($this->pdo);
		$stmt->bindParam(':category', $product->category, PDO::PARAM_STR);
		$stmt->bindParam(':style', $product->style, PDO::PARAM_INT);
		$stmt->bindParam(':type', $product->type, PDO::PARAM_STR);
		$stmt->bindParam(':material', $product->material, PDO::PARAM_STR);
		$success = $stmt->execute();
		
		if ($success) {
			$product->id = $this->pdo->lastInsertId();
			return $product;
		} 
         echo "Insert failed on $product->category : $product->style - $product->type - $product->material \n";
         return null;
	}
	private function getStmtInsert($pdo) {
		if (!$this->stmtinsert) {
			$this->stmtinsert = $pdo->prepare(self::$sqlinsert);
		}
		return $this->stmtinsert;		
	}
		
	private function getStmtSelect($pdo) {
		if (!$this->stmtselect) {
			$this->stmtselect = $pdo->prepare(self::$sqlselect);
		}
		return $this->stmtselect;		
	}
	
}
?>