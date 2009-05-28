<?php /* -- optiondivedit -- one product option with price - ajax response */ ?>

		<?php if ($authorized === true) { ?>
			<div id="<?php echo $divid?>edit" class="hidden" style="clear: both">
				<div class="left">
		    		<input type="text" id="option<?php echo $ix?>" value="length" size="7" READONLY/>
				</div>
				<div class="left">
		    		<input type="text" id="value<?php echo $ix?>" value="<?php echo $option->value?>" size="7"/>
				</div>
				<div class="price">
		    		$<input type="text" id="price<?php echo $ix?>" value="<?php echo number_format($option->price, 2)?>" size="7"/>
				</div>
		 		<br>
				<div align="center">
		 			<input type="hidden" id="id<?php echo $ix?>" value="<?php echo $item->id?>" />
		 			<input type="hidden" id="seq<?php echo $ix?>" value="<?php echo $option->seq?>" />
		 			<input type="hidden" id="code<?php echo $ix?>" value="<?php echo $item->code?>" />
		 			<input type="button" value="SAVE" onclick="saveOptionEdits(this, '<?php echo $ix?>', '<?php echo $divid?>');" style="color: firebrick; background-color: lightskyblue;">
			 		<input type="button" value="CANCEL" onclick="endOptionEdit('<?php echo $ix?>', '<?php echo $divid?>');" style="color: grey; background-color:lightgrey;">
				</div>
			</div>
		<?php } ?>
