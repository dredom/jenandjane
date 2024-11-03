<?php
/*
 * Show purchase page with add-to-cart button.
 * Ajax.
 * 2009-03
 */
 require DOCPATH.'jewel/DbManager.class.php';
 require DOCPATH.'jewel/ProductDataManager.class.php';
 require DOCPATH.'jewel/ProductController.class.php';
 
 function execTransaction($site, $function) {
	 	Cacher::set('is_cart', 'true');
 	
 	//echo ' start_tran ';
	 try {
		 $controller = new ProductController();
		 $controller->site = $site;
		 $controller->function = $function;
		 $controller->productDataManager = new ProductDataManager();
		 
		 $template = $controller->handle();
		 
	 } catch (Exception $e) {
	 	header('HTTP/1.0 500 Server error');
	 	echo $e->getMessage();
	 	Logger::error(__FILE__ . $e->getMessage());
	 	return;
	 }
	 
	 //echo ' after handle ';
	 
	 if ($controller->status == 'success') {
	 	header('HTTP/1.0 200 OK', true, 200);
 	
	 	Cacher::set('is_cart', 'true');
	 	
	 	$template->show('jewel/ajax/purchase-overlay');
	 	
	 } else {
	 	echo ' error ';
	 	return;
	 }
	
 } 
?>
