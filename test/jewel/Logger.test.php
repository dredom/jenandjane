<?php
/*
 * Test cases for ProductDataManager.
 */

include 'base.test.php';

// Setup
include '../../init.php';
//include '../../jewel/Logger.class.php';
$_SERVER['REMOTE_ADDR'] = 'localhost';
echo DOCPATH, ' ', LOGFILE, "\n";

test('doLogger');

function doLogger() {
	Logger::info("Start Logger of unit test...");
	for ($i = 0; $i < 10; $i++) {
		Logger::info("Line number $i with a lot of data on a sunny sunday afternoon in the Wasach valley of the plains.");
	}
	Logger::info("End of Logger unit test.");
}

?>