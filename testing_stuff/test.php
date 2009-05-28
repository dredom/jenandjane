<?php
/*
 * Created on Nov 15, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 define('GERONIMO', true);
 if (GERONIMO === true) echo 'geronimo';
 else echo 'no geronimo';
 echo 'GERONIMO=' . GERONIMO;
 $name = 'Jeremy';
 $count = 2;
 $colors = array("blue", "pink");
 $pg = <<< page_text
 Hello $name!
page_text;
?>
<html><body>
 <p>Hello <?=$name?>!</p>
 <?php if ($count == 2) { ?>
 	The count is 2.
 <?php } ?>
 <?php for ($i = 0; $i < sizeof($colors); $i++) echo <<<EOB
 	<li>$i - $colors[$i]</li>\n
EOB;
 ?>
 <?php
 class Temy {
 	var $val = 'foo';
 	function getVal() {
 		return $this->val;
 	}
 }
 $tem1 = new Temy();
 echo <<<EOB
  TEMY: $tem1->getVal()
  temy: {$count} 
EOB;
 echo $tem1->getVal();
 ?>
 
  <hr size="2">
  <?= <<<EOB
  <p>hello</p>
EOB;
  ?>
  
</body>
</html>