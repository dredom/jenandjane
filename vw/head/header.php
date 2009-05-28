<html>
<head><title>Jen + Jane - <?php echo $title?></title>
 <meta name="description" content="Gems, Jewels and Designs by Jen and Jane, featuring original designs for anklets in semi-precious stones, gold and silver." />
 <meta name="keywords" content="jewelry, designer, Jen, Jane, anklets, semi precious, gold, silver, chain" />
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

 <span class=heading><?php echo $title?></span>

<?php
 require('nav.php');
?>
