<script language="JavaScript">
 <?php // * UPDATE description * ?>
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
	 	replaceDisplayValue(o.argument[0], o.argument[2]);
	 	showValue(o.responseText + ' ' + o.argument[1]);
	}; 
	 
 function callUpdate(ix, id, text) {
 	var args = [ix, id, text];
 	var sUrl = '/jewel/<?php echo $site?>/update.php?id=' + id + '&text=' + text ;
 	var callback = {
  		success:responseSuccess, 
	  	failure:responseFailure,
	  	argument:args
	} 
 	var transaction = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback); 
 }


 <?php /* ADD Option and Price */ ?>
 var optionCounter = 0;
 function showAddOption(i) {
	 	document.getElementById('addoption'+i).style.display = 'none';
	 	document.getElementById('optiondivadd'+i).style.display = 'block';
 	document.getElementById('value'+i).focus();
}
 function showAddOptionLink(i) {
	document.getElementById('value'+i).value = "";
	document.getElementById('price'+i).value = "";
 	document.getElementById('addoption'+i).style.display = 'block';
 	document.getElementById('optiondivadd'+i).style.display = 'none';
}
 function addOption(btn, i) {
	btn.disabled = true;
	var id = document.getElementById('id'+i).value;
	var seq = '';
	var code = document.getElementById('code'+i).value;
	var option = document.getElementById('option'+i).value;
	var value = document.getElementById('value'+i).value;
	var price = document.getElementById('price'+i).value;
	var ix = i + '-' + optionCounter++;	// make unique ix for later updates
	var params = {
		'id':id,
		'seq':seq,
		'code':code,
		'optiontype':option,
		'value':value,
		'price':price,
		'i':i,
		'ix':ix
	};
	callAjax('add_option.php', params, responseAddOptionSuccess);
	showAddOptionLink(i);
	btn.disabled = false;
 }

 var responseAddOptionSuccess = function(o){ 
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
	var i = o.argument.i;
	var ix = o.argument.ix;
	var optdiv = new YAHOO.widget.Module("optiondivnew"+ix);
	optdiv.setBody(o.responseText);
	var el = document.getElementById('optionsdiv'+i); // add optiondiv to this
	optdiv.render(el);
		
 	showValue(o.argument.code + ' ' + o.statusText);
 }; 
	 

 <?php /* UPDATE option and price */ ?>
 function showEditOption(obj, ix, divid) {
	 	obj.style.display = 'none';
	 	document.getElementById(divid+'edit').style.display = 'block';
	 	document.getElementById('value'+ix).focus();
	 }
 function saveOptionEdits(btn, ix, divid) {
	btn.disabled = true;
	//alert('divid '+divid);
	var id = document.getElementById('id'+ix).value;
	var seq = document.getElementById('seq'+ix).value;
	var code = document.getElementById('code'+ix).value;
	var option = document.getElementById('option'+ix).value;
	var value = document.getElementById('value'+ix).value;
	var price = document.getElementById('price'+ix).value;
	if (seq == null || seq == '')
		seq = 0;
	var params = {
		'id':id,
		'seq':seq,
		'code':code,
		'optiontype':option,
		'value':value,
		'price':price,
		'ix':ix,
		'divid':divid	// to be replaced
	};
	callAjax('update_option.php', params, responseUpdateOptionSuccess);
	endOptionEdit(ix, divid);
	btn.disabled = false;
 }
 function endOptionEdit(ix, divid) {
 	document.getElementById(divid+'edit').style.display = 'none';
 	document.getElementById(divid+'show').style.display = 'block';
 }

 var responseUpdateOptionSuccess = function(o){ 
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
	 	//replaceDisplayOptionValues(o.argument);
	 	var divid = o.argument.divid;
	 	document.getElementById(divid).innerHTML = o.responseText;
	 	
	 	showValue(o.argument.code + ' ' + o.statusText);
 }; 

</script>
