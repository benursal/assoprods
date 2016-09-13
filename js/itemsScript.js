// JavaScript Document

function checkKey(e)
{
	if(e.keyCode == 13)
	{
		document.getElementById('unit1').focus();
	}
}

function addItem(tType)
{
	var items = document.getElementById('itemList');
	
	x++;
	y++; // for item_no_i innerHTML only
	
	var itm = document.createElement("div");
	itm.setAttribute("id","item"+x);
	
	var c;
	if(y%2 == 0)
	{
		c = "items2";
	}
	else
	{
		c = "items";
	}
	itm.setAttribute("className",c);
	
	items.appendChild(itm);
	
	var tAreaCols = "37";
	var fUpWidth = "15";
	var index = 7;
	
	if(tType == 'q')
	{
		var sp = document.createElement("div");
		sp.setAttribute("id","supp_price_i"+x);
		sp.setAttribute("className","supp_price_i");
		sp.innerHTML = '';
		
		tAreaCols = "34";
		fUpWidth = "12";
		index = 8;
	}
	
	var itemNo = document.createElement("div");
	itemNo.setAttribute("id","item_no_i"+x);
	itemNo.setAttribute("className","item_no_i");
	itemNo.innerHTML = y;
	
	itm.appendChild(itemNo);
	
	var qty = document.createElement("div");
	qty.setAttribute("id","quantity_i"+x);
	qty.setAttribute("className", "quantity_i");
	
	itm.appendChild(qty);
	
	var um = document.createElement("div");
	um.setAttribute("id","unit_measure_i"+x);
	um.setAttribute("className","unit_measure_i");
	 
	itm.appendChild(um);
	
	var desc = document.createElement("div");
	desc.setAttribute("id","description_i"+x);
	desc.setAttribute("className","description_i");

	itm.appendChild(desc);
	
	var up = document.createElement("div");
	up.setAttribute("id","unit_price_i"+x);
	up.setAttribute("className","unit_price_i");
	up.innerHTML = '';
	
	if(tType == 'q')
	{
		itm.appendChild(sp);
		
		var sUp = document.createElement("input");
		sUp.setAttribute("id","sp"+x);
		sUp.setAttribute("name","sp[]");
		sUp.setAttribute("size","12");
		sUp.setAttribute("maxlength","20");
		
		sp.appendChild(sUp);
	}
	
	itm.appendChild(up);
	
	var amount = document.createElement("div");
	amount.setAttribute("id","amount_i"+x);
	amount.setAttribute("className","amount_i");
	amount.innerHTML = "P 0.00";
	
	itm.appendChild(amount);
	
	var actions = document.createElement("div");
	actions.setAttribute("id","actions_i"+x);
	actions.setAttribute("className","actions_i");
	
	itm.appendChild(actions);
	
	// form elements
	var fQty = document.createElement("input");
	fQty.setAttribute("id","qty"+x);
	fQty.setAttribute("name","qty[]");
	fQty.setAttribute("size","3");
	fQty.setAttribute("maxLength","5");
	fQty.onkeypress = function(){return isNumberKey(event);};
	//fQty is added to its container below after the fUp is created and onkeyup events of both are set//
	
	var fUnit = document.createElement("input");
	fUnit.setAttribute("id","unit"+x);
	fUnit.setAttribute("name","unit[]");
	fUnit.setAttribute("size","4");
	fUnit.setAttribute("maxLength","5");
	
	um.appendChild(fUnit);
	
	var fDesc = document.createElement("textarea");
	fDesc.setAttribute("id","descript"+x);
	fDesc.setAttribute("name","descript[]");
	fDesc.setAttribute("cols",tAreaCols);
	fDesc.setAttribute("rows","3");
	fDesc.setAttribute("wrap","hard");
	
	desc.appendChild(fDesc);
	
	var fHid = document.createElement("input"); //  hidden file that will contain the item REAL NUMBER
	fHid.setAttribute("type","hidden");
	fHid.setAttribute("id","hid"+x);
	fHid.setAttribute("name","hid[]");
	fHid.setAttribute("value",x);
	
	actions.appendChild(fHid);
	
	var fUp = document.createElement("input");
	fUp.setAttribute("id","up"+x);
	fUp.setAttribute("name","up[]");
	fUp.setAttribute("size",fUpWidth);
	fUp.setAttribute("maxlength","20");
	fUp.onkeyup = function(){calculate(event, this.id, fQty.id, amount.id, fHid.value, index);}; // up onkeyup
	
	fQty.onkeyup = function(){calculate(event, this.id, fUp.id, amount.id, fHid.value, index);}; // qty field Onkeyup event is set only after up field
	// is created since it needs as a parameter for the calculate function
	
	qty.appendChild(fQty); //qty added
	fQty.focus(); // set focus to qty textfield
	
	up.appendChild(fUp);// up added to unit price container
	
	
	var fAdd = document.createElement("a");
	fAdd.setAttribute("id","addItem"+x);
	fAdd.setAttribute("className","addItem");
	fAdd.setAttribute("href","#");
	fAdd.innerHTML = "+";
	fAdd.onclick = function(){addItem(tType);return false;}
	
	actions.appendChild(fAdd);
	
	var blank = document.createElement("span");
	blank.innerHTML = "&nbsp;";
	
	actions.appendChild(blank);
	
	var fRem = document.createElement("a");
	fRem.setAttribute("id","removeItem"+x);
	//fRem.setAttribute("className","removeItem");
	fRem.setAttribute("href","#");
	fRem.innerHTML = "-";
	fRem.onclick = function()
	{
		remove(fHid.value, itemNo.innerHTML, index);
		return false;
	}
	
	actions.appendChild(fRem);
	
	var fAmount = document.createElement("input"); // this is a hidden file which will contain the amount for each item
	fAmount.setAttribute("type","text");
	fAmount.setAttribute("id","itemAmount"+x);
	fAmount.setAttribute("name","amount[]");
	fAmount.setAttribute("className","nkaTago");
	fAmount.value = 0;
	
	itm.appendChild(fAmount);	
}

