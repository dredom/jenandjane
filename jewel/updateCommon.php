<?php
/*
 * updateCommon.php
 * Updates item text file - ajax call.
 * Created on Nov 23, 2008
 */
 function checkAuthorized() {
	 if (AUTHORIZED === true) {
	 	// authorized
	 } else {
	 	header('HTTP/1.0 401 Unauthorized');
	 	echo 'failed authorization';
	 	exit(401);
	 } 
 }
 function updateText($firstChar) { 
	 // Get the parameter values and update the file
	 $id = $_GET['id'];
	 $text = $_GET['text'];
	 
	 // Validate
	 $pos = strpos($id, $firstChar);
	 if ($pos === false || $pos != 0) {
	 	header('HTTP/1.0 400 Bad request');
	 	echo 'bad id';
	 	exit(400);
	 }
	 
	 // Build the file path
	 $file = TEXTPATH.$id.'.txt';
	
	 // Write to file
	 $fid = fopen($file, 'w');
	 $bytes = fwrite($fid, $text, 2048);	// max 2048
	 if ($bytes >= 0) {
	 	echo 'OK';
	 } else {
	 	header('HTTP/1.0 500 Write failure');
	 	echo 'error in write';
	 	exit(500);
	 }
	 fclose($fid);
 }
?>
