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

				<div class="right"> <?php /* options - positions options to the right */ ?>
				
				<?php 
				$endj = sizeof($item->options);
				for ($j = 0; $j < $endj; $j++) {
					$option = $item->options[$j];
				?>
				  <div style="clear: both;">

					<div class="left">
			    		<?php echo $option->value?>
					</div>
					<div class="price">
			    		<?php echo '$', number_format($option->price, 2)?>
					</div>
				
					<div class="left">
						<a href="javaScript:addToCart(<?php echo $item->id?>,<?php echo $option->seq?>,'<?php echo $option->optiontype?>','<?php echo urlencode($option->value)?>',<?php echo $option->price?>,<?php echo $optionShipping[$option->seq]?>);"
							title="PayPal - The safer, easier way to pay online"> 
							purchase
						</a>
					</div>
			
				  </div>
				<?php } /* end $j options */?>
			
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
