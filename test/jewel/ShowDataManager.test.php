<?php
/*
 * Test cases for ShowDataManager.
 */

include 'base.test.php';

// Setup
include '../../init.php';
include DOCPATH.'jewel/DbManager.class.php';
include DOCPATH.'jewel/ShowDataManager.class.php';
include DOCPATH.'mdl/Item.class.php';


test('getShowItems');
test('populateItem');

function getShowItems() {
	$mgr = new ShowDataManager;
	$imagesConfig = DOCPATH.'jewel/ankle/images.config';
	$items = $mgr->getShowItems($imagesConfig);
	assert('$items != null');
	assert('sizeof($items) > 1');
	$item = $items[0];
	assert('$item->code != null');
	assert('\'a\' == substr($item->code, 0, 1)');
}

function populateItem() {
	$mgr = new ShowDataManager;
	$item = new Item(100, 'a301-prl-ss');
	$mgr->populateItem($item);
	assert('$item->description != null');
	assert('$item->options != null');
	$option = $item->options[0];
	assert('$option->price != null');
	assert('$option->price > 10');
}

?>