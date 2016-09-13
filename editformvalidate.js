// JavaScript Document
// JavaScript Document
function validate()
{
	var attn = document.getElementById('attention');
	var refNo = document.getElementById('refNo');
	var delivery = document.getElementById('delivery');
	var terms = document.getElementById('terms');
	var tprice = document.getElementById('totalprice');
	var transDesc = document.getElementById('transDesc');
	
	transDesc.value = white_space(transDesc);
	attn.value = white_space(attn);
	refNo.value = white_space(refNo);
	
	var alphaExp = /^[0-9a-zA-Z. -]+$/;
	if(transDesc.value=='')
	{
		alert('You must enter a DESCRIPTION for this Transaction!');
		transDesc.focus();
		return false;
	}
	else
	{
		if(!attn.value.match(alphaExp) || attn.value.length == 0)
		{
			alert('Enter value for ATTENTION field!');
			attn.focus();
			return false;
		}
		else
		{
			if(refNo.value.length == 0)
			{
				alert('Please enter REFERENCE NUMBER!');
				refNo.focus();
				return false;
			}
			else
			{
				if(tprice.value == 0.00)
				{
					alert('A product is needed to complete transaction!');
					return false;
				}
				else
				{
					var condi = igit();
					return condi;
				}
			}
		}
	}
}
