// JavaScript Document
//functions 2
// includes     validateSubForm function
function validateSubForm(form)
{
	var valid = false; // will be return.. if all values are valid, then this will have a value of TRUE
	var itemList = $('itemList');
	var um; // unit of measure
	var desc; // description
	var sp;
	var amount;
	var unitDiv; // div that contains unit
	var descDiv; // div that contains descript
	
	var valid = true;// true when initialized and all values are valid and false if any value is invalid
	
	for(var a = 0; a < y; a++)
	{	
		unitDiv = itemList.childNodes[a].childNodes[2];
		descDiv = itemList.childNodes[a].childNodes[3];
		
		um = itemList.childNodes[a].childNodes[2].firstChild;
		desc = itemList.childNodes[a].childNodes[3].firstChild;
		sp = itemList.childNodes[a].childNodes[4].firstChild;
		amount = itemList.childNodes[a].childNodes[8];
	
		um.value = white_space(um); // whiteSpaces
		desc.value = white_space(desc); // whiteSpaces
		sp.value = white_space(sp); // whiteSpaces
		
		if(amount.value > 0)
		{
			if(um.value.length == 0)
			{
				//errorStyle(unitDiv.id, um.id);
				alert('Please Enter Value For Unit');
				um.focus();
				valid = false;
				break;
			}
			else
			{
				noErrorStyle(unitDiv.id, um.id, a); // if value entered is valid
				if(desc.value.length == 0)
				{
					//errorStyle(descDiv.id, desc.id);
					alert('Please Enter Value For Description');
					desc.focus();
					valid = false;
					break;
				}
				else
				{
					//noErrorStyle(descDiv.id, desc.id, a); // if value entered is valid
					if(sp.value.length == 0 || isNaN(sp.value))
					{
						alert('Please Enter valid Supplier Price');
						sp.focus();
						valid = false;
						break;
					}
					else
					{
						valid = true;
					}
				} // end of desc value ELSE BLOCK
			} // end of um value ELSE BLOCK
		} // end of amount value ELSE BLOCK
	} // end of for-loop
	
	if(valid == true) // show TRANSACTION DIALOG BOX if valid is TRUE
	{
		showDialog($('transDesc').name,form);					
	}//end
	
	//alert(itemList.childNodes[0].childNodes[4].firstChild.id);
} // end of validateSubForm function

function errorStyle(d, t)
{
	var div = $(d);
	var txt = $(t);
	div.style.background = "#FF0033";
	txt.style.background = "#CCCC66";
	txt.style.color = "blue";
}

function noErrorStyle(d, t, a)
{
	a += 1;//add 1 to a variable to because it started from 0
	
	if(a%2==0)
	{
		bg1 = '#3399FF';
	}
	else
	{
		bg1 = '#99CC99';
	}
	
	var div = $(d);
	var txt = $(t);
	
	div.style.background = bg1;
	txt.style.background = 'white';
	txt.style.color = 'black';
}