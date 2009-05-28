<?php
/*
 * Convert images.config to db product rows.
 * @deprecated by register_new_ankle_items.php
 */
require '../init.php';
$filename = DOCPATH.'jewel/arm/images.config';
echo "Start of conversion for $filename...<br>\n";
$lines = file($filename);
include DOCPATH.'mdl/db/Db.class.php';
$pdo = Db::factory()->getPdo();
$sql = 'INSERT into product (
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
$stmt = $pdo->prepare($sql);
$count = 0;
foreach ($lines as $line) {
   	$line = trim($line);
    echo " processing $line <br>\n";
    $product = makeProduct($line);
	try {
		insertProductRow($product);
	} catch (PDOException $e) {
		echo "$line:". $e->getMessage() ."<br>\n";
	}
}
echo "Inserted $count rows. \n";

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

function insertProductRow($product) {
	global $stmt, $count;
	$stmt->bindParam(':category', $product->category, PDO::PARAM_STR);
	$stmt->bindParam(':style', $product->style, PDO::PARAM_INT);
	$stmt->bindParam(':type', $product->type, PDO::PARAM_STR);
	$stmt->bindParam(':material', $product->material, PDO::PARAM_STR);
	$success = $stmt->execute();
	if ($success) {
		$count++;
	} else {
         echo "Insert stats failed on $product->category : $product->style - $product->type - $product->material \n";
	}
}
?>