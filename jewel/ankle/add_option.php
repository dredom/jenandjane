<?php
/*
 * Add product option - ajax call.
 * 2009-02
 */
 require '../../init.php';
 
 require DOCPATH.'jewel/add_product.tran.php';

 $site = 'ankle';
 $function = 'option';
 
 execTransaction($site, $function);
 
?>
