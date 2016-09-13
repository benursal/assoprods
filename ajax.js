// JavaScript Document
// JavaScript Document
// ajax
var http=false;
try
{
	http = new ActiveXObject('Msxml2.XMLHTTP');
}
catch(e)
{
	try
	{
		http = new ActiveXObject('Microsoft.XMLHTTP');
	}
	catch(E)
	{
		http = false;
	}
}
if(!http && typeof XMLHttpRequest != 'undefined')
{
	http = new XMLHttpRequest();
}

function addOrder(val)
{
	var id = val+1;
	var orderline = document.getElementById('orderline');
	var url = 'order20.php?id='+id;
	
	http.open('GET', url, true);
	http.onreadystatechange = function()
	{
		if(http.readyState == 4)
		{
			orderline.innerHTML +=http.responseText;
		}
	}
	http.send(null);
	document.getElementById('add'+val).style.display = 'none';
	document.getElementById('remove'+val).style.display = 'block';
	document.getElementById('update'+val).style.display = 'block';
	//document.getElementById('update'+val).focus();
	ipafocus('descript'+id);
}

function getSupplierName(supid, result)
{
	var url = 'getSupplier2.php?supid='+supid;
	var res = document.getElementById(result);
	
	
	http.open('GET', url, true)
	http.onreadystatechange = function()
	{
		if(http.readyState ==4)
		{
			res.innerHTML = http.responseText;
		}
	}
	http.send(null);
}

function ipafocus(id)
{
	document.getElementById(id).focus();
}

