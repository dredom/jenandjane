<html>
<head><title>Jen + Jane - <?php echo $title?></title>
 <meta name="description" content="Gems, Jewels and Designs by Jen and Jane, featuring original designs in pearls, semi-precious stones, gold and silver." />
 <meta name="keywords" content="designer jewelry, Jen + Jane, necklaces, earrings, anklets, semi precious, gold, silver, pearls, chain" />
 <link rel=StyleSheet href="/css/style.css" type="text/css">
 <?php
 	if (AUTHORIZED === true) {
 		echo '<style>';
 		include(DOCPATH.'css/styleAdmin.css');
 		echo '</style>';
 		include(DOCPATH.'js/yuiconnector.script');	// for ajax
 	}
 ?>
</head>
<body  leftmargin=0 topmargin=0 marginheight=0 marginwidth=0>
<div id="page">

 <br>
 <?php require 'logo.php'; ?>
 <br>

 <h1 class=heading><?php echo $title?></h1>

<?php
 require('nav.php');
?>
