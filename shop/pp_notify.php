<?php
 require '../init.php';
 // Read the post from PayPal and add 'cmd'
 $req = 'cmd=_notify-validate';
 foreach ($_POST as $key => $value) {
	// Handle escape characters, which depends on setting of magic quotes
	$value = urlencode($value);
	$req .= "&$key=$value";
 }
 $txnType = $_POST['txn_type'];
 Logger::info("pp_notify[{$txnType}] $req");
 $test_ipn = $_POST['test_ipn'];
  $sandbox = $test_ipn == '1' ? 'sandbox.' : '';
 
// Post back to PayPal to validate
 $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
 $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
 $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
 $fp = fsockopen ("www.{$sandbox}paypal.com", 80, $errno, $errstr, 30);
// Process validation from PayPal
 if (!$fp) { // HTTP ERROR
	Logger::error("pp_notify[{$txnType}] HTTP Error $errno $errstr");
	fclose ($fp);
	return;
 }
 // NO HTTP ERROR
 fputs ($fp, $header . $req);
 while (!feof($fp)) {
 	$res = fgets ($fp, 1024);
 }
 fclose ($fp);

 $email = $test_ipn == '1' ? shop_email_to_test : shop_email_to;
 
 if (strcmp ($res, "VERIFIED") != 0) {
	Logger::error("pp_notify[{$txnType}] Invalid $res");
	// TODO email failure 
 	return;
 }
 
 // Verified
 Logger::info("pp_notify[$txnType] $res");
 
 require DOCPATH.'jewel/process_paypal_order.tran.php';
 
 switch ($txnType) {
 	
 	case 'cart':
 		// verify price
 		// email jane
 		// write to orders db?
 		execTransaction('shop', 'processOrder');
 		break;
 		
 	default:
 		// email this
		foreach ($_POST as $key => $value){
			$emailtext .= $key . " = " .$value ."\n\n";
		}
		mail($email, "JJ PayPal $txnType Transaction", $emailtext . "\n\n" );
 }
?>