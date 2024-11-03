<?php
/* Logger class
 * Switches between 2 log files automatically on size.
 * Created on Dec 8, 2007
 */
 class Logger {
 	private static $instance;
 	public $logFile;

 	public static function factory() {
 		if (self::$instance) {
 		} else {
 			self::$instance = new Logger(LOGFILE);
 		}
		return self::$instance;
 	}

 	public function __construct($filename) {
 		$this->logFile = $filename;
 		if (!file_exists($filename))
	 		error_log("Start\n", 3, $filename);
 	}

 	public function log($level, $msg){
 		$ip = $_SERVER['REMOTE_ADDR'];
 		//$msg = strftime('%y%m%d %H:%M:%S') . " [$level] $msg [$ip]\r\n";
        $msg = date('ymd H:i:s') . " [$level] $msg [$ip]\r\n";
 		if (filesize($this->logFile) > 32768) {
 			$f = fopen($this->logFile . '.lock', 'w');
 			if (flock($f, LOCK_EX)) {
 				$old = $this->logFile . '.old';
 				if (file_exists($old))
	 				unlink($old);
 				rename($this->logFile, $old);
 				clearstatcache();
 				flock($f, LOCK_UN);
 			} else {
 				echo "lock failed..\n";
 				error_log("lock failed..\r\n", 3, $this->logFile);
 			}
 			fclose($f);
 		}
 		error_log($msg, 3, $this->logFile);
 	}

 	public static function info($msg) {
 		self::factory()->log('INFO', $msg);
 	}

 	public static function error($msg) {
 		self::factory()->log('ERROR', $msg);
 	}
 }
?>
