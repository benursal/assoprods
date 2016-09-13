// JavaScript Document
function showDiscount()
{
	var dis = $('disc');
	var rateS = $('rateS');
	var rate = $('rate');
	
	if(dis.checked == 1)
	{
		rateS.style.visibility = 'visible';
		rate.focus();
	}
	else
	{
		rateS.style.visibility = 'hidden';
		rate.value = '';
	}
}

function hideDiscount()
{
	
}