// JavaScript Document
//another set of functions

function deleteItem(tableName, id)
{
	var ans = confirm("Are You Sure You Want To Delete "+tableName+" "+id+"?");
	if(ans)
	{
		document.location = 'deleteItem.php?table='+tableName+'&id='+id;
	}
}

function optionContents()
{
	var orderLine = new Array("Transaction No.",
							  "Item No.",
							  "Description"
							);
	var orderLineId = new Array("num",
							  "itemNo",
							  "descript"
							  );
	
	var po = new Array("PO No.",
						"Supplier ID",
						"Supplier Name"
							  );
	var poId = new Array("num",
						"itemNo",
						"descript"
							  );
}