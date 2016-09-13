<?php
switch($type)
{
	case 'po':
	$title = "Purchase Order No. <u>".$num."</u>";
	
	$formTitle = 'Purchase Order';
	
	$labels = array(
		"Supplier ID",
		"Supplier Name",
		"Attention",
		"Ref Number",
		"Date",
		"PO Number",
		"Terms",
		"Delivery",
	);
	break;
	case 'quotation':
	$title = "Quotation No. <u>".$num."</u>";
	
	$formTitle = 'Quotation';
	
	$labels = array(
		"Customer ID",
		"Customer Name",
		"Attention",
		"Subject",
		"Date",
		"Quotation Number",
		"Terms",
		"Delivery",
		"Validity"
	);
}
	
?>
