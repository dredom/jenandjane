<?php
/*
 * Created on Dec 4, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 function db_connect($user, $password) {
 	$connection = mysql_connect('localhost', $user, $password);
 	if (!$connection) {
 		print "Connect with $user failed!\n";
 		die("Die " . $connection);
 	}
 	return $connection;
 }
?>
