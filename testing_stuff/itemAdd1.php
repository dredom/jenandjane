<?php
/*
 * Created on Apr 29, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 $item = $_GET['item'];
 $text = $_GET['text'];
 $price = $_GET['price'];
 echo $item; 
  $linkID = mysql_connect("localhost", "root", "");
 $selected = mysql_select_db("jjdb", $linkID);
 print "<br>";
 if ($selected) {
 	//print "DB successfully selected. <br>";
 	doDbStuff($linkID, $item, $text, $price);
 	mysql_close($linkID);
 } else {
 	die( "DB select failed!");
 }
 
 function doDbStuff($linkID, $item, $text, $price) {
 	$sql = 'INSERT INTO item ' 
 		. ' ( id, description, price, updated) '
 		. ' VALUES('
 		. '"' . $item . '", '
 		. '"' . $text . '", '
 		. '"' . $price . '", '
		. 'CURRENT_TIMESTAMP) '
 		. '; ';
    $rc = mysql_query($sql, $linkID);
    if ($rc) {
    	print "Item inserted: " . $item . " <br>";
    } else {
    	print "Item not inserted! " . mysql_error($linkID); 
    }
 	
 }
?>
