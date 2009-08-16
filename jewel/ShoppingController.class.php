<?php
class ShoppingController extends BaseController2 {
	public $productDataManager;
	public $function;
		
	public function handle() {
		switch ($this->function) {
				
			case 'processOrder':
				$this->processPayPalOrder();
				break;
		}

		return $this->template;
	}
		
	private function processPayPalOrder() {
		// Expected values - defaults
		$defaultValues = array(
			'num_cart_items'=>1,
			'payer_email'=>'unknown email',
			'contact_phone'=>'(no phone)',
			'payer_status'=>'unknown payer status',
			'mc_currency'=>'?',
			'mc_gross'=>0,
			'mc_shipping'=>0,
			'mc_fee'=>0,
			'address_status'=>'status unknown',
			'address_name'=>'(same)',
			'address_street'=>'(no street)',
			'address_city'=>'(no city)',
			'address_state'=>'(no state)',
			'address_zip'=>'(no zip)',
			'memo'=>''
		);
	 	foreach ($defaultValues as $dvk => $dvv) {
 				$this->template->$dvk = $dvv;
 		}
		// Put all paypal notify parameters into template
		foreach ($_POST as $key => $value){
			$this->template->$key = $value;
		}
		
 		for ($i = 1; $i <= $this->template->num_cart_items; $i++) {
 			$option_name = $this->template->{'option_name1_'.$i};
 			if (!isset($option_name)) {
 				$this->template->{'option_name1_'.$i} = '(no option)';
 			}
 			$option_selection = $this->template->{'option_selection1_'.$i};
 			if (!isset($option_selection)) {
 				$this->template->{'option_selection1_'.$i} = '(no option selection)';
 			}
 		}
		
		// TODO get product item
		$this->status = 'success';
	}
		
}
?>