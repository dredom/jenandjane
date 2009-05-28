<?php
/**
 * Picture show, or set of pictures.
 */
class Pics {
  var $config;          // file of pic names
  var $url = '/img/';
  var $pics = array();
  var $pos;

  function Pics($picNames) {
    $this->config = $picNames;
  }

  function add($pic) {
    $this->pics[] = $pic;
  }

  /** Load the list of image-file names from config */
  function load() {
    $lines = file($this->config);
    foreach ($lines as $line) {

	    	$i = strpos($line, ' ');
			if ($i) {
				$code = substr($line, 0, $i);
			} else {
				$code = trim($line);
			}
    	
      $name = trim($code);
      print("<!-- Pics.load $name -->\n");
      $pic = new Pic($name, $this->url);
      $this->pics[] = $pic;
    }
    $this->pos = -1;
    reset($this->pics);         // start
  }

  function setPosition($number) {
    $this->pos = $number;
  }

  function get($position) {
    $this->pos = $position;
    return $this->pics[$position];
  }

  function next() {
    if ( $this->pos < (sizeof($this->pics) - 1) ) {
      return $this->pics[++$this->pos];
    } else {
      return NULL;
    }
  }
}
?>
