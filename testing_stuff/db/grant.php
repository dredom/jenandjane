<?php
/*
 * Created on Dec 4, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require 'connect.php';

 $user = 'jenjane';
 $user = 'root';
 $user = 'auntiedt';
 $password = 'gem24$'; 
 $password = ''; 
 $password = 'beesblaas'; 
 $db = 'jjdb';
 $file = 'sql/grant_jjdbuser.txt';
 
 $connect = db_connect($user, $password);

 print $db . " " . $file . "\n";
 $lines = file($file);
 $sql = '';
 foreach ($lines as $line) { 
 	print "\t" . $line;
 	$sql .= $line;
 }
 print "\n";
 $results = mysql_query($sql);
 if ($results)
 	print "Success \n";
 else
 	print mysql_error();
 mysql_close($connect); 
?>
