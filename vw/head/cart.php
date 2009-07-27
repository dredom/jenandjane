<?php
 $continue = 'http://' . $_SERVER['HTTP_HOST'];
 $continue .= isset($cf) ? $cf : $_SERVER['REQUEST_URI'];
?>
 <form name="cart" target="paypal" action="https://www.<?php echo shop_paypal_sandbox?>paypal.com/cgi-bin/webscr" method="post"> 
	<input type="hidden" name="business" value="<?php echo shop_biz_email?>"> 
	<!-- Specify a PayPal Shopping Cart View Cart button. --> 
	<input type="hidden" name="cmd" value="_cart"> 
	<input type="hidden" name="display" value="1"> 
	<input type="hidden" name="shopping_url" value="<?php echo $continue?>"> 
 </form> 