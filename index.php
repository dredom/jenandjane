<?php
 session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Jen + Jane - Designer Jewelry</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Gems, Jewels and Designs by Jen and Jane, featuring original Jane Rietman designs for necklaces, earrings, anklets and braclets in semi-precious stones, gold and silver." >
 <meta name="keywords" content="jewelry, designer, Jen, Jane, earrings, necklace, bracelet, anklet, lariat, semi precious, gems, keshi, pearl, shell" >
 <link rel="StyleSheet" href="/css/style.css" type="text/css">
 <style type="text/css">
<!--
 .logo { font-size:30pt; }
 .logo-sub { font-size:13pt; }
 .nav { word-spacing: 7px; }
 .wordy { background-color: #990000; text-align: center; }
-->
 </style>
</head>
<body  leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<div id="page">
<br>

<br><br>
 <?php
    require 'init.php';
 	require('vw/head/logo.php');
 	require 'shop/shop.config.php';
 	require 'vw/head/cart.php';
 ?>
<br><br>

<div class="nav">
 home &middot;
 <a href="/contact">contact</a> &middot;
 <a href="shows">shows</a> &middot;
 <a href="news">news</a> &middot;
 <a href="stores">stores</a> &middot;
 <a href='javaScript:document.cart.submit()'><span>shopping&nbsp;cart</span></a>
</div>

<table class=pad_lr align="center" >
<!-- pictures -->
 <tr >
  <td class=pad_lr><a href="jewel/neck/index.php?page=8"><img src="img/n111-med-24k-sml.jpg"/></a></td>
  <td class=pad_lr><a href="jewel/ear/index.php?page=7"><img src="img/e100-cir-24k-sml.jpg"/></a></td>
  <td class=pad_lr><a href="jewel/arm/index.php?page=4"><img src="img/b400-lts-24kgp-sml.jpg"/></a></td>
  <td class=pad_lr><a href="jewel/ankle/index.php?page=2"><img src="img/a303-shl-ss-sml.jpg"/></a></td>
 </tr>
 <tr><td colspan="4" ><img src="img/nada.gif" class=img_line></td>
 </tr>
<!-- descriptions -->
 <tr>
  <td class=pad_lr><div class=wordy><a href="jewel/neck/">necklaces</a></div></td>
  <td class=pad_lr><div class=wordy><a href="jewel/ear/">earrings</a></div></td>
  <td class=pad_lr><div class=wordy><a href="jewel/arm/">bracelets</a></div></td>
  <td class=pad_lr><div class=wordy><a href="jewel/ankle/">anklets</a></div></td>
 </tr>
 <tr><td colspan="4" ><img src="img/nada.gif" class=img_line></td>

</table>

<br/>


  <p align="center">
   <span class=heading><a href="special">* web site special *</a></span>
  </p>
  <?php include 'vw/foot/footer.php'?>

</div>
</body>
</html>
