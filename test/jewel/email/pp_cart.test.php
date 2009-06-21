<?php
/*
 * Test cases for ShowDataManager.
 */

include '../base.test.php';

// Setup
include '../../../init.php';

test('send1');

function send1() {
	$txnType = "cart";
	$first_name = "Joanne";
	$last_name = "Penchant";
	$payer_email = "jo@penchant.net";
	$contact_phone = '206-123-4567';
	$payer_status = "confirmed";
	$mc_currency = "USD";
	$mc_gross = 171.09;
	$mc_shipping = 0.00;
	$mc_fee = 5.09;
	$mc_shipping = 0.00;
	$address_status = "confirmed";
	$address_name = "Joanne Penchant";
	$address_street = "2320 Harmony Rd";
	$address_city = "La Crescenta";
	$address_state = "CA";
	$address_zip = "91242";
	$address_country = "USA";
	$memo = "Can't wait!";
	$num_cart_items = 1;
	$quantity1 = 1;
	$item_number1 = "n003-qtz-14k";
	$item_name1 = "Necklace: Pearls on silk...";
	$mc_gross_1 = 165.00;
	$mc_shipping1 = 11.00;
	$option_name1 = 'length';
	$option_selection1 = '18"';
	
	$key = 19600324;
	$email = "untiedt@gmail.com";
	
	ob_start();
	include DOCPATH.'vw/jewel/email/pp_cart.php';
	$body = ob_get_clean();
	echo $subject;
	echo $body;
}



?>