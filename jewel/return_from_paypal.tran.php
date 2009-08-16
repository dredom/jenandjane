<?php
/*
 * Return from Paypal shopping cart.
 * Show Thank You page and redirect to purchase page.
 * 2009-07
 */
 
 function execTransaction($site, $function) {
 	
 	//echo ' start_tran ';
	$template = new Template();	 
	$req = '';
 	foreach ($_REQUEST as $key => $value) {
		$req .= "&$key=$value";
 	}
 	Logger::info("Return from PayPal checkout: " . $req);
 	
 	Cacher::delete('is_cart');
 	
 	$cf = (isset($_REQUEST['cf'])) ? $_REQUEST['cf'] : "/";
 	$template->cf = $cf; 
 	
	$template->show('shop/thank-you-for-purchase');
	 
 } 
?>
