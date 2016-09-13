<?php
	include 'logcheck.php';
	include 'mainFormList2.class.php';
	include 'paginator.class.php';//  for pagination

if(!isset($_GET['page']))
{
	$page = 1;
}
else
{
	$page = $_GET['page'];
}

$parameters = ""; //used for rpp combo box

if($_GET['search'])
{
	
	if(!isset($_GET['rpp']))
	{
		$list = new mainFormList("quotation");
		$rpp = "ALL";
	}
	else
	{
		if($_GET['rpp'] == 'ALL')
		{
			$list = new mainFormList("quotation");
			$rpp = "ALL";
		}
		else
		{
			$rpp = $_GET['rpp'];
			 
			$list = new mainFormList("quotation", $page, $rpp);
		}
	}
	$list->setSearch(trim($_GET['category']), trim($_GET['keyword']));
	
	$parameters = "&category=".trim($_GET['category'])."&keyword=".trim($_GET['keyword'])."&search=SEARCH";
	
	$paging = new paginator($list->getNumOfRecs(), $rpp, 'searchQuotation.php');
	$paging->addParameters($parameters);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>APP :: Search Quotations</title>
<style>
.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
</style>
<link rel="stylesheet" type="text/css" href="styles/newStyle.css">
<script language="javascript" type="text/javascript" src="js/functions3.js"></script>
<script language="javascript" type="text/javascript" src="js/searchScripts.js"></script>

<?php include 'dropDownMenuLookAndFeel.php'; // css, javascript for drop down menu.. 

?>

</head>

<body onLoad="document.getElementById('keyword').focus();">
<form name="searchQuotation" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" onSubmit="return false;" 
onKeyPress="checkKey(event, 'Quotation')">
<?php
if(isset($_GET['deleted']))
{
	echo "<div id=\"deleteMsg\">Quotation No. <u>".$_GET['deleted']."</u> Has Been Deleted</div>";
}

?>
<div id="wrapper">
	<div id="header">
		<div id="banner">
		  
		  <div id="menu"><?php include 'dropDown.php';?></div>
	  </div>
	</div>
	
	<div id="content">
		<div id="title">
		  <h3>Search Quotations</h3>
		</div>
		<div style="text-align:right; padding-right:50px; margin-bottom:30px ">
		<select name="rpp" onChange="document.location = 'searchQuotation.php?rpp='+this.value+'<?php echo $parameters;?>'">
		<?php
		$recspp = array("ALL", "5","10","20","40");
 		foreach($recspp as $key => $val)
		{
			if($_GET['rpp'] == $val)
			{
				echo "<option value=$val selected>$val</option>";
			}
			else
			{
				echo "<option value=$val>$val</option>";
			}
		}
		?>
		</select> Records Per Page
		</div>
		<div id="searchDiv">Search For : <input type="text" id="keyword" name="keyword" value="<?php echo trim($_GET['keyword']);?>"> In 
		
		<?php $categs = array("transNum"=>"Quotation Number","transDescript"=>"Transaction Description","date"=>"Date",
		"custID"=>"Customer");
		?>
		
		<select name="category" id="category">
		<?php 
			foreach($categs as $k=>$v)
			{
				if($k==trim($_GET['category']))
				{
					echo "<option value=\"$k\" selected>$v</option>";
				}
				else
				{
					echo "<option value=\"$k\">$v</option>";
				}
			}		
		?>
		</select> <input type="submit" name="search" id="search" value="SEARCH" onClick="submitSearch('Quotation');">
	
		</div>
		<div id="list">
		<?php echo (!isset($_GET['search'])) ? '' : $paging->displayPageLinks($page);?>
		<br>
		<?php echo (!isset($_GET['search'])) ? '' : $list->displayRecords(true); // show the list?>
		<br>
		<?php echo (!isset($_GET['search'])) ? '' : $paging->displayPageLinks($page);?>
		</div>		
	</div>
	<div id="footer">
		created by edward benedict ursal
	</div>
</div>
</form>
</body>
</html>

