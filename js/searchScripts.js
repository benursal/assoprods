// JavaScript Document
function checkKey(e, type)
{
	if(e.keyCode == 13)
	{
		submitSearch(type);
	}
}

function submitSearch(type)
{
	var cat = document.getElementById('category').value;
	var keyword = document.getElementById('keyword').value;
	var rpp = document.getElementById('rpp').value;
	
	document.location = 'search'+type+'.php?rpp='+rpp+'&keyword='+keyword+'&category='+cat+'&search=SEARCH';
}