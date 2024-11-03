<?php
/*
 * Show large image.
 * Ajax.
 * 2009-03
 */ 
 function execTransaction($site, $function) {
 	
 	//echo ' start_tran ';
 	if ( !isset($_GET['imgurl']) ) {
 		header('HTTP/1.0 400 Bad request');
 		return;
	}
 	
	$template = new Template();	 
	$template->imgurl =  $_GET['imgurl'];
 	
	$template->show('jewel/ajax/image-overlay');
 } 
?>