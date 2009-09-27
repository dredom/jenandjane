<?php
class ProductAddController extends BaseController2 {
	public $productDataManager;
	public $function;
		
	public function handle() {
		switch ($this->function) {
			case 'addOption':
				$this->addOption();
				break;
		}

		return $this->template;
	}
		
	private function addOption() {
		//echo ' addOption... ';
		$id = $this->getParam('id');
		if ($id === null) 
			return;		
		$price = $this->getParam('price');
		if ($price === null)
			return;
		if ($price != '' && !is_numeric($price)) {
			$this->status = 'error';
			header('HTTP/1.0 400 Bad request');
			echo "bad price $price ";
			return;
		}
		$option = $this->getParam('optiontype');
		if ($option === null)
			return;
		$value = $this->getParam('value');
		if ($value === null)
			return;
		$seq = $this->getParam('seq');
		if ($seq === null)
			return;
		$code = $this->getParam('code');
		$ix = $this->getParam('ix');
					
		// Massage values as needed
		if ($seq == '') {
			$seq = null;
		} else {
			$seq = (int) $seq;
		}
		if ($value == '') {
			$value = null;
			$option = null;
		}
		if ($price == '') {
			$price = null;
		} else {
			$price = (float) $price;
		}
			
		// Get last seq for this product.
		if ($seq == '') {
			$seq = $this->productDataManager->getNextOptionSeq($id);
		}
		
		$data = new ProductOption();
		$data->productid = (int) $id;
		$data->seq = $seq;
		$data->price = $price;
		$data->optiontype = $option;
		$data->value = $value;

		try {

			$this->productDataManager->insertProductOption($data);
			
			Logger::info("Added [$id][$code] seq[$seq] type[$option] value[$value] price[$price]");
			
		} catch (Exception $e) {
			Logger::error($e->getMessage());
			header('HTTP/1.0 500 Server error');
			echo 'db failed';
	 		$this->status = 'error';
			return;
		}

		$this->template->authorized = $this->authorized();
		$this->template->id = $id;
		$this->template->code = $code;
		$this->template->option = $data;
		$this->template->ix = $ix;
		$item = new Context();
		$item->id = $id;
		$item->code = $code;
		$this->template->item = $item;
	}
	
	protected function getParam($param) {
		$value = parent::getParam($param);
		if ( $value === null ) {
			header('HTTP/1.0 400 Bad request');
	 		echo "missing $param ";
	 		$this->status = 'error';
		}
		return $value;
	}
}
?>