<?php
/**
 * Creates a show of images for the ANKLETS and renders it.
 * Note that "images.config" file in this directory is required by ShowDataManager.
 * 2009-01
 */
 
 require '../../init.php';
 require DOCPATH.'jewel/BaseController2.class.php';
 require DOCPATH.'jewel/JewelShowController.class.php';
 include DOCPATH.'jjadmin/User.php';
 
 $type = 'a';
 $site = 'ankle';
 
 try {
	 $controller = new JewelShowController();
	 $controller->type = $type;
	 $controller->site = $site;
	 $template = $controller->handle();
 } catch (Exception $e) {
 	echo $e->getMessage();
 	Logger::error(__FILE__ . $e->getMessage());
 	return;
 }
 $template->show('jewel/ankle/index');
  
 ?>
