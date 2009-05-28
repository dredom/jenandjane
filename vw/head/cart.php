<?php
 $continue = isset($cf) ? $cf : 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
 $biz = ENV == 'development' ? 'untied_1238972877_biz@gmail.com' : "jane@jenandjane.com";
 $dev = ENV == 'development' ? 'sandbox.' : '';
?>
 <form name="cart" target="paypal" action="https://www.<?php echo $dev?>paypal.com/cgi-bin/webscr" method="post"> 
	<input type="hidden" name="business" value="<?php echo $biz?>"> 
	<!-- Specify a PayPal Shopping Cart View Cart button. --> 
	<input type="hidden" name="cmd" value="_cart"> 
	<input type="hidden" name="display" value="1"> 
	<input type="hidden" name="shopping_url" value="<?php echo $continue?>"> 
 </form> 