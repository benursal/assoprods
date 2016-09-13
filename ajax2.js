// JavaScript Document
function editSupplier(num)
{
	var sid = document.getElementById('su'+num);
	var sTextbox = document.getElementById('s'+num);
	var name = document.getElementById('na'+num);
	var nTextbox = document.getElementById('n'+num);
	var editbutton = document.getElementById('edit'+num);
	var hid = document.getElementById('hid'+num);
	
	
	if(editbutton.value == 'EDIT')
	{
		sid.style.display = 'none';
		sTextbox.style.display = 'block';
		name.style.display = 'none';
		nTextbox.style.display = 'block';
		
		
		editbutton.value = 'SAVE';
	}
	else
	{
		sid.style.display = 'block';
		sTextbox.style.display = 'none';
		name.style.display = 'block';
		nTextbox.style.display = 'none';
		
		var url = 'editsupplier.php?id='+hid;
		editbutton.value = 'EDIT';
	}
}