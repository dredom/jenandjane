<?php
/*
 * Add product option - ajax call.
 * 2009-08
 */
 require '../../init.php';
 
 require DOCPATH.'jewel/add_product.tran.php';

 $site = 'arm';
 $function = 'addOption';
 
 execTransaction($site, $function);
 
?>