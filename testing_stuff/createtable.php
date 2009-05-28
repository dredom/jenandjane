
<html>
<head>
<title>testing</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#FF9966" vlink="#FF9966" alink="#FFCC99">
  
<?php
/*
 * Created on Apr 21, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 print "Starting createtable.php... <br>";
 
 $linkID = mysql_connect("localhost", "root", "");
 $selected = mysql_select_db("mysql", $linkID);
 print $selected . "<br>";
 if ($selected) {
 	print "DB successfully selected. <br>";
 	//doDbStuff($linkID);
 	mysql_close($linkID);
 } else {
 	die( "DB select failed!");
 }
 print "<br> ~ fini ~ <br>";
 // /////////////////////////////////////////////////
 function doDbStuff($linkID) {
 	//dropTable($linkID);
 	//createTable($linkID); 
 	insertRows($linkID);
 	//deleteRows($linkID);
 	selectRows($linkID);
 }
 function insertRows($linkID) {
 	$sql = 'INSERT INTO test1'
 		. ' VALUES("AAAA","My name")';
    $rc = mysql_query($sql, $linkID);
    if ($rc) {
    	print "Rows inserted. <br>";
    } else {
    	print "Insert failed! " . mysql_error($linkID); 
    }
 }
 function selectRows($linkID) {
 	$sql = 'SELECT * from test1';
    $resultID = mysql_query($sql, $linkID);
    if ($resultID) {
    	print "Selected... <br>";
    	fetchRows($resultID);
    } else {
    	print "Select failed? " . mysql_error($linkID); 
    }
 }
 function fetchRows($resultID) {
 	while ($row = mysql_fetch_row($resultID)) {
		print " + "; 
 		foreach ($row as $column) {
 			print $column . " ";
 		}
 		print "<br>";
 	}
 }
 function deleteRows($linkID) {
 	$sql = 'DELETE from test1 ';
    $rc = mysql_query($sql, $linkID);
    if ($rc) {
    	print "Deleted table rows. <br>";
    } else {
    	print "Row delete failed! " . mysql_error($linkID); 
    }
 }
 function createTable($linkID) {
  $sql = 'CREATE TABLE `test1` ('
        . ' `key` VARCHAR(4) NOT NULL, '
        . ' `value` VARCHAR(20) NOT NULL,'
        . ' PRIMARY KEY (`key`)'
        . ' )'
        . ' ENGINE = myisam;';
        
  $rc = mysql_query($sql, $linkID);
  print "Create table rc=" . $rc . "<br>";
  $err = mysql_error($linkID);
  print "Error message " . $err . "<br>";
 }
 function dropTable($linkID) {
 	$sql = 'DROP TABLE `test1`';
    $rc = mysql_query($sql, $linkID);
    if ($rc) {
    	print "Dropped table. <br>";
    } else {
    	print "Drop failed! " . mysql_error($linkID); 
    }
 }
?>
<hr>
CREATE DATABASE `dredom2` DEFAULT CHARACTER SET ascii COLLATE ascii_general_ci;


        
</body>
</html>
        