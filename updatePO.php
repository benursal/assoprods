<?php
include 'arrayFunctions.php';
include 'config.php';

	//Update PURCHASE ORDER DATA
//---- MAIN FORM FIELDS
$type = $_GET['type']; // the type of form.  whether purchase order or quotation

$poNum = $_POST['poNum'];
$suppId = $_POST['suppId']; // variable that will hold customer id value
$attn = $_POST['attention']; // for attention
$terms = $_POST['terms'];
$delivery = $_POST['delivery'];
$refNo = $_POST['refNo'];
$transDesc = $_POST['poDesc']; // transaction description
// ---- END OF MAINFORM FIELDS INITIALIZATION

$qty = $_POST['qty']; //  array for qty fields
$unit = $_POST['unit']; //  array for unit fields
$desc = $_POST['descript']; //  array for descript fields
$amount = $_POST['amount']; //  array for amount fields

$holderArray = getIndex($amount, 0); // the holderArray holds the indeces of valid

$amount = rBlankElements($amount, 0);
$qty = matchIndex($qty, $holderArray);
$unit = matchIndex($unit, $holderArray);
$desc = matchIndex($desc, $holderArray);
$up = matchIndex($up, $holderArray);

for($x = 0; $x < sizeof($amount); $x++)
{
	$up[$x] = $amount[$x]/$qty[$x];
}

$total = $_POST['formattedTotal'];// formatted suma total

// ----------- UPDATE VALUES OF MAINFORM --------------- //
$updateToMain = mysql_query("UPDATE po SET refNo = '$refNo', supplierID = '$suppId', delivery = '$delivery',
terms = '$terms', attention = '$attn', transDescript = '$transDesc', totalAmount = '$total' WHERE transNum = '$poNum'") or 
die('ERROR UPDATING VALUES TO MAIN FORM');

if($updateToMain)
{
	$getNumItems = mysql_query("SELECT * FROM orderline WHERE type = 'po' AND num = '$poNum'") or 
	die("ERROR IN LINE 45 OF updatePO.php");
	
	$numItems = mysql_num_rows($getNumItems);
	
	for($a = 1; $a <= $numItems; $a++)
	{
		$delete = mysql_query("DELETE FROM orderline WHERE type = 'po' AND num = '$poNum' AND itemNo = '$a'") or 
		die("error in line 53 of updatePO.php");
	}
		
	if($delete)
	{
		for($y = 0; $y < sizeof($amount); $y++)
		{
			$q = $qty[$y];
			$un = $unit[$y];
			$d = str_replace(CHR(13), "<br>", $desc[$y]);
			$u = $up[$y];
			$a = $amount[$y];
			
			$insertToSub = mysql_query("INSERT INTO orderline() VALUES('po','$poNum','".($y+1)."','$q','$un','$d','',
			'$u','$a')") 
			or die("ERROR INSERTING VALUES TO SUB FORM AT LOOP NUMBER ".$y.".Line 68 updatePO.php");
		 }
		
		if($insertToSub)
		{
			echo "<script> document.location = 'watchpo.php?num=$poNum';</script>";
		}// END OF IF($insertToSub)
		else
		{
			echo 'failure';
		}
	}// END OF IF($delete)
}
else
{
	echo 'error';
}
//------------ END -------------------------------------- //

?>