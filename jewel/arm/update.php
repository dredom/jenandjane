<?php
/**
 * update.php
 * Update product description - ajax call.
 * Created on 2009-08
 */
 require '../../init.php';
 require DOCPATH.'jewel/update_product.tran.php';
 
 $site = 'arm';
 $function = 'updateDescription';
 $successView = 'ok';
 
 execTransaction($site, $function, $successView);
 
?>