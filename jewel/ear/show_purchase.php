<?php
/**
 * Show purchase panel - ajax call.
 * 2009-08
 */
 require '../../init.php';
 require DOCPATH.'jewel/show_purchase.tran.php';

 $site = 'ear';
 $function = 'getPurchasePageData';
 
 execTransaction($site, $function);
 
?>