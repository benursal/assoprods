<?php
include 'arrayFunctions.php';
include 'config.php';

	//SAVE QUOTATION DATA
//---- MAIN FORM FIELDS
$type = $_GET['type']; // the type of form.  whether purchase order or quotation

$custId = $_POST['custId']; // variable that will hold customer id value
$attn = $_POST['attention']; // for attention
$subject = $_POST['subject'];
$qNum = $_POST['quotNum'];
$terms = $_POST['terms'];
$delivery = $_POST['delivery'];
$validity = $_POST['validity'];
$transDesc = $_POST['qDesc'];  // transaction description
//------- for discount table
$vat = $_POST['vat'];
$inc = $_POST['vatInc'];
$discountRate = trim($_POST['rate']);
//---------
// ---- END OF MAINFORM FIELDS INITIALIZATION

$qty = $_POST['qty']; //  array for qty fields
$unit = $_POST['unit']; //  array for unit fields
$desc = $_POST['descript']; //  array for descript fields
$sp = $_POST['sp']; //  array for sp fields
$amount = $_POST['amount']; //  array for amount fields

$holderArray = getIndex($amount, 0); // the holderArray holds the indeces of valid

$amount = rBlankElements($amount, 0);
$qty = matchIndex($qty, $holderArray);
$unit = matchIndex($unit, $holderArray);
$desc = matchIndex($desc, $holderArray);
$sp = matchIndex($sp, $holderArray);
$up = matchIndex($up, $holderArray);

for($x = 0; $x < sizeof($amount); $x++)
{
	$up[$x] = $amount[$x]/$qty[$x];
}

$total = $_POST['formattedTotal'];// formatted suma total

// ----------- UPDATE VALUES OF MAINFORM --------------- //
$updateToMain = mysql_query("UPDATE quotation SET custID = '$custId', subject = '$subject', delivery = '$delivery',
validity = '$validity', terms = '$terms', attention = '$attn',transDescript = '$transDesc',
totalAmount = '$total' WHERE transNum = '$qNum'") or die('ERROR UPDATING VALUES TO MAIN FORM');

$updateDiscounts = mysql_query("UPDATE discounts SET inclusion = '$inc', vat = '$vat', rate = '$discountRate' WHERE 
transNum = '$qNum'") or 
die('error updating values to discount table');

if($updateToMain AND $updateDiscounts)
{
	$getNumItems = mysql_query("SELECT * FROM orderline WHERE type = 'quotation' AND num = '$qNum'") or 
	die("ERROR IN LINE 46 OF updateQuotation.php");
	
	$numItems = mysql_num_rows($getNumItems);
	
	for($a = 1; $a <= $numItems; $a++)
	{
		$delete = mysql_query("DELETE FROM orderline WHERE type = 'quotation' AND num = '$qNum' AND itemNo = '$a'") or 
		die("error in line 53 of updateQuotation.php");
	}
		
	if($delete)
	{
		for($y = 0; $y < sizeof($amount); $y++)
		{
			$q = $qty[$y];
			$un = $unit[$y];
			$d = $desc[$y];
			$s = $sp[$y];
			$u = $up[$y];
			$a = $amount[$y];
			
			$insertToSub = mysql_query("INSERT INTO orderline() VALUES('quotation','$qNum','".($y+1)."','$q','$un','$d','$s',
			'$u','$a')") 
			or die("ERROR INSERTING VALUES TO SUB FORM AT LOOP NUMBER ".$y.".Line 68 updateQuotation.php");
		 }
		
		if($insertToSub)
		{
			echo "<script> document.location = 'watchquotation.php?num=$qNum';</script>";
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