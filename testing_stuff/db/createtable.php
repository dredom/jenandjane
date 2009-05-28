
<html>
<head>
<title>J+J Table Create</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#FF9966" vlink="#FF9966" alink="#FFCC99">
  
<?php
/*
 * Created on Apr 21, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 // MySql 4.1
 $linkID = mysql_connect("localhost", "root", "");
 //	createDb($linkID);
 $selected = mysql_select_db("jjdb", $linkID);
 print $selected . "<br>";
 if ($selected) {
 	print "DB successfully selected. <br>";
 	doDbStuff($linkID);
 	mysql_close($linkID);
 } else {
 	die( "DB select failed!");
 }
 print "<br> ~ fini ~ <br>";
 // /////////////////////////////////////////////////
 function doDbStuff($linkID) {
 	//dropTable($linkID);
 	//createTable($linkID); 
 	//createIndex($linkID); 
 	//insertRows($linkID);
 	//deleteRows($linkID);
 	//selectRows($linkID);
 }
 function createDb($linkID) {
 	$sql = "CREATE DATABASE `jjdb` DEFAULT CHARACTER SET ascii COLLATE ascii_bin;";
    $rc = mysql_query($sql, $linkID);
    if ($linkID) { print "jjdb created"; }
    else { print "jjdb create failed!"; }
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
  $sql = 'CREATE TABLE `item` ('
        . ' `id` VARCHAR(15) NOT NULL PRIMARY KEY, '
        . ' `description` VARCHAR(200),'
        . ' `price` DECIMAL(5,2) ,'
        . ' `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, '
        . ' `updated` TIMESTAMP NOT NULL '
        . ' )'
        . ' ENGINE = myisam'
        . ' COMMENT = "Jewelry item number table" '
        . ';';
        
  $rc = mysql_query($sql, $linkID);
    if ($rc) {
    	print "Created table item. <br>";
    } else {
    	print "Create failed! " . mysql_error($linkID); 
    }
 }
 function createIndex($linkID) {
 	$sql = 'CREATE UNIQUE INDEX item_id_ix '
 		. ' ON item(id);' ;
    $rc = mysql_query($sql, $linkID);
    if ($rc) {
    	print "index item_id_ix created. <br>";
    } else {
    	print "Ctreate index failed! " . mysql_error($linkID); 
    }
 }
 function dropTable($linkID) {
 	//$sql = 'DROP TABLE `test1`';
 	$sql = 'DROP TABLE `item`';
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
        