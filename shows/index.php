<?php
 session_start();
?>
<html>
<head><title>Jen + Jane - Shows</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Gems, Jewels and Designs by Jen and Jane, featuring original designs for bracelets in semi-precious stones, gold and silver." />
 <meta name="keywords" content="designer jewelry, Jen, Jane, published, shows, sell, sale, necklace, earring, bracelet, semi precious" />
 <link rel=StyleSheet href="/css/style.css" type="text/css">
 <style type="text/css">
  .area {
  	width: 100%;
    border-top: 1px solid #ffbebe;
  	padding: 3px;
  	padding-top: 5px;
  	clear:both;
  }
  .location {
  	vertical-align:top;
  	padding: 3px;
  	clear:both;
  }
  .where {
  	width: 50%;
  	float:left;
  }
  .when {
  	width: 50%;
  	float: right;
  }
  ul {
   list-style-type: circle;
   margin-left: 20px;
   padding-left: 0px;
  }
 </style>
</head>
<body  leftmargin=0 topmargin=0 marginheight=0 marginwidth=0>
<div id="page">

 <br>
 <?php require('../vw/head/logo.php'); ?>
 <br>

 <h1 class=heading>shows</h1>

<?php
 define("SITE","shows");
 require '../jewel/Cacher.class.php';
 require('../vw/head/nav.php');
?>


 <div class="area">
  <b> Glendale</b>

  <div class="location">
   <div class="where">
    <ul><li><i>Glendale Center</i><br>
            611 N. Brand Bl.<br/>
            Glendale, CA 91203<br>
         </li>
    </ul>
   </div>
   <div class="when">
    <ul>
     <li>(Pending)
     </li>
    </ul>
   </div>


 <div class="area">
  <b> Manhattan Beach</b>
  <div class="location">
   <div class="where">
    <ul><li><i>The Loft</i><br>
            1015 Manhattan Avenue<br>
            Manhattan Beach, CA 90266<br>
            (818) 297-9000
         </li>
    </ul>
   </div>
   <div class="when">
    <ul>
     <li>(Pending)
     </li>
    </ul>
   </div>
  </div> <!-- location -->
 </div> <!-- area -->


 <div class="area">
  <b> Stevenson Ranch</b>
  <div class="location">
   <div class="where">
    <ul><li><i><a href="http://nailforum.com">The Nail Forum</a></i> <br/>
            24931 Pico Canyon Road<br>
            Stevenson Ranch, CA 91381<br>
			(661) 799-9940
         </li>
    </ul>
   </div>
   <div class="when">
    <ul>

     <li>December 17<sup>th</sup> <br>
     Saturday 10am - 5pm
     </li>
    
    </ul>
   </div>
  </div> <!-- location -->
 </div> <!-- area -->

 <div class="area">
  <b> Toluca Lake</b>
  <div class="location">
   <div class="where">
    <ul><li><i>A Tamara Dahill Salon</i><br>
            10216 Riverside Drive<br>
            Toluca Lake, CA 91602<br>
            (818) 752-6567
         </li>
    </ul>
   </div>
   <div class="when">
    <ul>
     <li>(Pending) <br>
     </li>
    </ul>
   </div>
  </div> <!-- location -->
 </div> <!-- area -->

 <div class="area">
  <b> Valencia</b>
  <div class="location">
   <div class="where">
    <ul><li><i>The Nail Forum</i><br>
            24216 Valencia Bl<br>
            Valencia, CA 91355<br>
			(818) 297-9000
         </li>
    </ul>
   </div>
   <div class="when">
    <ul>
     <li>(Pending) <br>
     </li>
    </ul>
   </div>
  </div> <!-- location -->
 </div> <!-- area -->


 <div class="area">
  <b> Orange County</b>
  <div class="location">
   <div class="where">
    <ul><li>South Coast Plaza<br>
            <i>Jo Malone</i> <br>
            3333 Bristol St. Suite 2881 <br>
            Costa Mesa, CA 92626<br>
			(949) 645-8123
         </li>
    </ul>
   </div>
   <div class="when">
    <ul>
     <li>(Pending) <br>
     </li>
    </ul>
   </div>
  </div>
  <div class="location">
   <div class="where">
    <ul><li>South Coast Plaza<br>
            <i>Molton Brown</i> <br>
            3333 Bristol St. Suite 2860 <br>
            Costa Mesa, CA 92626<br>
			(714) 549 5951
         </li>
    </ul>
   </div>
   <div class="when">
    <ul>
     <li>(Pending) <br>
     </li>
    </ul>
   </div>
  </div>
 </div> <!-- area -->


 <div class="area">&nbsp;</div>

<?php require('../vw/foot/footer.php'); ?>

</div>	<!-- page -->
</body>
</html>
