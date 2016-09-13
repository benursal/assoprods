// JavaScript Document
function igit()
{
		var qty;
		var unt;
		var desct;
		var up;
		var amt;
	
		var y = 0;
	for(var x = 1; x < numofLines; x++)
	{
		qty = document.getElementById('qty'+x);
		unt = document.getElementById('unit'+x);
		desct = document.getElementById('descript'+x);
		up = document.getElementById('up'+x);
		amt = document.getElementById('amount'+x);
		if(amt.value != '')
		{
			var result = orderlineValidate(qty,unt,desct,up,amt);
			if(result == false)
			{
				break;
			}
			edit2(x);		
		}
	}
	return result;
}

function orderlineValidate(qty,unt,desct,up,amt)
{
		unt.value = white_space(unt);
		desct.value = white_space(desct);
		
		var alphaExp = /^[0-9.]+$/;
			if(qty.disabled == false)
			{
				var numericExpression = /^[0-9]+$/;
				if(qty.value.length == 0 || !qty.value.match(numericExpression))
				{
					alert('Enter Valid number for Quantity field!');
					qty.focus();
					qty.value = '';
					return false;
				}
				else
				{
					if(unt.value.length == 0)
					{
						alert('Please Enter value in UNIT field!');
						unt.value = '';
						unt.focus();
						return false;
					}
					else
					{
						if(desct.value.length == 0)
						{
							alert('You must enter PRODUCT DESCRIPTION!');
							desct.focus();
							return false;
						}
						else
						{
							if(up.value.length == 0 || !up.value.match(alphaExp))
							{
								alert('Please Enter Valid Price');
								up.value = '';
								up.focus();
								return false;
							}
							else
							{
								return true;
							}
						}
					}
				}
			}	
}
