<?php
 // header("Location: /error.php");
 function errorHandler($error, $error_string, $filename, $line, $symbols) {
 	echo "error: \t $error \n";
 	echo "error_string: \t $error_string \n";
 	echo "filename: \t $filename \n";
 	echo "line: \t $line \n";
 	echo "symbols: \t $symbols \n";
 	
 }
?>
