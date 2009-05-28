<?php
// Creates a show of images and renders it.
// Earrings.
// Controller for earrings.
 
 error_reporting(E_ALL);
 require '../showCommon.php';
 
 $title = 'bracelets';
 
 define('SITE', 'ear');
 define('IMAGE_CONFIG', DOCPATH.'jewel/ear/images.config');
 define('TEXTPATH', DOCPATH.'img/');
 
 $pics = loadPics(SITE);
 $show = loadShow(SITE, $pics);

 // Render the view
 require '../../vw/showCommon.php';
 
 ?>
