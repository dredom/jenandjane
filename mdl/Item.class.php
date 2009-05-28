<?php
/* Item of jewelry
 * 
 * Created on Nov 16, 2008
 *
 */
 class Item {
 	public $id;
 	public $code;
 	public $imageSmallUrl;
 	public $imageLargeUrl;
 	public $description;	// ProductData
 	public $options;		// array of ProductOption with price
 	
 	public function __construct($id, $code=null) {
 		$this->id = $id;
 		$this->code = $code;
 	}
 }
?>
