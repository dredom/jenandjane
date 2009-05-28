<?php
/*
 * Show large image.
 * Ajax.
 * 2009-03
 */
 
 function execTransaction($site, $function) {
 	
 	//echo ' start_tran ';
	$template = new Template();	 
	$template->imgurl =  $_GET['imgurl'];
 	
	$template->show('jewel/ajax/image-overlay');
	 	
	 
 } 
?>
