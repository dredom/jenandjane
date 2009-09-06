<?php
/*
 * Test Db.php
 * Created on Dec 7, 2007
 *
 */
  $debug = true;
 include '../../init.php';
 
 include DOCPATH . 'mdl/db/Db.class.php';
 $dbm = Db::factory();
 $pdo = $dbm->getPdo();
 
// 		$dbm->query("insert into stats values ('" . $id . "', 0);");
// 		if (!results)
//	 		print mysql_error() . "\n";
 
 $q = "select * from product where id = 2;";
 $results = $pdo->query($q);
 //echo 'results=' . $results . "\n";
 if (!$results) {
 	echo "db error " . $pdo->errorCode() . " <br>\n";
 	trigger_error(mysql_error(), E_USER_ERROR);
 	exit;
 }
// while ($row = mysql_fetch_object($results)) {
//	 echo ' id=' . $row->id . " count=" . $row->count . " \n";
// }
 echo count($results)." rows \n";
 var_dump($results);
 $first = $results->fetch();
 var_dump($first);
 foreach ($results as $row) {
 	if ($row === null) {
 		echo " row is null \n";
 	}
 	if (!isset($row)) {
 		echo " row is not set \n";
 	}
 	echo " >".$row."< \n";
 	var_dump($row);
 }

 echo " ~ \n";
?>
