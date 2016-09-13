<?php
	//Edit Variables
switch($type)
{
	case 'po':
		$title = 'Edit Purchase Order No. '.$num;
		$fieldType = array(
		"select",
		"input",
		"input",
		"input",
		"input",
		"input",
		"select",
		"select",	
		); 
		
		$fieldName = array(
		"suppId",
		"suppName",
		"attention",
		"refNo",
		"fakeDate",
		"poNum",
		"terms",
		"delivery",	
		);
		
		$fieldSize = array( // only used for text input types
		"35", // for supplier name
		"20", // for attention field
		"", //for refNo
		"", // for date
		"", //for PO NUMBER
		); // FOR INPUT FIELDS ONLY
	break;
	case 'quotation':
	$title = 'Edit Quotation No. '.$num;
	break;
}


?>