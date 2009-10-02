<?php
/*
 * Common show-page code.
 * Manages stuff in sessions.
 * Needs to define db parameters, include db handler.
 * Loads picture ids into Pics, Show.
 * Created on Nov 18, 2008
 *
 */
 //define('DOCPATH', $_SERVER['DOCUMENT_ROOT'].'/');
 require('authorized.php');
 require(DOCPATH.'mdl/Pic.php');
 require(DOCPATH.'mdl/Pics.php');
 require(DOCPATH.'mdl/Show.php');
 
 //session_start();	// include all class objects before session_start
 Cacher::start();
 define('AUTHORIZED', authorized());
 
 function loadPics($site) {
	 
	 $sitePics = $site.'-pics';
	 
	 if (isset($_SESSION[$sitePics])) {
	   $pics = $_SESSION[$sitePics];
	 } else {
	 	// IMAGE_CONFIG should be replaced with a db call later
	   $pics = new Pics(IMAGE_CONFIG);
	   $pics->load();
	   $_SESSION[$sitePics] = $pics;
	 }
	 
	 return $pics;
 } 
 
 function loadShow($site, $pics) {
	 
	 $siteShow = $site.'-show';
	 
	 if (isset($_SESSION[$siteShow])) {
	   $show = $_SESSION[$siteShow];
	 } else {
	   $show = new Show( sizeof($pics->pics), 4 ); // 4 pics per page
	   $_SESSION[$siteShow] = $show;
	 }
	 
	 // Did we get here from a next/prev link?
	 if ( isset($_GET['page']) ) {
	   $show->setPageNumber($_GET['page']);
	 }
	 
	 return $show;
 } 
 
 function clearPicsSession($site) {
	 $sitePics = $site.'-pics';
	 if (isset($_SESSION[$sitePics])) {
	   $_SESSION[$sitePics] = null;
	 }
 }
?>
