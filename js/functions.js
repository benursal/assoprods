// JavaScript Document
//various functions
//includes 			validateMainForm function

var $ = document.getElementById; // '$' - dollar sign will be used to take the place of 'document.getElement method'

var ajax = createXmlHttp();

function white_space(field) // function that removes white spaces from the field
{
     field.value = (field.value).replace(/^\s*|\s*$/g,'');
	 return field.value;
}

function validateMainForm(form, field1, tp) // tp for type
{
	var f1 = $(field1); //f1 is custId if the form is QUOTATION and supId if the form is PURCHASE ORDER
	var attn = $('attention');
	var subj = $('subject');
	var refNo = $('refNo');
	var terms = $('terms');
	var delivery = $('delivery');
	var validity = $('validity');
	var formattedTotal = $('formattedTotal');
	
	attn.value = white_space(attn);
	subj.value = white_space(subj);
	refNo.value = white_space(refNo);
	
	if(f1.value == '') //  validate value for field 1
	{
		alert('Please Choose A '+tp);
		f1.focus();
	} // the end of FIELD 1 validation
	else
	{
		if(attn.value.length == 0)
		{
			alert('Please Enter Value for Attention Field');
			attn.focus();
		} // end of ATTENTION validation
		else
		{
			if(subj.value.length == 0)
			{
				alert('Please Enter Value for Subject Field');
				subj.focus();
			} // end of SUBJECT validation
			else
			{
				if(refNo.value.length == 0) // only used for Purchase Order Form
				{
					alert('Please Enter Reference Number');
					refNo.focus();
				}
				else
				{
					if(terms.value == '')
					{
						alert('Please Choose A Term');
						terms.focus();
					} // end of TERMS validation
					else
					{
						if(delivery.value == '')
						{
							alert('Please Choose A Delivery Type');
							delivery.focus();
						}
						else
						{
							if(validity.value == '')
							{
								alert('Please Choose A Validity Type');
								validity.focus();
							}
							else
							{
								if(formattedTotal.value == '0.00' || formattedTotal.value == '')
								{
									alert('You cannot continue if you have no items with AMOUNT');
								}
								else
								{
									validateSubForm(form);
								}
							} // end of VALIDITY ELSE block
						}// end of DELIVERY ELSE block
					} // end of TERMS ELSE block
				} // end of REF NO ELSE block
			} // end of SUBJECT ELSE block
		} // end of ATTENTION ELSE block
	} // end of FIELD 1 ELSE block
}

function refreshTransaction(url) // is called when refresh button is clicked
{
	var ans = confirm("Are you sure you want to refresh the contents of this form?");
	if(ans)
	{
		document.location = url;
	}
}

function cancelTransaction() // is called when cancel button is clicked
{
	var ans = confirm("Are you sure you want to cancel the preparation of this form?");
	if(ans)
	{
		document.location = 'index.php';
	}
}

function getName(t, id, targetName, targetAddress)
{
	var param = new Date().getTime();
	var url = 'getName.php?type='+t+'&param='+param+'&id='+id; // id is the value of the ID
	var targName = document.getElementById(targetName);
	var targAddress = $(targetAddress);
	
	ajax.open("GET", url, true);
	ajax.onreadystatechange = function()
	{
		var res;
		if(ajax.readyState == 4)
		{
			res = ajax.responseText.split("%");
			targName.value = res[0];
			targAddress.value = res[1];
		}
	}
	ajax.send(null);
}

