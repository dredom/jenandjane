<html>
<head><title>Jen + Jane - <?php echo $title?></title>
 <meta name="description" content="Jen and Jane - Gems, Jewels and Designs by Jane Rietman, featuring original designs in pearls, semi-precious stones, gold and silver." />
 <meta name="keywords" content="designer jewelry, Jen + Jane, pearl <?php echo $title?>, semi precious stone <?php echo $title?>, gold <?php echo $title?>, silver <?php echo $title?>" />

 <link rel=StyleSheet href="/css/style.css" type="text/css">

<!-- Combo-handled YUI CSS files: -->
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.7.0/build/base/base-min.css&2.7.0/build/container/assets/skins/sam/container.css">
<!-- Combo-handled YUI JS files: -->
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.7.0/build/yahoo-dom-event/yahoo-dom-event.js&2.7.0/build/animation/animation-min.js&2.7.0/build/connection/connection-min.js&2.7.0/build/dragdrop/dragdrop-min.js&2.7.0/build/container/container-min.js"></script>

 <?php if ($authorized === true) { ?>
 	<style>
 		<?php include(DOCPATH.'css/styleAdmin.css'); ?>
 	</style>
 <?php } ?>
 <style type="text/css">
  .left { float:left; }
  .right, .options { float:right; }
  .price {
  	float: left;
  	text-align: right;
  	width: 6em;
  	margin-right: 1em;
  }
 .txt-hilite div {
 	background-color: firebrick;
 }

 .options li {	<?php /* TODO each optiondiv */ ?>
 	clear: both;
 }

 <?php /* cart in nav */?>
 <?php if (Cacher::get('is_cart') === 'true') {?>
   .nav span {
   	font-weight: bold;
   }
 <?php }?>

 #image-ajax .yui-panel .overly {
 	border: thin solid #696969;
 }
 #image-ajax .yui-panel .hd {
 	background: #900000;
 	color: #FFCCFF;
 	font-weight: bold;
 	font-size: larger;
 	letter-spacing: 3pt;
 	height: 22px;
 	border-bottom: none;
 	opacity:0.7;  	filter:alpha(opacity=70);
 }
 #image-ajax .yui-panel .bd {
 	background: #B22222;
 	padding: 3px;
 }
 .yui-panel .bd TABLE {	<?php /* Table wraps to auto size */?>
 	display: inline;	<?php /* To kill the CR */?>
 }
 .yui-panel .bd TD {
 	border: 0 none;
 	padding: 0;
 }
 .purchase {
 	clear:both;
 	float:right;
 	margin-right: 1em;
 	font-size: smaller;
 }
 .purchaseButton {
 	color: #900000;
 	background-color: #FFCCFF;
 }
 .cancel {
 	color: #808080;
 	background-color: #D3D3D3;
 }
 </style>
</head>

<body  class="yui-skin-sam" leftmargin=0 topmargin=0 marginheight=0 marginwidth=0>
 <div id="page">

 <br>
 <?php require DOCPATH.'vw/head/logo.php'; ?>
 <br>

 <span class=heading><?php echo $title?></span>

<?php require DOCPATH.'vw/head/nav.php';?>
<?php require DOCPATH.'vw/head/cart.php';?>

<?php include $pageinclude?>

<?php require DOCPATH.'vw/foot/footer.php'; ?>

<?php if ($authorized === true) include 'update.js.php'?>

 </div> <?php /* page */?>
</body>
</html>
