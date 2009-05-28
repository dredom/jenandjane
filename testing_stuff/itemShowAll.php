<?php
/*
 * Created on Apr 29, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 $updaterUrl = "itemUpdate1.php";
  $linkID = mysql_connect("localhost", "root", "");
 $selected = mysql_select_db("jjdb", $linkID);
 print "<br>";
 if ($selected) {
 	//print "DB successfully selected. <br>";
 	doDbStuff($linkID, $item);
 	mysql_close($linkID);
 } else {
 	die( "DB select failed!");
 }
 
 function doDbStuff($linkID, $item) {
 	$sql = 'SELECT * FROM item '
 		. ' ORDER BY id;';
    $result = mysql_query($sql, $linkID);
	showItems($result);
 }
 function showItems($result) {
 	print "<table border='1'>\n";
 	while ($row = mysql_fetch_object($result)) {
 		print " <tr>";
 		print "<td>" . $row->id . "</td>";
 		print "<td>" . $row->price . "</td>";
 		print "<td>" . $row->description . "</td>";
 		print "<td>" . itemButtons($row->id) . "</td>";
 		print " </tr>\n";
  	}
 	print "</table>\n";
 } 	
 function itemButtons($item) {
 	global $updaterUrl;
 	$btn = "<form action='" . $updaterUrl . "'> "
 		. " <input type='hidden' name='item' value='" . $item . "' />"
 		. " <input type='submit' value='Update' />"
 		. "</form>\n";
 	return $btn;
 }
?>
