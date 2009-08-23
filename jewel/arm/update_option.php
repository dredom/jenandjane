<?php
/**
 * update_option.php
 * Updates product options (price) - ajax call.
 * Created 2009-08
 */
 require '../../init.php';
 
 require DOCPATH.'jewel/update_product.tran.php';

 $site = 'arm';
 $function = 'updateOption';
 $successView = 'jewel/ajax/option';
 
 execTransaction($site, $function, $successView);
 
?>