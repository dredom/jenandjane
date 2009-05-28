<div id="purchase-panel">
	<?php 
		switch($site) {
			case 'neck':  $header = 'necklace'; break;
			case 'ear':   $header = 'earring'; break;
			case 'arm':   $header = 'bracelet'; break;
			case 'ankle': $header = 'anklet'; break;
			default: $header = "";
		}
	?>
	<div class="hd"> <?php echo $header?></div>
	<div class="bd">
	  <table><tr><td>
		<div class="overly">
			<img alt="picture" src="<?php echo $imgurl?>">
		</div>
		<div style="padding: 5px; clear: both;"> <?php /* below image */?>
			<div class="left">&nbsp;</div>
			<div class="right">
			
				<div class="left">
		    		<?php echo $item->code?> &nbsp; &nbsp;
				</div>
			
				<div class="right">
					<input type="submit" name="submit" border="0" value="Add to cart"
					onclick="javaScript:document.cartAdd.submit();" 
					title="PayPal - The safer, easier way to pay online"> 
				</div>
			
			</div>
			<div class="right" style="clear:both; margin:3px;">
				<input id="hide1" type="button" value="CANCEL" class="cancel">
			</div>
			<?php include 'pp_add-to-cart.php'?>
			<div style="clear: both"><b>UNDER CONSTRUCTION:</b> Web site purchasing coming soon!</div>
			<div>Please call Jane at 818-297-9000 to place an order for this item today.</div>
		</div>
		<?php /*
			Options dropdown in form.
	[BUY] button with form.
	<p>Log info, IP, item, price.
	Return URL from PayPal must log. What? 
	PayPal confirmation call URL must log confirmation, check price.
	</p>
	*/ ?>
	  </td></tr></table>
	</div> <?php /* bd */?>
</div>
