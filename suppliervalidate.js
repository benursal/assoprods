// JavaScript Document
function validate()
{
	var sid = document.getElementById('id');
	var sname = document.getElementById('name');
	
	sid.value = white_space(sid);
	sname.value = white_space(sname);
	
	if(sid.value.length == 0)
	{
		alert('Please Enter Supplier ID.');
		sid.focus();
		return false;
	}
	else
	{
		if(sname.value.length == 0)
		{
			alert('Please Enter Supplier Name');
			sname.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
}