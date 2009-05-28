<?php
 require '../init.php';
 Logger::info("pp_notify from PayPal: " . $_SERVER['REMOTE_ADDR']);
 // Read the post from PayPal and add 'cmd'
 $req = 'cmd=_notify-validate';
 foreach ($_POST as $key => $value) {
	// Handle escape characters, which depends on setting of magic quotes
	$value = urlencode($value);
	$req .= "&$key=$value";
 }
 $txnType = $_POST['txn_type'];
 $custom = $_POST['custom'];
 Logger::info("pp_notify[{$txnType}] $req");
  $sandbox = $custom == 'development' ? 'sandbox.' : '';
 
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
 
 if (strcmp ($res, "VERIFIED") != 0) {
	Logger::error("pp_notify[{$txnType}] Invalid $res");
	// TODO email failure 
 	return;
 }
 
 // Verified
 Logger::info("pp_notify[$txnType] $res");
 
 $email = 'untiedt@live.com';
 switch ($txnType) {
 	
 	case 'cart':
 		// verify price
 		// email jane
 		// write to orders db?
 		break;
 		
 	default:
 		// email this
		foreach ($_POST as $key => $value){
			$emailtext .= $key . " = " .$value ."\n\n";
		}
		mail($email, "JJ PayPal $txnType Transaction", $emailtext . "\n\n" );
 }
?>