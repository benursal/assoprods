// JavaScript Document
function validate()
{
	var supplier = document.getElementById('supplier');
	var attn = document.getElementById('attention');
	var refNo = document.getElementById('refNo');
	var delivery = document.getElementById('delivery');
	var terms = document.getElementById('terms');
	var prepared = document.getElementById('prepared');
	var tprice = document.getElementById('totalprice');
	var transDesc = document.getElementById('transDesc');
	
	transDesc.value = white_space(transDesc);
	attn.value = white_space(attn);
	refNo.value = white_space(refNo);
	prepared.value = white_space(prepared);

	if(supplier.value == 0)
	{
		alert('You must choose supplier!');
		supplier.focus();
		return false;
	}
	else
	{
		var alphaExp = /^[0-9a-zA-Z. -]+$/;
		if(!attn.value.match(alphaExp))
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
				if(!delivery.value.match(alphaExp))
				{
					alert('Please Choose DELIVERY TYPE!');
					delivery.focus();
					return false;
				}
				else
				{
					if(!terms.value.match(alphaExp))
					{
						alert('You forgot to fill up TERMS!');
						terms.focus();
						return false;
					}
					else
					{
						if(!prepared.value.match(alphaExp) || prepared.value=='')
						{
							alert('Who is preparing this Purchase Order Form?');
							prepared.focus();
							return false;
						}
						else
						{
							if(transDesc.value=='')
							{
								alert('You must enter a DESCRIPTION for this Transaction!');
								document.getElementById('descrip').style.display = 'block';
								transDesc.disabled = false;
								transDesc.focus();
								document.getElementById('desccheck').checked = true;
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
			}
		}
	}
}