<?php
function setNum($formType)
{
	if($formType == 'po')
	{
		$tbl = 'po';
	}
	else if($formType == 'q')
	{
		$tbl = 'quotation';
	}
	else
	{
		echo "No Such Form Type";
	}
	
	$today = date('Y');
	$query = mysql_query("SELECT transNum FROM ".$tbl." WHERE year = $today ") or die('error in first query');
	
	if(mysql_num_rows($query)>0)
	{
		$query = mysql_query("SELECT MAX(transNum) FROM ".$tbl." WHERE year = '$today'") or die('error in second query');
		list($num) = mysql_fetch_array($query);
		$val = explode('-',$num);
		$p = $val[0]+1;
		$prefix = givePoPrefix(strlen($p),$p);
		$num = $prefix.'-'.date('Y');
	}
	else
	{
		$num = '001-'.date('Y');
	}
	return $num;
}
?>