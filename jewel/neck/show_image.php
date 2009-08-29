<?php
/**
 * Show image in overlay - ajax call.
 * 2009-08
 */
 require '../../init.php';
 
 require DOCPATH.'jewel/show_image.tran.php';

 $site = 'neck';
 $function = 'show';
 
 execTransaction($site, $function);
 
?>