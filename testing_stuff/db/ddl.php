<?php
/*
 * Created on Dec 4, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require 'pconnect.php';

 $db = 'jjdb';
 
 function ddl($file) {
	global $db; 	
	 print $db . " " . $file . "\n";
	 $lines = file($file);
	 $sql = '';
	 foreach ($lines as $line) { 
	 	print "\t" . $line;
	 	$sql .= $line;
	 }
	 print "\n";
	 $results = mysql_db_query($db, $sql);
	 if ($results)
	 	print "Success \n";
	 else
	 	print mysql_error();
 }
?>
