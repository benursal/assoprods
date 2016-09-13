// JavaScript Document
var http = createXmlHttp();
var type; // global variable for the type of dialog box
var selectId;

var origTransDesc;

function showDialog(t, id)
{
	type = t; // initialize value for 'type' global variable
	selectId = id; // initialize value for 'selectId' global variable
	
	var titleDiv = document.getElementById('t');
	var dialog = document.getElementById('addDialog');
	var cover = document.getElementById('cover');
	var nameLabel = document.getElementById('nameLabel');
	var idLabel = document.getElementById('idLabel');
	var idRow = document.getElementById('idRow');
	var addressRow = document.getElementById('addressRow');
	var closeLink = document.getElementById('closeDialog');
	var title;
	var val = '';
	var addNewLblVisible = true; // if the label that says Add New ... is needed, the value is true
	
	var idDisplay = 'none';
	var addressDisplay = 'none';
	
	var focusedTextBox = 'name';

	var bottom = '105';
	var labelAdd = "Add New ";// ADD NEW label
	
	if(type == 'cust')
	{
		title = 'Customer';
		idDisplay = 'block';
		addressDisplay = 'block';
		focusedTextBox = 'id';
		bottom = '197';
	}
	else if(type == 'supp')
	{
		title = 'Supplier';
		idDisplay = 'block';
		addressDisplay = 'block';
		focusedTextBox = 'id';
		bottom = '197';
	}
	else if(type == 'terms')
	{
		title = 'Term';
	}
	else if(type == 'val')
	{
		title = 'Validity';
	}
	else if(type == 'del')
	{
		title = 'Delivery';
	}
	else if(type == 'qDesc' || type == 'poDesc')
	{
		title = 'Transaction';
		labelAdd = ""; // Add New is removed
		val = $('transDesc').value;
	}
	
	idRow.style.display = idDisplay;
	addressRow.style.display = addressDisplay;
	closeLink.style.bottom = bottom+'px';
	addressRow
	
	titleDiv.innerHTML = labelAdd+title;
	
	dialog.style.display = 'block';
	cover.style.display = 'block';
	idLabel.innerHTML = title+' ID :';
	nameLabel.innerHTML = title+' Name : ';
	//addressLabel.innerHTML = title+' Address : ';
	$('name').value = val;
	document.getElementById(focusedTextBox).focus();
}

function closeDialog()
{
	document.getElementById('id').value = '';
	document.getElementById('name').value = '';
	document.getElementById('addDialog').style.display = 'none';
	document.getElementById('cover').style.display = 'none';
	document.getElementById('errorMsg').style.display = 'none';
	document.getElementById('errorMsg').innerHTML = '';
	$('companyAddress').value = '';
}

function checkKey(e)
{
	if(e.keyCode == 27)closeDialog();
	else if(e.keyCode == 13) saveInfo();
}

function saveInfo()
{
	var param1 = 'param='+new Date().getTime(); //to avoid caching of data when using AJAX
	var param2 = '&type='+type+'&name='+document.getElementById('name').value;
	var error = document.getElementById('errorMsg');
	
	if(type == 'cust' || type == 'supp') // if TYPE is 'cust' or 'supp' ADD ANOTHER PARAMETER for ID
	{
		param2 += '&id='+document.getElementById('id').value+"&address="+$('companyAddress').value;
	}
	
	if(type == 'qDesc' || type == 'poDesc')
	{
		if(white_space($('name')).toUpperCase() == white_space($('transDesc')).toUpperCase())
		{
			param2 +="&match=true";
		}
	}
	
	var url = 'saveInfo.php?'+param1+param2;
	
	http.open('GET', url, true);
	http.onreadystatechange = function()
	{
		if(http.readyState == 4)
		{
			var res = http.responseText.split(",");
			
			if(res[0]== '1')
			{
				addOption(res[1], res[2]);
				closeDialog();
			}
			else if(res[0] == '2')
			{
				$('transDesc').value = $('name').value;
				closeDialog();
				$(selectId).submit();
			}
			else
			{
				error.style.display = 'block';
				error.innerHTML = http.responseText;
			}
		}
	}
	http.send(null);
}

function addOption(v1, v2)
{
	var sel = document.getElementById(selectId);
	
	var newOption = document.createElement("option");
	newOption.value = v1;
	
	if(type == 'cust' || type == 'supp')
	{
		newOption.text = v1;
	}
	else
	{
		newOption.text = v2;
	}
	
	sel.options.add(newOption);
}
