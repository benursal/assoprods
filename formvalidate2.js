// JavaScript Document

function orderlineValidate()
{
	for(var x = 1; x <= numofLines; x++)
	{
		var qty = document.getElementById('qty'+x);
		var unt = document.getElementById('unit'+x);
		var desct = document.getElementById('descript'+x);
		var up = document.getElementById('up'+x);
		var amt = document.getElementById('amount'+x);
		
		unt.value = white_space(unt);
		desct.value = white_space(desct);
		
		var alphaExp = /^[0-9.]+$/;
		if(amt.value.length != 0)
		{
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
						if(desct.value.length == 0 || !up.value.match(alphaExp))
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
								return false;
								up.value = '';
								up.focus();
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
	}
}