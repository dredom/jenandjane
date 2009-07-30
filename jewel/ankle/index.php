<?php
/**
 * Creates a show of images for the ANKLETS and renders it.
 * Note that "images.config" file in this directory is required by ShowDataManager.
 * 2009-01
 */
 require '../../init.php';
 require DOCPATH.'jewel/show_page.tran.php';

 $site = 'ankle';
 $function = 'show';
 
 execTransaction($site, $function);
  
?>