function remove(num, itemNo, index)
{
	if(y > 1)
	{
		var ans = confirm("Are you sure you want to delete Item No. "+itemNo+"?");
		if(ans)
		{
			var itemList = document.getElementById("itemList");
			var itm = document.getElementById("item"+num); // item no to be removed in the ItemList
			itemList.removeChild(itm);
			
			y--;
			
			var c;
			for(var a=1;a<=y;a++)
			{
				if(a%2 == 0)
				{
					c = "items2";
				}
				else
				{
					c = "items";
				}
					itemList.childNodes[a-1].setAttribute("className",c);
					itemList.childNodes[a-1].firstChild.innerHTML = a;
			}
			getTotal(index);
		}
	}
	else
	{
		alert("You Are Not Allowed To Have No Items In Quotation");
	}
}

function calculate(e, currentTb, otherTb, output, itemNo, index)
{
	var curr = parseFloat(document.getElementById(currentTb).value);
	var other = parseFloat(document.getElementById(otherTb).value);
	var hidField = document.getElementById('itemAmount'+itemNo);
	
	var total = curr * other;
	var hiddenTotal = curr * other;

	if(isNaN(total))
	{
		total = "0.00";
		hiddenTotal = 0;
	}
	else
	{
		hiddenTotal = hiddenTotal.toFixed(2);
		total = formatCurrency(total)
	}
	document.getElementById(output).innerHTML = "P "+total;
	hidField.value = hiddenTotal; // assign value to hidden file for total
	getTotal(index);
}

function getTotal(index)
{
	var sumaTotal = 0;
	var totalDiv = document.getElementById('total');
	var itemList = document.getElementById('itemList');
	var formattedTotal = document.getElementById('formattedTotal');
	
	var hidFieldVal;
	for(var a = 0; a < y; a++)
	{
		hidFieldVal = parseFloat(itemList.childNodes[a].childNodes[index].value);
		sumaTotal = sumaTotal + hidFieldVal;
	}
	totalDiv.innerHTML = 'P '+formatCurrency(sumaTotal);
	formattedTotal.value = sumaTotal.toFixed(2);
}
