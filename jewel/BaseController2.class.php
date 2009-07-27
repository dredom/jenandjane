<?php
abstract class BaseController2 {

	const PAGE = 'page';
	const AJAX = 'ajax';
	
	private $type;
	
	/*
	 * Site or directory segment
	 */
	public $site;
	
	/*
	 * Status result of handle()
	 */
	public $status = 'success';
	
	public $authorized;
	
	/*
	 * @registry object
	 */
	protected $template;

	private $pdo;

	function __construct($type = self::PAGE) {
		$this->type = $type;
		$this->template = new Template;
		$this->init();
	}
	
	public function authorized() {
		if (!$this->authorized) {
			$this->authorized = false;
			if (isset($_SESSION['user'])) {
		    	$user = $_SESSION['user'];
			    $md5 = md5($user->id . date('YMD'));
			 	if ($md5 == $user->md5)
			 		$this->authorized = true;
			}
	 	}
		return $this->authorized;
	}
	
	/**
	 * @all controllers must contain a handle method
	 */
	abstract function handle();
	
	/**
	 * Internal initialization for Ajax vs Page
	 */
	protected function init() {
		switch ($this->type) {
		case self::PAGE:
			$cf = $_SERVER['REQUEST_URI'];
			$this->template->cf = $cf;
			break;
		case self::AJAX:
			if ( isset($_GET['cf']) ) {
				$this->template->cf = $_GET['cf'];
			}
			break;
		}
	}

	/**
	 * PHP Data Objects - database abstraction
	 * @throws Exception
	 */
	public function getPdo() {
		if (!$this->pdo) {
			include DOCPATH.'mdl/db/Db.class.php';
	   		$this->pdo = Db::factory()->getPdo();
 		}
		return $this->pdo;
	}
	
	protected function getParam($param) {
		if ( !isset($_GET[$param]) ) {
	 		return null;
		}
		return $_GET[$param];
	}
}
?>