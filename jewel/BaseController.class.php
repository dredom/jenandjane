<?php
abstract class BaseController {

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
	protected $context;
	protected $template;

	private $pdo;

	function __construct($context = null, $template = null) {
		if (!$context) {
			$context = new Context();
		}
		$this->context = $context;
		if (!$template) {
			$template = new Template($context);
		}
		$this->template = $template;
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
	protected function init() { }

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

abstract class BasePageController extends BaseController {
	protected function init() {
		$cf = 'http://www.jenandjane.com' . $_SERVER['REQUEST_URI'];
		$this->template->cf = $cf;
	}
}

abstract class BaseAjaxController extends BaseController {
	protected function init() {
		if ( isset($_GET['cf']) ) {
			$this->template->cf = $_GET['cf'];
		}
	}
}

?>