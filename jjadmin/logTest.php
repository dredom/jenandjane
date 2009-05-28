<?php
/*
 * Test Log.php
 * Created on Mar 9, 2008
 *
 */
 //include '../testConfig.php';
 $debug = true;
 define(TESTPATH, "../..");
 
 include TESTPATH . '/jjadmin/config.php';
 echo DOCPATH . "\n";
 error_reporting(E_ALL);
 
 echo 'E_USER_WARNING=' . E_USER_WARNING . '\n';
 
 include DOCPATH . '/jjadmin/Logger.php';
 $log = Logger::factory();
 $log->info("Hello world");
 trigger_error("Log a failure", E_USER_ERROR);
 $log = Logger::factory();
 $log->info("Feel good! Do good!! Be good!! Geeeeeeeeedi!");
?>
