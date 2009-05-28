<?php
/*
 * login.php
 * This file is in secured directory requiring valid login.
 * We thus assume user is authorized.
 * Created on Jul 20, 2008
 */
 require('User.php');
 session_start();
 $rusr = $_SERVER['REMOTE_USER'];
 $name = 'Jane';
 $usr = new User($rusr, $name);
 $md5 = md5($rusr . date('YMD'));
 $usr->md5 = $md5;
 $_SESSION['user'] = $usr;
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#FF9966" vlink="#FF9966" alink="#FFCC99">
 
  <p>Remote user: <?=$rusr?> </p>
  
 Hello <?php print $usr->name; ?>
 <p>
  <a href='/'>Go to home page</a>
 </p>
 <?php
 if (isset($_SESSION['user'])) {
 	print "is set in " . session_id();
 	print "<br>";
 	//var_dump($nusr);
 	print "<br>";
 	print "Name:" . $_SESSION['user']->name;
 } else {
 	print "<p>not set</p>";
 }
 ?>
</body>
</html>
    