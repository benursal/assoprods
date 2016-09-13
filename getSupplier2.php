<?php
if(isset($_GET['supid']))
{
	$id = $_GET['supid'];
	include 'config.php';
	
		$query = mysql_query("SELECT name FROM supplier WHERE sID = '$id'") or die('error in querying supplier');
		if(mysql_num_rows($query) == 1)
		{
			list($name) = mysql_fetch_array($query);
			echo $name;
		}
		else
		{
			echo '';
		}
}

?>