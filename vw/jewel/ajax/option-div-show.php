<?php /* -- optiondiv -- one product option with price - ajax response */ ?>
		<div style="clear: both;"
		<?php if ($authorized === true) { ?>
			id="<?php echo $divid?>show" class="txt" onclick="showEditOption(this, '<?php echo $ix?>', '<?php echo $divid?>');" title="Click to edit" 
		    		onmouseover="bgOn(this);" onmouseout="bgOff(this);"
		<?php } ?> 
		>
			<small>
				<div class="left">
		    		<?php echo $option->value?>
				</div>
				<div class="price">
		    		<?php echo $option->price != null ? '$' : '', number_format($option->price, 2)?>
				</div>
			</small>
		</div>
