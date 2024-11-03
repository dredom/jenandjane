
 <div class=pagenav>

 <?php // initialize
 	$prevPage = $thisPage <= 1 ? NULL : $thisPage - 1;
 	$nextPage = $thisPage < $show->lastPage ? $thisPage + 1 : NULL;
 ?>
 
 <?php if ($prevPage == NULL) {?>
   &laquo;&laquo;
 <?php } else { ?>
   <a href="<?php echo "{$pageUrl}?page=$prevPage"?>" title="previous page">&laquo;&laquo;</a>
 <?php }?>
 <?php 
 for ($pg=1; $pg <= $show->lastPage; $pg++) {
    if ($thisPage == $pg)
      echo "<b>$pg</b>";
    else { ?>
      <a href="<?php echo "{$pageUrl}?page=$pg"?>" title="go to page <?php echo $pg?>"><?php echo $pg?></a>
 <?php } }?>

 <?php if ($nextPage == NULL) { ?>
 	&raquo;&raquo;
 <?php } else { ?>
 	<a href="<?php echo "{$pageUrl}?page=$nextPage"?>" title="next page">&raquo;&raquo;</a>
 <?php }?>

 </div> <!-- pagenav -->
 
 <table class=show>
<?php 
	$endi = $firstPicNumForPage + $show->perPage;
	$endi = $endi < sizeof($show->items) ? $endi : sizeof($show->items);
	for ($i = $firstPicNumForPage; $i < $endi; $i++) {
		$item = $show->items[$i];
		$text = ltrim($item->description);
		if ($text == '')
			$text = '&nbsp;';	
?>
  <tr>
   <td>
    <a href="javascript:getLargeImage('<?php echo $item->imageLargeUrl?>');">
     <img src="<?php echo $item->imageSmallUrl?>" border=0 title='Click for larger image'>
    </a>
   </td>
   <td width="100%">

<?php if ($authorized === true) { // * description text * ?>
    <div id="d<?php echo $i?>" class="txt" onclick="edit(this, <?php echo $i?>);" title="Click to edit" 
    		onmouseover="bgOn(this);" onmouseout="bgOff(this);"><?php echo $text?> 
    </div>
    <div id="de<?php echo $i?>" class="hidden">
     	<textarea id="text<?php echo $i?>" class="txt-edit" style="width: 100%;"><?php echo $text?></textarea>
 		<br>
 		<div align="center">
 			<input type="hidden" id="id<?php echo $i?>" value="<?php echo $item->id?>" />
 			<input type="hidden" id="code<?php echo $i?>" value="<?php echo $item->code?>" />
 			<input type="button" value="SAVE" onclick="saveEdit(this, <?php echo $i?>);" style="color: firebrick; background-color: lightskyblue;">
	 		<input type="button" value="CANCEL" onclick="endEdit(<?php echo $i?>);" style="color: grey; background-color:lightgrey;">
 		</div>
	</div>
<?php } else { ?>
	<div style="margin-bottom: 3px">
	   <?php echo $text?> 
	</div>
<?php } ?>

	<div> <?php /* item code and options */ ?>
		<div class="left">
	    	&nbsp; <small><?php echo $item->code?></small>
	    </div>

		<div class="right"> <?php /* options - positions options to the right */ ?>
			<div id="optionsdiv<?php echo $i?>" class="right"> <?php /* Used by YUI to add an optiondiv */?>
	    
			<?php 
			$endj = sizeof($item->options);
			for ($j = 0; $j < $endj; $j++) {
				$option = $item->options[$j];
				$ix = $i . '_' . $j;
			?>
	
				<?php include 'ajax/option.php'?>		<?php /* optiondiv$ix */?>
	
			<?php } 	/* for $j */ ?>
	
			</div> <?php /* optionsdiv */?>
			
		<?php if ($authorized === true) { /* Add new option form - floats below optiondivs */?>
			<?php $ix = $i;?>
			<div id="addoption<?php echo $ix?>" style="clear: both">
				<small><a href="javascript:showAddOption('<?php echo $ix?>');" >add new</a></small>
			</div>
			<?php include 'ajax/option-div-add.php'?>
		<?php } else { ?>
			<?php 
				$hasPrice = ($item->options != null) && (sizeof($item->options) > 0);
			?>
			<?php if ($hasPrice) {?>
			<div class="purchase">
				<a href="javascript:getPurchaseDialog(<?php echo $item->id?>,'<?php echo $item->imageLargeUrl?>')">purchase</a>
			</div>
			<?php }?>
		<?php }?>
		
			
		</div> <?php /* options */ ?>
	
	</div> <?php /* item code and options */ ?>
	
   </td>
  </tr>
<?php  }	/* for $i */ ?>

 </table>
 
