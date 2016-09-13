<?php
	include 'config.php';
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$query = mysql_query("SELECT * FROM orderline WHERE poNum = '$id'") or die('error in query');
		
		$delete1 = mysql_query("DELETE FROM po WHERE poNum = '$id'") or die('error on first delete1');
		$x = mysql_num_rows($query);
		for($i=1; $i<=$x;$i++)
		{
			$delete2 = mysql_query("DELETE FROM orderline WHERE poNum = '$id' AND itemNo = '$i'") or die('error in delete2');
		}
		
		if($delete1 AND $delete2)
		{
			header('location: listpo.php?pagenum='.$_GET['pagenum'].'&rpp='.$_GET['rpp']);
		}
		else
		{
			echo "failed to delete";
		}
	}
	
?>