<?php
include 'arrayFunctions.php';
include 'logcheck.php';

	//SAVE PURCHASE ORDER DATA
//---- MAIN FORM FIELDS

$suppId = $_POST['suppId']; // variable that will hold customer id value
$attn = $_POST['attention']; // for attention
$date = $_POST['date'];
$year = $_POST['year'];
$transNum = $_POST['poNum'];
$terms = $_POST['terms'];
$delivery = $_POST['delivery'];
$refNo = $_POST['refNo'];
$transDesc = $_POST['poDesc']; // transaction description
$qTotal = $_POST['qTotal'];
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

// ----------- INSERT VALUES INTO MAINFORM --------------- //
$insertToMain = mysql_query("INSERT INTO po() VALUES('$transNum','$year','$date','$refNo','$suppId','$delivery',
'$terms','$attn','$transDesc','$total','".$_SESSION['name']."', '$qTotal')") or die('ERROR INSERTING VALUES TO MAIN FORM');

if($insertToMain)
{
	for($y = 0; $y < sizeof($amount); $y++)
	{
		$q = $qty[$y];
		$un = $unit[$y];
		$d = str_replace(CHR(13), "<br>", $desc[$y]);
		$u = $up[$y];
		$a = $amount[$y];
		
		$insertToSub = mysql_query("INSERT INTO orderline() VALUES('po','$transNum','".($y+1)."','$q','$un','$d','',
		'$u','$a')") 
		or die("ERROR INSERTING VALUES TO SUB FORM AT LOOP NUMBER ".$y);
	}
	if($insertToSub)
	{
		if($_GET['q'] =='')
		{
			echo "<script>document.location = 'savingSuccess.php?n=$transNum&type=po';</script>";
		}
		else
		{
			$q = $_GET['q'];
			echo "<script>document.location = 'savingSuccess.php?n=$transNum&type=po&q=$q';</script>";
		}
	}
	else
	{
		echo 'failure';
	}
}
else
{
	echo 'error';
}
//------------ END -------------------------------------- //

?>