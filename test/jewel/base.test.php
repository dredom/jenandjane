<?php
/*
 * Test case common setup.
 */

 function assert_callback( $script, $line, $message ) {
    echo '\nFAIL: ', $script,' line: ', $line, " $message \n";
    exit;
  }
// Set our assert options
assert_options(ASSERT_ACTIVE,    true);
assert_options(ASSERT_BAIL,     true);
assert_options(ASSERT_WARNING,     true);
assert_options(ASSERT_CALLBACK, 'assert_callback');


function test($function) {
	echo "Running $function ";
	try {
		call_user_func($function);
		echo " OK\n ";
	} catch (Exception $e) {
		echo " FAILED: ", $e->getMessage(), "\n ";
	}
}
?>