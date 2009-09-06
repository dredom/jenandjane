<?php
 //require '../../../init.php';
 
 $_SERVER['REQUEST_URI'] = "/";
 $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
 include '../jewel/base.test.php';
 include '../../jjadmin/generate_config.php';
 
 test('missingParam');
 test('neck');
 test('badParam');
 
 function missingParam() {
	unset($_GET['site']);
	doit();
 }
 function neck() {
	$_GET['site'] = "arm";
	doit();
 }
 function badParam() {
	$_GET['site'] = "badone";
	doit();
 }
?>