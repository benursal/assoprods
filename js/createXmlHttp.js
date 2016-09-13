// JavaScript Document
function createXmlHttp()
{
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
	return http;
}