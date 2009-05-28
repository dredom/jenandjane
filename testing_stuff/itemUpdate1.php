<?php
/*
 * Created on Apr 29, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 $item = $_GET['item'];
 echo $item; 
  $linkID = mysql_connect("localhost", "root", "");
 $selected = mysql_select_db("jjdb", $linkID);
 print "<br>";
 if ($selected) {
 	//print "DB successfully selected. <br>";
 	$row = doDbStuff($linkID, $item);
 	echo $row->id;
 	doResult($linkID, $row);
 	mysql_close($linkID);
 } else {
 	die( "DB select failed!");
 }
 
 function doDbStuff($linkID, $item) {
 	$sql = 'SELECT * FROM item '
 		. ' WHERE id = "'
 		. $item
 		. '"; ';
    $result = mysql_query($sql, $linkID);
    $row = mysql_fetch_object($result);
    return $row;
 }
 ?>
 
 <?php
 function doResult($linkID, $row) {
 	
    if ($row) { ?>
  
  <form action="itemUpdate2.php" method="post" >
  Item: <?php echo $row->id; ?> <br/>
  Price: 
  <input type="text" name="price" value="<?php echo $row->price; ?>" size="11"/>
  </form>
<?php } else { ?>
  <p>Item <?php echo $item ?> not found! <br/>
 <?php 
    	print "Item not found! " . mysql_error($linkID); 
    }
}
?>
