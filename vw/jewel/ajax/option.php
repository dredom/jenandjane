<?php /* option div - ajax response */
 if (isset($option) && ($option != null)) {
	 $divid = 'optiondiv' . $ix;
?>
	<div id="<?php echo $divid?>">
	<?php 
	 include 'option-div-show.php';
	 include 'option-div-edit.php';
	?>
	</div>
	
<?php } /* option != null */?>