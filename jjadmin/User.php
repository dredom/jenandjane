<?php
/*
 * Created on Jul 20, 2008
 *
 */
 class User {
 	var $id;
 	var $name;
 	var $md5;
 	function User($id, $name) {
 		$this->id = $id;
 		$this->name = $name;
 	}
 }
?>