<?php
// Creates a show of images for BRACELETS
// and renders it.
// Controller for bracelets.
 
 error_reporting(E_ALL);
 require '../showCommon.php';
 
 $title = 'bracelets';
 
 define('SITE', 'arm');
 define('IMAGE_CONFIG', DOCPATH.'jewel/arm/images.config');
 define('TEXTPATH', DOCPATH.'img/');
 
 $pics = loadPics(SITE);
 $show = loadShow(SITE, $pics);

 // Render the view
 require '../../vw/showCommon.php';
 
 ?>
