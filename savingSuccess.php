<?php
include 'logcheck.php';
include 'successPage.php';

if(isset($_GET['n']) AND isset($_GET['type']))
{
	$transNum = $_GET['n'];
	$type = $_GET['type'];
	
	if($type == 'po')
	{
		$url = 'po.php';
		$title = 'Purchase Order';
		$urlView = 'watchpo.php';
		if(isset($_GET['q']))
		{
			$q = $_GET['q'];
			$createPO = "<a href=po.php?q=$q>Create Another Purchase Order From Quotation No. <b>$q</b></a>";
		}
		else
		{
			$createPO = '';
		}
	}
	elseif($type == 'q')
	{
		$url = 'quotation.php';
		$title = 'Quotation';
		$urlView = 'watchquotation.php';
		$createPO = "<a href=po.php?q=$transNum>Create A Purchase Order From This Quotation</a>";
	}
	
	$content = "<p>".$title." <a href=".$urlView."?num=$transNum>".$transNum."</a> has been saved Successfully!!!</p>";
	$content .= "<p><a href=".$url."> Create New ".$title." </a>  </p>  ".$createPO." <p><a href=index.php> Go To HomePage </a></p>";
	
	$success = new successWebPage($content);
	echo $success->displayPage();
	
}
else
{
	$content = "No Form Has Been Created!!!";
	
	$failure = new successWebPage($content);
	echo $failure->displayPage();
}
?>
