<?php
/*
 * Verify the order details against db.
 * Send Jane an email with order details or hacker alert.
 * 2009-06
 */
 require DOCPATH.'jewel/ProductController.class.php';	// ??
 require DOCPATH.'jewel/DbManager.class.php';
 require DOCPATH.'jewel/ProductDataManager.class.php';
 
 function execTransaction($site, $function) {
 	
 	//echo ' start_tran ';
	 try {
		 $controller = new ProductController();
		 $controller->site = $site;
		 $controller->function = $function;
		 $controller->productDataManager = new ProductDataManager();
		 
		 $template = $controller->handle();
		 
	 } catch (Exception $e) {
	 	Logger::error(__FILE__ . $e->getMessage());
	 	return;
	 }
	 
	 if ($controller->status == 'success') {
	 	// redirect output to a buffer
		ob_start(); 	
	 	$template->show('jewel/email/pp_cart');
	 	$body = ob_get_clean();
	 	
 		$email = $template->test_ipn == '1' ? shop_email_test_to : shop_email_to;
	 	//$email = shop_email_to;
	 	//$email = 'untiedt@gmail.com';	// TESTING
	 	
	 	$headers = 'From: '.shop_email_from. "\r\n" .
    	'Reply-To: '.shop_email_from . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
	 	
	 	// TODO $subject built like body
	 	$subject = "JJ PayPal $template->txn_type Transaction: $template->first_name $template->last_name";
	 	Logger::info("PayPal email being sent to $email");
	 	mail($email, $subject, $body . "\n\n", $headers );
	 	
	 	
	 } else {
	 	Logger::error("PayPal $function processing error");
	 	return;
	 }
	
 } 
?>
