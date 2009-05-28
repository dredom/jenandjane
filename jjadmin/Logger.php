<?php
/* Logger class
 * Switches between 2 log files automatically on size.
 * Created on Dec 8, 2007
 */
 class Logger {
 	var $logFile;
 	function factory() {
 		static $instance;
 		if (isset($instance)) {
 			print "old instance... \n";
 			return $instance;
 		} else {
 			print "NEW instance... $instance \n";
 			$instance = new Logger(LOGFILE);
 			return $instance;
 		}
 	}
 	function Logger($filename) {
 		$this->logFile = $filename;
 		if (!file_exists($filename))
	 		error_log("Start", 3, $filename);
 		// assign error handler
 		global $debug;
 		if ($debug)
 			set_error_handler('errorHandlerDev');
 		else
 			set_error_handler('errorHandler');
 	}
 	function log($level, $msg){
 		$msg = strftime("%y%m%d %H:%M:%S") . " [$level] $msg\n";
 		if (filesize($this->logFile) > 512) {
 			$f = fopen($this->logFile . '.lock', "w");
 			if (flock($f, LOCK_EX)) {
 				$old = $this->logFile . ".old";
 				if (file_exists($old))
	 				unlink($old);
 				rename($this->logFile, $old);	
 				clearstatcache();
 				flock($f, LOCK_UN);
 			} else {
 				echo "lock failed..\n";
 			}
 			fclose($f);
 		}
 		error_log($msg, 3, $this->logFile);
 	}
 	function info($msg) {
 		$this->log("INFO", $msg);
 	}
 	function error($msg) {
 		$this->log("ERROR", $msg);
 	}
 }
 	
 // Production error handler
 function errorHandler($error, $error_string, $filename, $line, $symbols) {
 	// log error
 	$log = Logger::factory();
 	$msg = "$error_string " .
	 	 " on file: $filename line: $line symbols: $symbols";
 	if ($error & (E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR)) {
 		$log->log('FAIL', $msg);
 		include DOCPATH . '/error.html';
 		exit;
 	} else if ($error & (E_WARNING | E_CORE_WARNING | E_COMPILE_WARNING | E_USER_WARNING))
 		$log->log('WARN', $msg);
 	else
 		$log->log('INFO', $msg);
 }
 // Development error handler
 function errorHandlerDev($error, $error_string, $filename, $line, $symbols) {
 	echo "<p>error: $error $error_string " .
 	 " on file: $filename line: $line symbols: $symbols </p>\n";
 }
?>
