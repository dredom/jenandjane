<?php
/*
 * Convert images.config to db product rows.
 */
require '../init.php';
$filename = DOCPATH.'jewel/'.$site.'/images.config';
echo "Start of description/price conversion for $filename...<br>\n";
$lines = file($filename);
include DOCPATH.'mdl/db/Db.class.php';
$pdo = Db::factory()->getPdo();
$drv = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME );
echo $drv . " <br>";
$sqlget = 'SELECT id
	from product
	where category = :category
	  and style = :style
	  and type = :type
	  and material = :material; ';
$stmtget = $pdo->prepare($sqlget);
$sql = 'INSERT into productdata (
	productid,
	description,
	created
	) values(
	:productid,
	:description,
	now()
	); ';
$stmt = $pdo->prepare($sql);
$sqlpo = 'INSERT into productoption (
	productid,
	price,
	created
	) values(
	:productid,
	:price,
	now()
	); ';
$stmtpo = $pdo->prepare($sqlpo);
$count = 0;
$countPrice = 0;
foreach ($lines as $line) {
   	$line = trim($line);
    echo " processing $line <br>\n";
    $i = strpos($line, ' ');
	if ($i) {
		$item = substr($line, 0, $i);
		$id = (int) substr($line, $i);
	} else {
		$item = $line;
		$id = null;
	}
    
    $product = makeProduct($item);
//	try {
//		$id = getProductId($product);
//	} catch (PDOException $e) {
//		echo "$line:". $e->getMessage() ."<br>\n";
//		continue;
//	}
	echo "\t productid[$id] ";
	$description = getDescription($item);
	//echo "\t descr[$description] \n";
	$dparray = separatePriceAndDescription($description);
	echo "\t price[$dparray[1]] \t descr[$dparray[0]] <br>\n";
	
	try {
		
		insertDescription($id, $dparray[0]);
		
		insertPrice($id, $dparray[1]);
	
	} catch (Exception $e) {
		echo "Failed to write db: $e";
	}
}
echo "Inserted $count productdata rows. \n";
echo "Inserted $countPrice productoption rows. \n";


function makeProduct($productcode) {
	$product = new Product();
 	$product->category = substr($productcode, 0, 1);
 	$i = strpos($productcode, '-', 1) + 1;
 	$product->style = substr($productcode, 1, $i - 2);
 	$j = strpos($productcode, '-', $i) + 1;
 	$product->type = substr($productcode, $i, $j - 1 - $i);
 	$product->material = substr($productcode, $j);
	return $product;
}

function getProductId($product) {
	global $stmtget;
	$stmtget->bindParam(':category', $product->category, PDO::PARAM_STR);
	$stmtget->bindParam(':style', $product->style, PDO::PARAM_INT);
	$stmtget->bindParam(':type', $product->type, PDO::PARAM_STR);
	$stmtget->bindParam(':material', $product->material, PDO::PARAM_STR);
	$success = $stmtget->execute();
	if ($success) {
		$result = $stmtget->fetchColumn();
		$stmtget->closeCursor();
		return $result;
	} else {
         echo "Get product failed on $product->category : $product->style - $product->type - $product->material \n";
	}
}

function getDescription($productcode) {
    $file = DOCPATH.'img/'.$productcode.'.txt';
//    echo " \t processing $file ... \n";
    $text = "";
    if (file_exists($file)) {
    	// read the file and return the text
      	$lines = file($file);
      	foreach ($lines as $line) {
         	$text .= $line.' ';
      	}
      	return $text;
    } else {
		return null;
    }
}

function separatePriceAndDescription($description) {
	if ($description == null || $description == '')
		return array($description, null);
	$wdarray = str_word_count($description, 2, '$0123456789.');
	//var_dump($wdarray);
	$word = end($wdarray);
	$offset = key($wdarray);
	while (true) {
		//echo "\t offset[$offset] word[$word] \n";
		$word = trim($word);
		if ($word == '') {
			$wd = prev($wdarray);
			continue;
		}
		break;
	}

	if (substr($word, 0, 1) == '$') {
		$price = (float) substr($word, 1);
		$description2 = trim(substr($description, 0, $offset));
		return array($description2, $price);
	}
	return array($description, null);
}

function insertDescription($productId, $description) {
	if ($description == null || $description == '')
		return;
	global $stmt, $count;
	echo " binding ";
	$stmt->bindParam(':productid', $productId, PDO::PARAM_INT);
	$stmt->bindParam(':description', $description, PDO::PARAM_STR);
	echo " bound. ";
	$success = $stmt->execute();
	echo " executed $success ";
	if ($success) {
		$count++;
	} else {
         echo "Insert productdata failed on $productId <br>\n";
	}
}

function insertPrice($productId, $price) {
	if ($price == null)
		return;
	global $stmtpo, $countPrice;
	$stmtpo->bindParam(':productid', $productId, PDO::PARAM_INT);
	$stmtpo->bindParam(':price',     $price);
	$success = $stmtpo->execute();
	if ($success) {
		$countPrice++;
	} else {
         echo "Insert productoption failed on $productId <br>\n";
	}
}

?>