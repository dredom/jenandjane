<?php
/*
 * Verify the order details against db.
 * Send Jane an email with order details or hacker alert.
 * 2009-06
 */
 require DOCPATH.'jewel/DbManager.class.php';
 require DOCPATH.'jewel/ProductDataManager.class.php';
 require DOCPATH.'jewel/ShoppingController.class.php';

 function execTransaction($site, $function) {
 	
	 Logger::info('start process_paypal_order.tran...');
	 try {
		 $controller = new ShoppingController();
		 $controller->site = $site;
		 $controller->function = $function;
		 $controller->productDataManager = new ProductDataManager();
		 
		 $template = $controller->handle();
		 
	 } catch (Exception $e) {
	 	Logger::error(__FILE__ . $e->getMessage());
	 	return;
	 }
	 
	 Logger::info('After controller->handle...');
	 
	 if ($controller->status == 'success') {
	 	// redirect output to a buffer
		ob_start(); 	
	 	$template->show('jewel/email/pp_cart');
	 	$body = ob_get_clean();
	 	
 		$email = $template->test_ipn == '1' ? shop_email_test_to : shop_email_to;
 		$email = "untiedt@gmail.com";
	 	
	 	$headers = 'From: '.shop_email_from. "\r\n" .
    	'Reply-To: '.shop_email_from . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
	 	
	 	// TODO $subject built like body
	 	$subject = "JJ PayPal $template->txn_type Transaction: $template->first_name $template->last_name";
	 	Logger::info("PayPal email being sent to $email");
	 	mail($email, $subject, $body . "\n\n", $headers );
	 	
	 	Logger::info("Emailed Paypal order to $email: $subject");
	 	
	 	
	 } else {
	 	Logger::error("PayPal $site $function processing error");
	 	return;
	 }
	
 } 
?>