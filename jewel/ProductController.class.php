<?php
class ProductController extends BaseAjaxController {
	public $productDataManager;
	public $function;
		
	public function handle() {
		switch ($this->function) {
			case 'getPurchasePageData':
				$this->getPurchasePageData();
				break;
		}

		return $this->template;
	}
	
	private function getPurchasePageData(){ 
		$this->template->imgurl =  $_GET['imgurl'];
		$this->getItem();
		Logger::info("Purchase page view [{$this->template->id}][{$this->template->item->code}]");
	}
		
	private function getItem() {
		//echo ' getOptions... ';
		$id = $this->getParam('id');
		if ($id === null) 
			return;		
		
		try {

			$itemView = $this->productDataManager->getItem($id);
			
		} catch (Exception $e) {
			Logger::error($e->getMessage());
			header('HTTP/1.0 500 Server error');
			echo 'db failed';
	 		$this->status = 'error';
			return;
		}

		$this->template->site = $this->site;
		$this->template->id = $id;
		$this->template->item = $itemView;
	}
	
	private function getParam($param) {
		if ( !isset($_GET[$param]) ) {
			header('HTTP/1.0 400 Bad request');
	 		echo "missing $param ";
	 		$this->status = 'error';
	 		return null;
		}
		return $_GET[$param];
	}
}
?>