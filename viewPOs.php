<?php
	include 'logcheck.php';
	include 'mainFormList.class.php';
	include 'paginator.class.php';//  for pagination
	
	if(!isset($_GET['page']))
	{
		$page = 1;
	}
	else
	{
		$page = $_GET['page'];
	}
	
	if(!isset($_GET['rpp']))
	{
		$list = new mainFormList("po");
		$rpp = "ALL";
	}
	else
	{
		if($_GET['rpp'] == 'ALL')
		{
			$list = new mainFormList("po");
			$rpp = "ALL";
		}
		else
		{
			$rpp = $_GET['rpp'];
			 
			$list = new mainFormList("po", $page, $rpp);
		}
	}
	$paging = new paginator($list->getNumOfRecs(), $rpp, 'viewPOs.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>APP :: View All Purchase Orders</title>
<style>
.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
</style>
<link rel="stylesheet" type="text/css" href="styles/newStyle.css">
<script language="javascript" type="text/javascript" src="js/functions3.js"></script>
<?php include 'dropDownMenuLookAndFeel.php'; // css, javascript for drop down menu.. 

?>

</head>

<body>
<?php
if(isset($_GET['deleted']))
{
	echo "<div id=\"deleteMsg\">Purchase Order No. <u>".$_GET['deleted']."</u> Has Been Deleted</div>";
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
		  <h3>All Purchase Orders</h3>
		</div>
		<div>
		<select name="rpp" onChange="document.location = 'viewPOs.php?rpp='+this.value">
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
					
		<div id="list">
		<?php $paging->displayPageLinks($page);?>
		<br>
		<?php echo $list->displayRecords(); // show the list?>
		<br>
		<?php $paging->displayPageLinks($page);?>
		</div>		
	</div>
	<div id="footer">
		created by edward benedict ursal
	</div>
</div>
</form>
</body>
</html>

