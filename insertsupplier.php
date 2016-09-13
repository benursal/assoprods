<?php
	$insertsupplier = mysql_query("INSERT INTO supplier() VALUES('$id','$name')") or die('error in insertsupplier query');
	if($insertsupplier)
	{
		header('location: addsupplier.php?id='.$id);
	}
	
?>