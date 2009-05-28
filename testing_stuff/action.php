
<html>
<head>
<title>Form result</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#FF9966" vlink="#FF9966" alink="#FFCC99">

Hi <?php echo $_POST['name']; ?>.
You are <?php echo $_POST['age']; ?> years old.

<p>
<?php echo "DOCUMENT_ROOT=" . $DOCUMENT_ROOT . "<br>"?>
<?php echo "_SERVER[DOCUMENT_ROOT]=" . $_SERVER["DOCUMENT_ROOT"] . "<br>" ?>
<?php $docpath = $_SERVER['DOCUMENT_ROOT'];
 define(DOCPATH, $docpath.'/');
 print DOCPATH . "<br>";
 define(IMGPATH, DOCPATH.'img/');
 print IMGPATH ."<br>";
 ?>
</p>
</body>
</html>
  
