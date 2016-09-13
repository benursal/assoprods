// JavaScript Document
function confirmDel(id,page,rpp)
{
	var ans = confirm('Do You Really Want To Delete Purchase Order Number '+id+'?');
	if(ans)
	{
		document.location = 'deletePO.php?id='+id+'&pagenum='+page+'&rpp='+rpp;
	}
}

function igit(e)
{
	if(e.keyCode == 13)
	{
		var keyw = document.getElementById('key').value;
		var cate = document.getElementById('category').value;
		document.location = 'search.php?key='+keyw+'&search=SEARCH%21&category='+cate;
		return true;
	}
}