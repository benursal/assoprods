<?php
include 'config.php';

$query = mysql_query("SELECT num, itemNo FROM orderline WHERE type = ''") or die('error in line 4 of insertoMissing.php');
while(list($num, $itemNo) = mysql_fetch_array($query))
{
	$update = mysql_query("UPDATE orderline SET type = 'po' WHERE num = '$num' AND itemNo = '$itemNo'") or die('error line 7
	of insertoMissing.php');
	
	if($update)
	{
		echo "Success!!";
	}
	else
	{
		echo "Failure";
	}
	//echo $num." - ".$itemNo."<br>";
}

?>