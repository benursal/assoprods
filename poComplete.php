<?php
	//PO info fields
	$poNum = $_POST['poNum'];
	$year = $_POST['year'];
	$date = $_POST['date'];
	$refNo = $_POST['refNo'];
	$supplier = $_POST['supplier'];
	$delivery = $_POST['delivery'];
	$terms = $_POST['terms'];
	$attn = $_POST['attention'];
	$transDesc = str_replace(CHR(13),"<br>", $_POST['transDesc']);
	//$totalprice = $_POST['totalprice'];
	$prepared = $_POST['prepared'];
	
	$fakedate = $_POST['fakedate']; // fake date
	//
	
	// order fields
	include 'functions.php';
	
	//$item = removeEmpty($_POST['item']);
	$qty = removeEmpty($_POST['qty']);
	$unit = removeEmpty($_POST['unit']);
	$descript = removeEmpty($_POST['descript']);
	$up = removeEmpty($_POST['up']);
	$amount = removeEmpty($_POST['amount']);
	//
	

include 'config.php';
		
$totalprice = 0;
$amnt = array();

$itemNo = 1;
for($i= 0; $i<sizeof($amount); $i++)
{		
	$amnt = $up[$i] * $qty[$i];
	$descript[$i] = str_replace(CHR(13),"<br>",$descript[$i]);
$insertToOrderline = mysql_query("INSERT INTO orderline() VALUES('$poNum','$itemNo','$qty[$i]',
'$unit[$i]','$descript[$i]','$up[$i]','$amnt')") or 
die('failed to insert  values in orderline  table');
$itemNo++;
	$totalprice +=$amnt;
}

$insertToPo = mysql_query("INSERT INTO po() VALUES('$poNum','$year','$date','$refNo','$supplier','$delivery',
			'$terms','$attn','$transDesc','$totalprice','$prepared')") or die('error inserting to PO table');

if($insertToPo && $insertToOrderline)
{
	header('location: purchaseorder.php?id='.$poNum);
}
?>