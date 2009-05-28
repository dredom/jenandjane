<?php
error_reporting(E_ALL ^ E_NOTICE);
$email = $_GET['ipn_email'];
$header = "";
$emailtext = "";
// Read the post from PayPal and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
	// Handle escape characters, which depends on setting of magic quotes
	$value = urlencode($value);
	$req .= "&$key=$value";
}
// Post back to PayPal to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
// Process validation from PayPal
if (!$fp) { // HTTP ERROR
} else {
	// NO HTTP ERROR
	fputs ($fp, $header . $req);
	while (!feof($fp)) {
		$res = fgets ($fp, 1024);
		if (strcmp ($res, "VERIFIED") == 0) {
			// TODO:
			// Check the payment_status is Completed
			// Check that txn_id has not been previously processed
			// Check that receiver_email is your Primary PayPal email
			// Check that payment_amount/payment_currency are correct
			// Process payment
			// If 'VERIFIED', send an email of IPN variables and values to the
			// specified email address
			foreach ($_POST as $key => $value){
				$emailtext .= $key . " = " .$value ."\n\n";
			}
			mail($email, "Live-VERIFIED IPN", $emailtext . "\n\n" . $req);
		} else if (strcmp ($res, "INVALID") == 0) {
			// If 'INVALID', send an email. TODO: Log for manual investigation.
			foreach ($_POST as $key => $value){
				$emailtext .= $key . " = " .$value ."\n\n";
			}
			mail($email, "Live-INVALID IPN", $emailtext . "\n\n" . $req);
		}
	}
}
fclose ($fp);
?>