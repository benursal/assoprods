<?php
//delete Form
function deleteRecord($tableName, $num, $url)
{
	$query = mysql_query("SELECT * FROM $tableName WHERE transNum = '$num'") or die('error in line 5 of deleteForm.php');
	if(mysql_num_rows($query) == 1)
	{
		$deleteMain = mysql_query("DELETE FROM $tableName WHERE transNum = '$num'") or die('error in line 8 of deleteForm.php');
		if($deleteMain)
		{
			$query2 = mysql_query("SELECT * FROM orderline WHERE type = '$tableName' AND num = '$num'") or 
			die('error in line 12 of deleteForm.php');
			
			$numItems = mysql_num_rows($query2);
			for($a = 1; $a <= $numItems; $a++)
			{
				$deleteOrderLine = mysql_query("DELETE FROM orderline WHERE type = '$tableName' AND num = '$num' AND itemNo = '$a'") or 
				die("error in line 18 of deleteForm.php");
				if($tableName == 'quotation')
				{
					$deleteDiscount = mysql_query("DELETE FROM discounts WHERE  transNum = '$num'") 
					or die("error in line 22 of deleteForm.php. Error deleting discount");
				}
			}
			if($deleteOrderLine)
			{
				header("Location: ".$url."?deleted=".$num);
			}
		}
	}
}
?>