<?php
if (ENV == 'development') {
	define('shop_email_to', 'untiedt@gmail.com');
	define('shop_biz_email', 'untied_1238972877_biz@gmail.com');
	define('shop_paypal_sandbox', 'sandbox.');	// www.sandbox.paypal.com
} else {	// production
	define('shop_email_to', 'jane@jenandjane.com');
	//define('shop_biz_email', 'jane@jenandjane.com');
	define('shop_biz_email', 'untied_1238972877_biz@gmail.com'); // testing
	//define('shop_paypal_sandbox', '');
	define('shop_paypal_sandbox', 'sandbox.');	// testing
}
define('shop_email_fail_to', 'untiedt@live.com');
define('shop_email_from', 'paypal@jenandjane.com');
define('shop_shipping_fee', 8.00);
define('shop_email_to_test', 'untiedt@gmail.com');
?>