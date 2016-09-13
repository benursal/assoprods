<?php
$query = mysql_query("SELECT poNum,transDescript FROM po") or die('error in query');
	$totalrecs = mysql_num_rows($query);
	if(!isset($_GET['rpp']))
	{
		$rpp = 10;
	}
	else
	{
		$rpp = $_GET['rpp'];
		if($rpp == 'ALL')
		{
			$rpp = $totalrecs;
		}
	}		
	
	$pages = $totalrecs/$rpp;
	
	$extra = $totalrecs%$rpp;
	$limit = 0;
	if($extra>0)
	{
		$extra = 1;;
	}
	$pages = floor($pages)+$extra;
	
	if(!isset($_GET['pagenum']))
	{
		$pagenum = 0;
	}
	else
	{
		$pagenum = $_GET['pagenum'];
		if($pagenum >= $pages)
		{
			$pagenum = $pages - 1;
		}
		$limit = $pagenum * $rpp;
	}
?>