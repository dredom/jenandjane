<?php
/*
 * Test cases for ProductDataManager.
 */

include 'base.test.php';

// Setup
include '../../init.php';
include DOCPATH.'jewel/DbManager.class.php';
include DOCPATH.'jewel/ProductDataManager.class.php';

// INSERT INTO product VALUES(1,'a',1,'qtz','ss',now());

test('updatePrice');
test('getNextOptionSeq');
test('insertProductOption');
test('getProductOption');
test('getProductOptionNotFound');
test('getItem');
test('getProduct');
test('getProductNotFound');
//test('temp');

function temp() {
	include DOCPATH.'mdl/db/Db.class.php';
	$dbm = Db::factory();
	$pdo = $dbm->getPdo();
	$sql = 'INSERT INTO temp SET optiontype = :option ;';
	$stmt = $pdo->prepare($sql);
	$option = 'blah blah';
	$stmt->bindParam(':option', $option);
	$success = $stmt->execute();
	echo " $success \n";
}
function getProduct() {
	$code = 'b300-shl-ss';
	$mgr = new ProductDataManager;
	$product = $mgr->getProductByCode($code);
	assert('$product->id !== null');
}
function getProductNotFound() {
	$code = 'b300-xxx-yy';
	$mgr = new ProductDataManager;
	try {
		$product = $mgr->getProductByCode($code);
		assert('$product === true');
	} catch (Exception $e) {
		// expected
	}
}
function updatePrice() {
	$id = 116;
	$seq = 0;
	$price = 123.00;
	$value = '18"';
	$mgr = new ProductDataManager;
	$data = new ProductOption();
	$data->productid = $id;
	$data->seq = $seq;
	$data->price = $price;
	$data->optiontype = 'length';
	$data->value = $value;
	$mgr->updatePrice($data);
	
	$po = $mgr->getProductOption($id, $seq);
	assert('$po != null');
	assert('$po->productid == $id');
	assert('$po->seq == $seq');
	assert('$po->price == $price');
	assert('$po->optiontype == "length"');
	assert('$po->value == $value');
}
function getProductOption() {
	$id = 1;
	$seq = 1;
	$mgr = new ProductDataManager;
	$data = $mgr->getProductOption($id, $seq);
	//var_dump($data);
	assert('$data != null');
	assert('$data->productid == $id');
	assert('$data->seq == $seq');
}
function getProductOptionNotFound() {
	$id = 1;
	$seq = 9999;
	$mgr = new ProductDataManager;
	$data = $mgr->getProductOption($id, $seq);
	//var_dump($data);
	assert('$data == null');
}
function insertProductOption() {
	$id = 1;
	$price = 123.00;
	$mgr = new ProductDataManager;
	$seq = $mgr->getNextOptionSeq($id);
	$data = new ProductOption();
	$data->productid = $id;
	$data->seq = $seq;
	$data->price = $price;
	$success = $mgr->insertProductOption($data);
	assert('$success === true');
	
	$po = $mgr->getProductOption($id, $seq);
	assert('$po != null');
	assert('$po->productid == $id');
	assert('$po->seq == $seq');
	assert('$po->price == $price');
	assert('$po->optiontype == null');
	assert('$po->value == null');
}
function getNextOptionSeq() {
	$id = 1;
	$mgr = new ProductDataManager;
	$seq = $mgr->getNextOptionSeq($id);
	assert('is_int($seq)');	
}
function getItem() {
	$id = 100;
	$mgr = new ProductDataManager;
	$data = $mgr->getItem($id);
	//var_dump($data);
	assert('$data != null');
	assert('$data instanceof ItemView');
	assert('$data->id == $id');
	assert('$data->code != null');
	assert('$data->options != null');
	$options = $data->options;
	assert('count($options) > 0');
	$option = $options[0];
	assert('$option instanceof ProductOption');
	assert('$option->price != null');
	assert('$option->price > 10');
}

?>