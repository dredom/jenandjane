<?php
/*
 * Created on Dec 5, 2007
 *
 */
 require '../db/Db.php';
 
 function statCount($id) {
 	$db = Db::factory();
 	$results = $db->query("select count from stats where id = '" . $id . "';");
 	if (!results)
 		print mysql_error() . "\n";
 	if ($row = mysql_fetch_assoc($results)) {
    	$count = $row['count'];
//    	print " count=" . $count . "\n";
		$db->query("update stats set count=count+1;");
	 	if (!results)
 			print mysql_error() . "\n";
	} else {
		print "Insert... \n";		
		$db->query("insert into stats values ('" . $id . "', 0);");
 		if (!results)
	 		print mysql_error() . "\n";
  		$count = 1;
	}
 	return $count;
 }
?>
