<?php
/* Email subject and body - caller must capture with ob_start() */
	$subject = "JJ PayPal $txnType Transaction: $first_name $last_name";
	// format $emailtext from transaction
	echo " We have a new order through PayPal! \n\n";
	echo "$first_name $last_name, $payer_email, $contact_phone \t ($payer_status) \n";
	echo " Currency:            ", $mc_currency, "\n";
	echo " Full payment amount: ", number_format($mc_gross, 2), " \n";
	echo " Shipping:            ", number_format($mc_shipping, 2), "\n";
	echo " Transaction fee:     ", number_format($mc_fee, 2), " \n";
	echo "\n";
	echo "Ship To: \t ($address_status) \n";
	echo " $address_name \n";
	echo " $address_street \n";
	echo " $address_city, $address_state $address_zip \n";
	echo "\n";
	echo "Customer note: \n";
	echo $memo, "\n";
	echo "\n";
	echo "Order: \n";
	for ($i = 1; $i <= $num_cart_items; $i++) {
		$gross = ${'mc_gross_'.$i};
		$ship = ${'mc_shipping'.$i};
		echo "$i. ${'quantity'.$i} x ${'item_number'.$i} ${'item_name'.$i}  \n ";
		echo "   ${'option_name'.$i}   ${'option_selection'.$i} ", 
				'  Gross: $', number_format($gross, 2), 
				'  Shipping: $', number_format($ship, 2), "\n\n";
	}
?>