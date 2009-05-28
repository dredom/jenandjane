<?php /* -- optiondivadd -- add product option with price */ ?>

		<?php if ($authorized === true) { ?>
			<div id="optiondivadd<?php echo $ix?>" class="hidden" style="clear: both;">
				<div class="left">
		    		<input type="text" id="option<?php echo $ix?>" value="length" size="7" READONLY/>
				</div>
				<div class="left">
		    		<input type="text" id="value<?php echo $ix?>" value="" size="7"/>
				</div>
				<div class="price">
		    		$<input type="text" id="price<?php echo $ix?>" value="" size="7"/>
				</div>
		 		<br>
				<div align="center">
		 			<input type="hidden" id="id<?php echo $ix?>" value="<?php echo $item->id?>" />
		 			<input type="hidden" id="seq<?php echo $ix?>" value="" />
		 			<input type="hidden" id="code<?php echo $ix?>" value="<?php echo $item->code?>" />
		 			<input type="button" value="SAVE" onclick="addOption(this, '<?php echo $ix?>');" style="color: firebrick; background-color: lightskyblue;">
			 		<input type="button" value="CANCEL" onclick="showAddOptionLink('<?php echo $ix?>');" style="color: grey; background-color:lightgrey;">
				</div>
			</div>
		<?php } ?>
