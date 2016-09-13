<?php
//delete Company

function deleteRecord($tableName, $id, $url)
{
	switch($tableName)
	{
		case 'customer':
			$primaryKey = 'custID';
		break;
		case 'supplier':
			$primaryKey = 'sID';
	}
	
	$query = mysql_query("SELECT * FROM $tableName WHERE $primaryKey = '$id'") or die('error in line 15 of deleteForm.php');
	if(mysql_num_rows($query) == 1)
	{
		$delete = mysql_query("DELETE FROM $tableName WHERE $primaryKey = '$id'") or die("error in line 18 of deleteCompany.php");
		if($delete)
		{
			header("Location: ".$url."?deleted=".$id);
		}
	}
	
}
?>