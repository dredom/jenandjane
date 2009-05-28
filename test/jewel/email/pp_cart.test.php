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
	$payer_status = "confirmed";
	$payment_gross = 165.00;
	$mc_shipping = 0.00;
	$mc_fee = 5.09;
	$mc_shipping = 0.00;
	$address_status = "confirmed";
	$address_name = "Joanne Penchant";
	$address_street = "2320 Harmony Rd";
	$address_city = "La Crescenta";
	$address_state = "CA";
	$address_zip = "91242";
	$num_cart_items = 1;
	$item_number1 = "n003-qtz-14k";
	$item_name1 = "Necklace";
	$mc_gross_1 = 165.00;
	$tax1 = 6.25;
	$mc_shipping1 = 0.00;
	
	$key = 19600324;
	$email = "untiedt@gmail.com";
	
	include DOCPATH.'vw/jewel/email/pp_cart.php';
}



?>