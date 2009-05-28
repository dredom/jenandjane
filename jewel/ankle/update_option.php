<?php
/*
 * update.php
 * Updates item text file - ajax call.
 * Created on Nov 23, 2008
 */
 require '../../init.php';
 
 require DOCPATH.'jewel/update_product.tran.php';

 $site = 'ankle';
 $function = 'option';
 $successView = 'jewel/ajax/option';
 
 execTransaction($site, $function, $successView);
 
?>
