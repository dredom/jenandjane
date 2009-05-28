<?php
 // header("Location: /error.php");
 $DEBUG = false;
 if ($DEBUG) {
    include 'ehand.php';
	set_error_handler('errorHandler');
 }
 if (DUMBO != 'DUMBO')
 	echo DUMBO . " set\n";
 else
 	echo DUMBO . " not set\n";
 	
 if ($jo)
 	echo $jo;
 $jo = "hoopla";
 if ($jo)
 	echo $jo;
 
 echo "hello \n";
 trigger_error("Blowup!");
 echo E_ERROR;
 echo E_WARNING;
 //$j = 2 / 0;
?>
