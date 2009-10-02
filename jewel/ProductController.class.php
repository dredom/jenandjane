<?php
class ProductController extends BaseController2 {
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
		//echo ' getPurchasePageData ';
		$this->template->imgurl =  $this->getParam('imgurl');
		if ($this->isError()) {
			return;
		}
		$this->getItem();
		if ($this->isError()) {
			return;
		}
	
		// TODO Add 'name' to productdata
		$itemView = $this->template->item;
		$name = substr($itemView->description, 0, 35);
		$itemView->name = $name . '...';

		// Build shippng costs (including insurance)
		$shippingbase = shop_shipping_fee;
		$optionShipping = array();
		$options = $itemView->options;
		for ($i = 0; $i < sizeof($options); $i++) {
			$option = $options[$i];
			if ($option->price < 100) {
				$ship = $shippingbase + 4;
			} else {
				$ship = $shippingbase + 8;
			}
			$optionShipping[$option->seq] = $ship;
		}
		$this->template->optionShipping = $optionShipping;
		
		Logger::info('Purchase page view ['.$this->template->item->id.']['.$this->template->item->code.']');
	}

	private function getItem() {
		$id = $this->getParam('id');
		if ($this->isError()) {
			return;
		}

		try {

			$itemView = $this->productDataManager->getItem($id);

		} catch (Exception $e) {
			Logger::error($e->getMessage());
			header('HTTP/1.0 500 Server error');
			echo 'db failed';
	 		$this->setError();
			return;
		}

		$this->template->site = $this->site;
		$this->template->id = $id;
		$this->template->item = $itemView;
	}

	protected function getParam($param) {
		$value = parent::getParam($param);
		if ( $value == null ) {
			header('HTTP/1.0 400 Bad request');
	 		echo "missing $param ";
	 		$this->setError();
		}
		return $value;
	}
}
?>