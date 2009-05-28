<?php
/**
 * Holder of the stuff!
 * @author andre, 2009-03
 */
class Context {

	 /*
	 * @the vars array
	 * @access private
	 */
	 protected $vars = array();


	 /**
	 * @set undefined vars
	 *
	 * @param string $index
	 * @param mixed $value
	 * @return void
	 */
	 public function __set($index, $value) {
	        $this->vars[$index] = $value;
	 }

	 /**
	 * @get variables
	 *
	 * @param mixed $index
	 * @return mixed
	 */
	 public function __get($index) {
	        return $this->vars[$index];
	 }

}
?>