<?php
class ProductUpdateController extends BaseController {
	public $productDataManager;
	public $function;
		
	public function handle() {
		switch ($this->function) {
			case 'updateDescription':
				$this->updateDescription();
				break;
			case 'option':
				$this->updateOption();
				break;
		}

		return $this->template;
	}
	
 	private function updateDescription() {	
		$id = $this->getParam('id');
		if ($id === null) 
			return;	
		
		$description = $this->getParam('text');
		if ($description === null) 
			return;	
		
		$data = new ProductData;
		$data->productid = $id;
		$data->description = $description;

		try {

			$this->productDataManager->updateDescription($data);
			
		} catch (Exception $e) {
			Logger::error($e->getMessage());
			header('HTTP/1.0 500 Server error');
			echo 'db failed';
	 		$this->status = 'error';
			return;
		}

		$this->template->id = $id;
		$this->template->description = $description;
	}
	
	private function updateOption() {
		//echo ' updateOption... ';
		$id = $this->getParam('id');
		if ($id === null) 
			return;		
		$price = $this->getParam('price');
		if ($price === null)
			return;
		$option = $this->getParam('optiontype');
		if ($option === null)
			return;
		$value = $this->getParam('value');
		if ($value === null)
			return;
		$seq = $this->getParam('seq');
		if ($seq === null)
			return;
			
		// Massage values as needed
		if ($value == '') {
			$value = null;
			$option = null;
		}
		if ($price == '') {
			$price = null;
		} else {
			$price = (float) $price;
		}
		$code = $this->getParam('code');
		$ix = $this->getParam('ix');
			
		// If all fields empty, Delete.
		if ($option == null && $price == null) {
			$this->deleteOption($id, $seq, $code);
			return;
		}
		
		// Update
		$data = new ProductOption();
		$data->productid = (int) $id;
		$data->seq = (int) $seq;
		$data->price = $price;
		$data->optiontype = $option;
		$data->value = $value;

		try {

			$this->productDataManager->updatePrice($data);
			
			Logger::info("Updated [$id] [$code] type[$option] value[$value] price[$price]");
			
		} catch (Exception $e) {
			Logger::error($e->getMessage());
			header('HTTP/1.0 500 Server error');
			echo 'db failed';
	 		$this->status = 'error';
			return;
		}

		$this->template->authorized = $this->authorized();
		$this->template->id = $id;
		$this->template->option = $data;
		$this->template->ix = $ix;
		$item = new Context();
		$item->id = $id;
		$item->code = $code;
		$this->template->item = $item;
	}

	private function deleteOption($id, $seq, $code) {
		$data = new ProductOption();
		$data->productid = (int) $id;
		$data->seq = (int) $seq;

		try {

			$this->productDataManager->deleteProductOption($data);
			
			Logger::info("Deleted option [$id] seq[$seq] [$code] ");
			
		} catch (Exception $e) {
			Logger::error($e->getMessage());
			header('HTTP/1.0 500 Server error');
			echo 'db failed';
	 		$this->status = 'error';
			return;
		}

		$this->template->authorized = $this->authorized();
		$this->template->option = null;
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