<?php
/**
 * Show of picture pages, with a number of pictures per page.
 * 
 * 2009-01
 */
class Show {
  public $lastPage;
  public $perPage;
  public $items;

  public function __construct(array $items, $picsPerPage) {
  	$this->items = $items;
    $this->perPage = (int) $picsPerPage;
    $picCount = sizeof($items);
    $this->lastPage = (int) floor($picCount / $picsPerPage);
    if ( ($picCount % $picsPerPage) > 0 ) 
      	$this->lastPage++;
  }

}
?>
