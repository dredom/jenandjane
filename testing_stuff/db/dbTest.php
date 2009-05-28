<?php
/*
 * Test Db.php
 * Created on Dec 7, 2007
 *
 */
  $debug = true;
 define(TESTPATH, "../..");
 include TESTPATH . '/jjadmin/config.php';
 include DOCPATH . '/jjadmin/Logger.php';
 $log = Logger::factory();
 
 include DOCPATH . '/db/Db.php';
 $dbm = Db::factory();
 echo $dbm->db . "\n";
 
// 		$dbm->query("insert into stats values ('" . $id . "', 0);");
// 		if (!results)
//	 		print mysql_error() . "\n";
 
 $q = "select * from stats;";
 $results = $dbm->query($q);
 echo 'results=' . $results . "\n";
 if (!$results) {
 	echo "db error " . $dbm->error . " <br>\n";
 	trigger_error(mysql_error(), E_USER_ERROR);
 	exit;
 }
 while ($row = mysql_fetch_object($results)) {
	 echo ' id=' . $row->id . " count=" . $row->count . " \n";
 }
 echo "factory#2 \n";
 $dbn = Db::factory();
 print $dbn->db;
 echo 'last line \n';
?>
