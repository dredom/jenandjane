<?php
/**
 * Creates a show of images for EARRINGS and renders it.
 * Router for earrings view.
 * 2009-08
 */
 require '../../init.php';
 require DOCPATH.'jewel/show_page.tran.php';

 $site = 'arm';
 $function = 'show';
 
 execTransaction($site, $function);
 
// require '../showCommon.php';
// 
// $title = 'bracelets';
// 
// define('SITE', 'ear');
// define('IMAGE_CONFIG', DOCPATH.'jewel/ear/images.config');
// define('TEXTPATH', DOCPATH.'img/');
// 
// $pics = loadPics(SITE);
// $show = loadShow(SITE, $pics);
//
// // Render the view
// require '../../vw/showCommon.php'; 
?>