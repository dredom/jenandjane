<?php
/*
 * Created on Dec 7, 2007
 *
 * Db class
 * Provides seamless db connection and select/update/delete.
 */

 class Db {
 	private static $instance;
 	private $db;
 	private $host = 'localhost';
 	private $user;
 	private $password;

 	private $pdo;

 	public static function factory() {
 		if (self::$instance) {
 			//print "old instance... \n";
 		} else {
 			include DOCPATH.'mdl/db/db.config.php';
 			//print "NEW instance... $db \n";
 			self::$instance = new Db($db, $host, $user, $password);
 		}
		return self::$instance;
 	}

 	public function __construct($db, $host, $user, $password) {
 		$this->db = $db;
        $this->host = $host;
 		$this->user = $user;
 		$this->password = $password;
 	}

 	public function getPdo() {
 		if (!$this->pdo) {
	   		$this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
	   		$this->pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 		}
		return $this->pdo;
 	}
 }
?>
