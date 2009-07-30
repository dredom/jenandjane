<?php
/*
 * Show jewelry page with pictures and descriptions.
 * 2009-07
 */
 require DOCPATH.'jewel/BaseController2.class.php';
 require DOCPATH.'jewel/JewelShowController.class.php';
 include DOCPATH.'jjadmin/User.php';
 
 function execTransaction($site, $function) {
 	
 	//echo ' start_tran ';
	 try {
		 $controller = new JewelShowController();
		 $controller->site = $site;
		 $controller->function = $function;
		 
		 $template = $controller->handle();
		 
	 } catch (Exception $e) {
	 	header('HTTP/1.0 500 Server error');
	 	Logger::error(__FILE__ . $e->getMessage());
	 	include DOCPATH.'error.php';
	 	return;
	 }
	 
	 switch($controller->status) {
	 	
	 case 'success':
	 	$template->show('jewel/'.$site.'/index');
	 	break;

	 default:
	 	include DOCPATH.'error.php';
	 }
	
 } 
?>