<?php if ($authorized === true) { ?>
	<div id="msg"></div>
<?php }?>

	<div id="image-ajax" class="overly"></div>

<script language="JavaScript">
 var imagePanel;	<?php /* save for destroy() b4 next call */?>
 
 YAHOO.namespace("image");

 function showLargeImage(divid) {
	//alert('showLargeImage');
	YAHOO.image.panel1 = new YAHOO.widget.Panel('image-panel', {
		effect:{effect:YAHOO.widget.ContainerEffect.FADE,duration:0.25}
		 } );
	YAHOO.image.panel1.center();
	YAHOO.image.panel1.render();
	YAHOO.image.panel1.show();

	imagePanel = YAHOO.image.panel1;	// save panel reference
 }

 var responseLargeImageSuccess = function(o) {
	var divid = o.argument.divid;
	document.getElementById(divid).innerHTML = o.responseText;
	showLargeImage(divid);
 }; 

 function getLargeImage(imgurl) {
  	//alert('getLargeImage('+imgurl+', '+divid+')');
  	var objImage = new Image().src = imgurl;		// preload for center()
  	if (imagePanel != null) {
  	  	imagePanel.destroy();	// initialize
  	}
  	var divid = 'image-ajax';
	var params = {
		'imgurl':imgurl,
		'divid':divid	// to be replaced
	};
	callAjax('show_image.php', params, responseLargeImageSuccess);
 }


 var responseShowPurchaseSuccess = function(o) {
	var divid = o.argument.divid;
	document.getElementById(divid).innerHTML = o.responseText;
	showPurchaseDialog(divid);
 }; 

 <?php /* Show the purchase panel for an item */?>
 function getPurchaseDialog(id, imgurl) {
  	//alert('getLargeImage('+imgurl+', '+divid+')');
  	new Image().src = imgurl;		// preload for center()
  	if (imagePanel != null) {
  	  	imagePanel.destroy();	// initialize
  	}
  	var divid = 'image-ajax';
	var params = {
		'id':id,
		'imgurl':imgurl,
		'divid':divid,	// to be replaced
		'cf':'<?php echo $cf?>'
	};
	callAjax('show_purchase.php', params, responseShowPurchaseSuccess);
 }


 function showPurchaseDialog(divid) {
	//alert('showPurchaseDialog');
	YAHOO.image.panel1 = new YAHOO.widget.Panel('purchase-panel', {
		modal:true,
		effect:{effect:YAHOO.widget.ContainerEffect.FADE,duration:0.25}
		 } );
	YAHOO.image.panel1.center();
	YAHOO.image.panel1.render();
	YAHOO.util.Event.addListener("hide1", "click", YAHOO.image.panel1.hide, YAHOO.image.panel1, true);
	YAHOO.image.panel1.show();
	imagePanel = YAHOO.image.panel1;	// save panel reference
 }

 <?php /* Common Ajax functions */?>
 var responseFailure = function(o){ 
	var val = 'Failed: ' + o.status + ' ' + o.statusText;
	document.getElementById('msg').innerHTML = val;
 };
 
 function callAjax(url, params, successFunction) {
	var getUrl = '/jewel/<?php echo $site?>/' + url + '?';
	for (param in params) {
		getUrl += param + '=' + params[param] + '&';
	}
	var callback = {
 	  		success:successFunction, 
 		  	failure:responseFailure,
 		  	argument:params
 	};
 	var transaction = YAHOO.util.Connect.asyncRequest('GET', getUrl, callback); 
 } 

 <?php /* Form cartAdd is in pp_add-to-cart.php */?>
 function addToCart(productid, seq, optiontype, value, price, shipping) {
   document.cartAdd.on0.value = optiontype;
   document.cartAdd.os0.value = value;
   document.cartAdd.amount.value = price;
   document.cartAdd.custom.value = 'productid='+productid;
   document.cartAdd.shipping.value = shipping;
   document.cartAdd.submit();
 }
 
</script>