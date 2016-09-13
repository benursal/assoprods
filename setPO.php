<?php
	$today = date('Y');
	$query = mysql_query("SELECT poNum FROM po WHERE year = $today ") or die('error in first query');
	
	if(mysql_num_rows($query)>0)
	{
		$query = mysql_query("SELECT MAX(poNum) FROM po WHERE year = '$today'") or die('error in second query');
		list($poNum) = mysql_fetch_array($query);
		$val = explode('-',$poNum);
		$po = $val[0]+1;
		$prefix = givePoPrefix(strlen($po),$po);
		$poNum = $prefix.'-'.date('Y');
	}
	else
	{
		$poNum = '000-'.date('Y');
	}

?>