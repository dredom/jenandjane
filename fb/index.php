<?php
/*
 * Created on Nov 29, 2007
 */
 require '../init.php';
 require 'FbHome.class.php';
 try {
	 $controller = new FbHome();
	 $template = $controller->handle();
 } catch (Exception $e) {
 	echo $e->getMessage();
 	return;
 }
 $template->show('fb/index');
?>
