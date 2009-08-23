<?php
/*
 * Updates product description, price.
 * Ajax.
 * 2009-02
 */
 require DOCPATH.'jewel/ProductAddController.class.php';
 require DOCPATH.'jewel/DbManager.class.php';
 require DOCPATH.'jewel/ProductDataManager.class.php';
 include DOCPATH.'jjadmin/User.php';
 include DOCPATH.'jewel/ShowDataManager.class.php';
 
 function execTransaction($site, $function) {
 	Cacher::start();	// start session
 	
 	//echo ' start_tran ';
	 try {
		 $controller = new ProductAddController();
		 $controller->site = $site;
		 $controller->function = $function;
		 $controller->productDataManager = new ProductDataManager();
		 
		 if (!$controller->authorized()) {
	    	header('HTTP/1.0 401 Not Authorized');
		 	echo 'Failed';
		 	return;
		 }
		 $template = $controller->handle();
		 
	 } catch (Exception $e) {
	 	header('HTTP/1.0 500 Server error');
	 	echo $e->getMessage();
	 	Logger::error(__FILE__ . $e->getMessage());
	 	return;
	 }
	 
	 if ($controller->status == 'success') {
	 	header('HTTP/1.0 200 OK', true, 200);
 	
	 	$template->show('jewel/ajax/option');
	 	
	 } else {
	 	echo ' error ';
	 	return;
	 }
	 
	 // Clear cached pics
	 ShowDataManager::clearShowCache($site);
 } 
?>
