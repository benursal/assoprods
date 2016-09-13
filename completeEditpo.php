<?php
	//PO info fields
	$poNum = $_POST['poNum'];
	$refNo = $_POST['refNo'];
	$supplier = $_POST['supplier'];
	$delivery = $_POST['delivery'];
	$terms = $_POST['terms'];
	$attn = $_POST['attention'];
	$transDesc = str_replace(CHR(13), '<br>', $_POST['transDesc']);
	//$totalprice = $_POST['totalprice'];
	
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
	$query = mysql_query("SELECT * FROM orderline WHERE poNum = '$poNum'") or die('error in \'query\' query');
	$recs = mysql_num_rows($query);
	for($x = 1; $x <=$recs; $x++)
	{
		$delete = mysql_query("DELETE FROM orderline WHERE poNum = '$poNum' AND itemNo = '$x'") or die('error in deleting');
	}
	
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

$insertToPo = mysql_query("UPDATE po SET refNo = '$refNo', supplierID = '$supplier', delivery = '$delivery',
			terms = '$terms', attention = '$attn', transDescript = '$transDesc',
			totalAmount = '$totalprice' WHERE poNum = '$poNum'") or die('error inserting to PO table');

if($insertToPo && $insertToOrderline)
{
	header('location: viewPO.php?id='.$poNum);
}
?>