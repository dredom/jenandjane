<?php
/*
 * Shows that values changed in an object previously added to session are persisted in session
 * across transactions.
 */
 class Temp {
 	public $a;
 }
 define('KEY', 'sessionTest');
 session_start();
 if (!isset( $_SESSION[KEY])) {
 	echo "Not set. Setting value 'aaaa'";
 	$temp = new Temp;
 	$temp->a = 'aaaa';
 	$_SESSION[KEY] = $temp;
 } else {
 	echo "Set! <br>";
 	$temp = $_SESSION[KEY];
 	var_dump($temp);
 	echo "<p>Settin value 'bbbb' </p>";
 	$temp->a = 'bbbb';
 }
?>