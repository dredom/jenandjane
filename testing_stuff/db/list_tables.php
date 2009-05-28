<?php
/*
 * Created on Dec 4, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require '../db/pconnect.php';
 $user = 'jenjane';
 $password = 'gem24$';
 db_pconnect($user, $password);
 
 $db = 'jjdb';
 
 print $db . "\n";
 $tbs = mysql_list_tables($db);
 $num = mysql_num_rows($tbs);
 for ($i = 0; $i < $num; $i++) {
 	print "\t" . mysql_tablename($tbs, $i) . "\n"; 
 }
 
  $user = 'jjdbuser';
 $password = 'jj24$';
 
 //mysql_close($connect); 
?>
