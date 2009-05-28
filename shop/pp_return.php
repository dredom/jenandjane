RETURN
<?php
 require '../init.php';
 print_r($_REQUEST);
 Logger::info("Return from PayPal checkout:" . $_SERVER['REMOTE_ADDR'])
?>