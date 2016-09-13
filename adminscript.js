// JavaScript Document
//ADMIN SCRIPT
function checkname(val,deflt,id)
{
	var obj = document.getElementById(id);
	if(val == deflt)
	{
		obj.style.color = 'black';
		obj.value = '';
	}
}

function backtodflt(v,def,i)
{
	var objid = document.getElementById(i);
	v = (v).replace(/^\s*|\s*$/g,'');
	if(v == '')
	{
		objid.style.color = '#999999';
		objid.value = def;
	}
}

function validate()
{
	var fname = document.getElementById('fname');
	var lname = document.getElementById('lname');
	var username = document.getElementById('username');
	var pass = document.getElementById('pass');
	var pass2 = document.getElementById('pass2');
	var conf = document.getElementById('confirm');
	
	fname.value = white_space(fname);
	lname.value = white_space(lname);
	username.value = white_space(username);
	pass.value = white_space(pass);
	pass2.value = white_space(pass2);
	conf.value = white_space(conf);
	
	var alphaExp = /^[a-zA-Z. ]+$/;
	var alphaNum = /^[A-Za-z0-9. _-]+$/;
	
	if(fname.value == 'First Name' || !fname.value.match(alphaExp))
	{
		alert('Please Enter Your First Name. ');
		fname.focus();
		return false;
	}
	else
	{
		if(lname.value == 'Last Name' || !lname.value.match(alphaExp))
		{
			alert('Please Enter Your Last Name. ');
			lname.focus();
			return false;
		}
		else
		{
			if(username.value.length == 0 )
			{
				alert('Enter Username!');
				username.focus();
				return false;
			}
			else
			{
				if(!username.value.match(alphaNum))
				{
					alert('Only alpha-numeric characters and "_ - ." are allowed!');
					username.focus();
					return false;
				}
				else
				{
					if(pass.value.length < 6)
					{
						alert('Password must have at least 6 characters');
						pass.focus();
						return false;
					}
					else
					{
						if(pass2.value.length == 0)
						{
							alert('Please re-type password!');
							pass2.focus();
							return false;
						}
						else
						{
							if(pass2.value != pass.value)
							{
								alert('Passwords don\'t match!');
								pass2.focus();
								pass2.value = '';
								return false;
							}
							else
							{
								if(conf.value.length == 0)
								{
									alert('Please enter secret code!');
									conf.focus();
									return false;
								}
							}
						}
					}
				}
			}
		}
	}
}