<?php
/**
 * Show of picture pages, with a number of pictures per page
 * with position in page set.
 */
class Show {
  var $page;
  var $lastPage;
  var $count;
  var $perPage;
  var $pics;

  function Show($picCount, $picsPerPage) {
    $this->count = $picCount;
    $this->perPage = $picsPerPage;
    $this->page = 1;
    $this->lastPage = (int) floor($picCount / $picsPerPage);
    if ( ($picCount % $picsPerPage) > 0 ) 
      	$this->lastPage++;
  }

  function nextPageNumber() {
    if ($this->page < $this->lastPage) {
      return $this->page + 1;
    } else {
      return NULL;
    }
  }

  function setPageNumber($number) {
    $this->page = $number;
  }

  function firstPicNumForPage() {
    $num = (($this->page - 1) * $this->perPage);
    return $num;
  }

}
?>
