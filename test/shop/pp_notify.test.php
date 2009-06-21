<?php
/**
 * Accept POST input from a test html form.
 * Bypass the verify-with-paypal.
 * Run process_paypal_order.tran.php
 */
 require '../../init.php';
 require DOCPATH.'shop/shop.config.php';
 require DOCPATH.'jewel/process_paypal_order.tran.php';
 		execTransaction('shop', 'processOrder');
 
?>