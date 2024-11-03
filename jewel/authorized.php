<?php
/*
 * authorized.php
 * Checks if admin user logged in TRUE if so.
 * 
 * Created on Nov 23, 2008
 */
 require(DOCPATH.'jjadmin/User.php');
 function authorized() {
	 if (isset($_SESSION['user'])) {
	 	$user = $_SESSION['user'];
	    $md5 = md5($user->id . date('YMD'));
	 	if ($md5 == $user->md5)
	 		return true;
	 }
	 return false;
 }
?>
