<?php
/*** error reporting on ***/
 error_reporting(E_ALL);

 $site_path = realpath(dirname(__FILE__));
 define('DOCPATH', $site_path.'/');

 /*** include the abstract controller class ***/
 require DOCPATH . 'jewel/' . 'BaseController2.class.php';

 /*** include the registry class ***/
 require DOCPATH . 'jewel/' . 'Context.class.php';

 /*** include the template class ***/
 require DOCPATH . 'jewel/' . 'Template.class.php';

 define('LOGFILE', DOCPATH.'jjadmin/jj.log');

 /*** include the logger class ***/
 require DOCPATH . 'jewel/' . 'Logger.class.php';

 /*** include the caching class ***/
 require DOCPATH . 'jewel/' . 'Cacher.class.php';

 include 'ENV.php';
 
 /*** shopping cart stuff ***/
 require DOCPATH . 'shop/shop.config.php';
 
 // Production error handler
 date_default_timezone_set('America/Los_Angeles');
 function errorHandler($error, $error_string, $filename, $line) {
 	$msg = "$error_string " .
	 	 " on file: $filename line: $line";
 	if ($error & (E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR)) {
 		Logger::factory()->log('FAIL', $msg);
 		include DOCPATH . 'error.html';
 		exit;
 	} else if ($error & (E_WARNING | E_CORE_WARNING | E_COMPILE_WARNING | E_USER_WARNING))
 		Logger::factory()->log('WARN', $msg);
 	else
 		Logger::info($msg);
 }
 set_error_handler('errorHandler');

 if (ENV == 'development') {
	 function errorHandlerDev($error, $error_string, $filename, $line) {
	 	echo "<p>error: $error $error_string " .
	 	 " on file: $filename line: $line </p>\n";
	 }
 	set_error_handler('errorHandlerDev');
 }

 /*** auto load model classes ***/
/*
 function __autoload($class_name) {
    $file = DOCPATH . '/mdl/db/' . $class_name . '.class.php';
    if (file_exists($file) == false) {
        return false;
    }
  include ($file);
}
 */

spl_autoload_register(function ($class_name) {
    $file = DOCPATH . '/mdl/db/' . $class_name . '.class.php';
    if (file_exists($file)) {
        include $class_name . '.php';
    }
});

?>
