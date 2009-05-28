
<html>
<head>
<title>Renamer</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#FF9966" vlink="#FF9966" alink="#FFCC99">
  
<?php
/*
 * Created on May 6, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  $old = $_GET['old'];
  $new = $_GET['new'];
 $rc = rename($old, $new);
 if ($rc) { print "Renamed " . $old . " to " . $new; }
 else { print "Failed! "; }
?>
<hr/>
<?php 
 $dir = dir(".");
?>

</body>
</html>
