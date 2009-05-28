<?php /* add new option - ajax response */ 
 $ix = $_GET['count'];
 $name = $_GET['name'];
 $value = $_GET['value'];
?>
			<div id="optionedit<?php echo $ix?>" class="hidden">
				<div class="left">
		    		<input type="text" id="option<?php echo $ix?>" value="length" size="7" READONLY/>
				</div>
				<div class="left">
		    		<input type="text" id="value<?php echo $ix?>" value="<?php echo $name?>" size="7"/>
				</div>
				<div class="price">
		    		$<input type="text" id="price<?php echo $ix?>" value="<?php echo $value?>" size="7"/>
				</div>
		 		<br>
				<div align="center">
		 			<input type="hidden" id="id<?php echo $ix?>" value="<?php echo '123'?>" />
		 			<input type="hidden" id="seq<?php echo $ix?>" value="<?php echo $ix?>" />
		 			<input type="hidden" id="code<?php echo $ix?>" value="<?php echo 'n001-prl-ss'?>" />
		 			<input type="button" value="SAVE" onclick="saveOptionEdit(this, '<?php echo $ix?>');" style="color: firebrick; background-color: lightskyblue;">
			 		<input type="button" value="CANCEL" onclick="endOptionEdit('<?php echo $ix?>');" style="color: grey; background-color:lightgrey;">
				</div>
			</div>
