<?php
/*
 * Configuration values.
 * Created on Mar 9, 2008
 *
 */
 $docpath = $_SERVER["DOCUMENT_ROOT"];
 echo "[$docpath]";
 if ($docpath == "")
 	$docpath = TESTPATH;
 define(DOCPATH, $docpath);
 define(LOGFILE, DOCPATH . '/jjadmin/jj.log');
 error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);
 $db = 'jjdb';
 $user = 'jenjane';
 $password = 'gem24$';
?>
