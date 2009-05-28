<?php
/*
 * Show purchase panel - ajax call.
 * 2009-03
 */
 require '../../init.php';
 
 require DOCPATH.'jewel/show_purchase.tran.php';

 $site = 'ankle';
 $function = 'getPurchasePageData';
 
 execTransaction($site, $function);
 
?>
