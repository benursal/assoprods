<?php
	/*include '../config.php';
	
	$query = mysql_query("SELECT transNum, terms, delivery FROM po") or die('error in query in line 4');
	while(list($transNum, $terms, $del) = mysql_fetch_array($query))
	{
		$termsQuery = mysql_query("SELECT termNum FROM terms WHERE termName = '$terms'") or die('error in termsQuery in line 7');
		list($termNum) = mysql_fetch_array($termsQuery);
		
		$delQuery = mysql_query("SELECT delNum FROM delivery WHERE delName = '$del'") or die('error in delQuery in line 10');
		list($delNum) = mysql_fetch_array($delQuery);
		
		$update = mysql_query("UPDATE po SET terms = '$termNum', delivery = '$delNum' WHERE transNum='$transNum'") or 
		die('an error occured during update');
	}*/
?>