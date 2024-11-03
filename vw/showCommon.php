<?php
 
 require 'head/header.php';

 $data['page1'] = ($show->page == 1);
 $pageUrl = $_SERVER['PHP_SELF'].'?page=';
 $nextPage = $show->nextPageNumber();
 $prevPage = $show->page <= 1 ? NULL : $show->page - 1;
 
 //var_dump($show);
 
 echo <<<EOB
 <div class=pagenav>
EOB;

 if ($prevPage == NULL) echo <<<EOB
   &laquo;&laquo;
EOB;
 else echo <<<EOB
   <a href="{$pageUrl}$prevPage" title="previous page">&laquo;&laquo;</a>
EOB;
 for ($pg=1; $pg<=$show->lastPage; $pg++) {
    if ($show->page == $pg) echo <<<EOB
      <b>$pg</b>
EOB;
    else echo <<<EOB
      <a href="{$pageUrl}$pg" title="go to page number $pg">$pg</a>
EOB;
 }

 if ($nextPage == NULL) echo <<<EOB
 	&raquo;&raquo;
EOB;
 else echo <<<EOB
 	<a href="{$pageUrl}$nextPage" title="next page">&raquo;&raquo;</a>
EOB;

 echo <<<EOB
 </div>\n
 
 <table class=show>\n
EOB;

 // Start picture
 $pos = $show->firstPicNumForPage();
 $pic = $pics->get($pos);
 $i = 0;
 while ($pic != NULL && $i++ < 4) {
   $text = $pic->getText();	
   $trimmed = ltrim($text);
   if ($trimmed == '')
   	 $text = '&nbsp;';
   echo <<<EOB
  <tr>\n
   <td>\n
    <a href="$pic->large">
     <img src="$pic->small" border=0 title='Click for larger image'>\n
    </a>
   </td>\n
   <td width="100%">\n
EOB;
	if (AUTHORIZED === true) echo <<<EOB
    <div id="d{$i}" class="txt" onclick="edit(this, $i);" title="Click to edit" 
    		onmouseover="bgOn(this);" onmouseout="bgOff(this);">$text 
    </div>\n
    <div id="de{$i}" class="hidden">
     	<textarea id="text{$i}" class="txt-edit" style="width: 100%;">$text</textarea>
 		<br>\n
 		<div align="center">
 			<input type="hidden" id="id{$i}" value="$pic->name" />
 			<input type="button" value="SAVE" onclick="saveEdit(this, $i);" style="color: firebrick; background-color: lightskyblue;">
	 		<input type="button" value="CANCEL" onclick="endEdit($i);" style="color: grey; background-color:lightgrey;">
 		</div>
    </div>
EOB;
	else echo <<<EOB
	   $text
EOB;
	echo <<<EOB
    &nbsp; <small>$pic->name</small>
   </td>\n
  </tr>\n
EOB;
   $pic = $pics->next();	// NEXT page
 }	// while

 echo <<<EOB
 </table>\n
 
EOB;

?>
<?php if (AUTHORIZED === true) { ?>
	<div id="msg"></div>
<script language="JavaScript">
 
 function edit(obj, ix) {
 	obj.style.display = 'none';
 	obj.className = 'hidden';
 	document.getElementById('de'+ix).className = 'txt-edit';
 	document.getElementById('text'+ix).focus();
 }
 function saveEdit(btn, ix) {
 	btn.disabled = true;
 	var id = document.getElementById('id'+ix).value;
 	var text = document.getElementById('text'+ix).value;
 	callUpdate(ix, id, text);
 	endEdit(ix);
 	btn.disabled = false;
 }
 function replaceDisplayValue(ix, val) {
 	var trimmed = val.replace(/^\s+|\s+$/g, '');
 	if (trimmed == '')
 		val = '&nbsp;';
 	document.getElementById('d'+ix).innerHTML = val;
 }
 function endEdit(ix) {
 	document.getElementById('de'+ix).className = 'hidden';
 	document.getElementById('d'+ix).className = 'txt';
 	document.getElementById('d'+ix).style.display = 'block';
 }
 function bgOn(obj) {
 	obj.className = 'txt-hilite';
 }
 function bgOff(obj) {
 	obj.className = 'txt';
 }
 
 function showValue(val) {
 	document.getElementById('msg').innerHTML = val;
 }

	var responseSuccess = function(o){ 
	/* Please see the Success Case section for more
	 * details on the response object's properties.
	 * o.tId
	 * o.status
	 * o.statusText
	 * o.getResponseHeader[ ]
	 * o.getAllResponseHeaders
	 * o.responseText
	 * o.responseXML
	 * o.argument
	 */ 
	 	replaceDisplayValue(o.argument[0], o.argument[1]);
	 	showValue(o.responseText + '<br>' + o.argument[0]);
	}; 
	 
	var responseFailure = function(o){ 
		showValue('Update failed: ' + o.status + ' ' + o.statusText);
	} 

 function callUpdate(ix, id, text) {
 	var args = [ix, text];
 	var sUrl = '/jewel/<?=SITE?>/update.php?id=' + id + '&text=' + text ;
 	var callback = {
  		success:responseSuccess, 
	  	failure:responseFailure,
	  	argument:args
	} 
 	var transaction = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback); 
 }
</script>
 <?php } ?>

<?php require 'foot/footer.php'; ?>

</div><!-- page -->
</body></html>