<?php
/* Do not allow hacker to use this to send emails */
if ($key != 19600324) return;
//	$email = 'jane@jenandjane.com';
	$subject = "JJ PayPal $txnType Transaction: ";
	// format $emailtext from transaction
	$txt = '';
	$txt .= "$first_name $last_name, $payer_email \t ($payer_status) \n";
	$txt .= " $payment_gross  Shipping: $mc_shipping Fee: $mc_fee \n";
	$txt .= " Payment: $mc_shipping \n";
	$txt .= "\n";
	$txt .= "Ship To: \t ($address_status) \n";
	$txt .= " $address_name \n";
	$txt .= " $address_street \n";
	$txt .= " $address_city, $address_state $address_zip \n";
	$txt .= "\n";
	for ($i = 1; $i < $num_cart_items; $i++) {
		$txt .= "$i. ${'item_number'.$i} ${'item_name'.$i} ${'mc_gross_'.$i} \n ";
		$txt .= "  Tax: ${'tax'.$i}  Shipping: ${'mc_shipping'.$i} \n\n";
	}
	$headers = 'From: andre@jenandjane.com' . "\r\n" .
    	'Reply-To: andre@jenandjane.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
	mail($email, $subject, $txt . "\n\n", $headers );
?>