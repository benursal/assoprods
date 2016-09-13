<?php
include 'arrayFunctions.php';
include 'logcheck.php';

	//SAVE QUOTATION DATA
//---- MAIN FORM FIELDS

$custId = $_POST['custId']; // variable that will hold customer id value
$attn = $_POST['attention']; // for attention
$subject = $_POST['subject'];
$date = $_POST['date'];
$year = $_POST['year'];
$transNum = $_POST['quotNum'];
$terms = $_POST['terms'];
$delivery = $_POST['delivery'];
$validity = $_POST['validity'];
$transDesc = $_POST['qDesc']; // transaction description
//------- for discount table
$vat = $_POST['vat'];
$inc = $_POST['vatInc'];
$discountRate = trim($_POST['rate']);
//---------
// ---- END OF MAINFORM FIELDS INITIALIZATION

$qty = $_POST['qty']; //  array for qty fields
$unit = $_POST['unit']; //  array for unit fields
$desc = $_POST['descript']; //  array for descript fields
$sp = $_POST['sp']; // array for sp fields
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

// ----------- INSERT VALUES INTO MAINFORM --------------- //
$insertToMain = mysql_query("INSERT INTO quotation() VALUES('$transNum','$year','$date','$custId','$subject','$delivery', '$validity',
'$terms','$attn','$transDesc','$total','".$_SESSION['name']."')") or die('ERROR INSERTING VALUES TO MAIN FORM');
$insetDiscounts = mysql_query("INSERT INTO discounts() VALUES('$transNum','$inc','$vat','$discountRate')") or 
die('error inserting values to discount table');

if($insertToMain AND $insetDiscounts)
{
	for($y = 0; $y < sizeof($amount); $y++)
	{
		$q = $qty[$y];
		$un = $unit[$y];
		$d = str_replace(CHR(13), "<br>", $desc[$y]);
		$s = $sp[$y];
		$u = $up[$y];
		$a = $amount[$y];
		
		$insertToSub = mysql_query("INSERT INTO orderline() VALUES('quotation','$transNum','".($y+1)."','$q','$un','$d','$s',
		'$u','$a')") 
		or die("ERROR INSERTING VALUES TO SUB FORM AT LOOP NUMBER ".$y);
	}
	if($insertToSub)
	{
		echo "<script>document.location = 'savingSuccess.php?n=$transNum&type=q';</script>";
	}
}
else
{
	echo 'error';
}
//------------ END -------------------------------------- //

?>