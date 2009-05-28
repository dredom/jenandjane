<?php
 $biz = ENV == 'development' ? 'untied_1238972877_biz@gmail.com' : "jane@jenandjane.com";
 $dev = ENV == 'development' ? 'sandbox.' : '';
?>
cf=<?php echo $cf?>
 <form name="cartAdd" target="paypal" action="https://www.<?php echo $dev?>paypal.com/cgi-bin/webscr" method="post"> 
	<input type="hidden" name="business" value="<?php echo $biz?>"> 
	<!-- Specify a PayPal Shopping Cart View Cart button. --> 
	<input type="hidden" name="cmd" value="_cart"> 
	<input type="hidden" name="add" value="1">
	<input type="hidden" name="item_name" value="Pearl necklace">
	<input type="hidden" name="item_number" value="n123-prl-14k">
	<input type="hidden" name="amount" value="165.00">
	<input type="hidden" name="no_shipping" value="0">
	<input type="hidden" name="no_note" value="1"><?php /* no note */?>
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="bn" value="JenAndJane_AddToCart_Necklace_US">
	<input type="hidden" name="notify_url" value="http://www.jenandjane.com/shop/pp_notify.php"><?php /* TODO set IPN URL in profile, not here */?>
	<input type="hidden" name="custom" value="<?php echo ENV?>">
	<input type="hidden" name="cancel_return" value="<?php echo $cf?>">
	<input type="hidden" name="no_shipping" value="2"><?php /* require shipping address */?>
	<input type="hidden" name="return" value="http://www.jenandjane.com/shop/pp_return.php?cf=<?php echo $cf?>">
	<input type="hidden" name="rm" value="2"><?php /* POST with all params */?>
	<img alt="" border="0" src="https://www.<?php echo $dev?>paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
 </form> 
<!-- 
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
 -->