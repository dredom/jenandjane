<?php
abstract class DbManager {

	private static $pdo;
	
	private $sqlStmts = array();

	/**
	 * PHP Data Objects - database abstraction
	 * @throws Exception
	 */
	protected function getPdo() {
		if (!self::$pdo) {
			include DOCPATH.'mdl/db/Db.class.php';
	   		self::$pdo = Db::factory()->getPdo();
 		}
		return self::$pdo;
	}
	
	protected function getSqlStatement($SQL_var) {
		if (!isset($this->sqlStmts[$SQL_var])) {
			$stmt = eval('return $this->getPdo()->prepare('.get_class($this).'::'.$SQL_var.');');
			$this->sqlStmts[$SQL_var] = $stmt;
		}
		return $this->sqlStmts[$SQL_var];
	}
	
}
?>