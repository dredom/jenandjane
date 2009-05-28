<?php
/*
 * Created on Dec 4, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require 'connect.php';

 $user = 'root';
 $password = ''; 
 
 $connect = db_connect($user, $password);
 if (!$connect) {
 	die('Abort');
 }

 $dbs = mysql_list_dbs();
 while ($db = mysql_fetch_row($dbs)) {
 	print $db[0] . "\n";
 }
 mysql_close($connect); 
?>
