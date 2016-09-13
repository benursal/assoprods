// JavaScript Document
var numofLines = 0;
function assignnumoflines()
{
numofLines = document.getElementById('numoflines').value;
}

var totalprice = 0.00;
var array = new Array(3);
for (var i = 0; i < 3; i++) {
	array[i] = [' ', ' ', ' '];
}

array[0][0] = 0;
array[1][0] = 0;

function white_space(field)
{
     field.value = (field.value).replace(/^\s*|\s*$/g,'');
	 return field.value;
}

function showDescript(id, container, txtarea)
{
	var cb = document.getElementById(id);
	var cont = document.getElementById(container);
	var txt = document.getElementById(txtarea);
	
	if(cb.checked == true)
	{
		cont.style.display = 'block';
		txt.disabled = false;
	}
	else
	{
		cont.style.display = 'none';
		txt.disabled = true;
	}
}

function checkOrderline(num, condition,another)
{
	var itm = document.getElementById('item'+num);
	var qty = document.getElementById('qty'+num);
	var unt = document.getElementById('unit'+num);
	var desc = document.getElementById('descript'+num);
	var up = document.getElementById('up'+num);
	var amount = document.getElementById('amount'+num); //  amount of orderline
	
	unt.value = white_space(unt);
	desc.value = white_space(desc);
	
	var update = document.getElementById('update'+num);
	
	var total= document.getElementById('total'); //text field
	var totalp= document.getElementById('totalprice'); // hidden field
	
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
				if(desc.value.length == 0)
				{
					alert('You must enter PRODUCT DESCRIPTION!');
					desc.focus();
					return false;
				}
				else
				{
					var alphaExp = /^[0-9.]+$/;
					if(up.value.length == 0 || !up.value.match(alphaExp))
					{
						alert('Please Enter Valid Price');
						up.value = '';
						up.focus();
					}
					else
					{
						if(condition == true)
						{
							return true;
						}
						else
						{
							if(another != 'tae')
							{
						var unitprice = parseFloat(up.value);
						var quantity = parseInt(qty.value);
						var amt = unitprice * quantity;
						document.getElementById('lineamount'+num).innerHTML ='P ' + formatNumber(amt,2);
						document.getElementById('amount'+num).value = amt;
						totalprice += amt;
						totalp.value =formatNumber(totalprice,2);
						total.value ='P ' +totalp.value;
							}
						numofLines += 1;
						addOrder(num);
						}
					}
				}
			}
		}
	}

function removeline(objid)
{
	var fields = new Array()
	fields[0] = "item";
	fields[1] = "qty";
	fields[2] = "unit";
	fields[3] = "descript";
	fields[4] = "up";
	fields[5] = "amount";
	fields[6] = 'update';
	var orders = document.getElementById('orders'+objid);
	var buttonVal = document.getElementById('remove'+objid).value;
	var amnt = parseFloat(document.getElementById('amount'+objid).value);
	
	var totalprc = document.getElementById('totalprice');
	var ttal= document.getElementById('total');
	
	if(buttonVal == 'Remove')
	{
		document.getElementById('remove'+objid).value = 'Return';
		document.getElementById('lineamount'+objid).style.color = '#666666';
		orders.style.backgroundColor = '#CCCCCC';
		
		totalprice -=amnt;
		totalprc.value = formatNumber(totalprice,2);
		ttal.value ='P '+totalprc.value;
		for(var i = 0; i<7; i++)
		{
			document.getElementById(fields[i]+objid).disabled = true;
		}
		
	}
	else
	{
		document.getElementById('remove'+objid).value = 'Remove';
		document.getElementById('lineamount'+objid).style.color = 'black';
		orders.style.backgroundColor = 'transparent';
		
		totalprice +=amnt;
		totalprc.value = formatNumber(totalprice,2);
		ttal.value ='P '+ totalprc.value;
		
		for(i = 0; i<7; i++)
		{
			document.getElementById(fields[i]+objid).disabled = false;
		}
	}
}

function formatNumber(myNum, numOfDec) 
{ 
   var decimal = 1 
   for(i=1; i<=numOfDec;i++) 
    decimal = decimal *10 

  var myFormattedNum = (Math.round(myNum * decimal)/decimal).toFixed(numOfDec)
  return myFormattedNum;
}

function edit(number)
{
	var check = checkOrderline(number, true);
	var t = document.getElementById('total');
	var q = parseInt(document.getElementById('qty'+number).value);
	var uprice = parseFloat(document.getElementById('up'+number).value);
	
	var tp = document.getElementById('totalprice');
	var a = parseFloat(document.getElementById('amount'+number).value);
	var la = document.getElementById('lineamount'+number);
	
	if(check == true)
	{
		var newVal = (q*uprice) - a;
		document.getElementById('amount'+number).value = formatNumber((a + newVal),2);
		la.innerHTML = 'P '+ formatNumber((a + newVal),2);
		totalprice += newVal;
		tp.value = formatNumber(totalprice,2);
		t.value = 'P '+tp.value;
	}
}

function edit2(number)
{
	var check = checkOrderline(number, true);
	var t = document.getElementById('total');
	var q = parseInt(document.getElementById('qty'+number).value);
	var uprice = parseFloat(document.getElementById('up'+number).value);
	
	var tp = document.getElementById('totalprice');
	var a = parseFloat(document.getElementById('amount'+number).value);
	var la = document.getElementById('lineamount'+number);
	
	if(check == true)
	{
		var newVal = (q*uprice) - a;
		document.getElementById('amount'+number).value = formatNumber((a + newVal),2);
		la.innerHTML = 'P '+ formatNumber((a + newVal),2);
		totalprice += newVal;
		tp.value = formatNumber(totalprice,2);
		t.value = 'P '+tp.value;
	}
}

