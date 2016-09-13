<?php	//FUNCTION INCLUSIONS
	include 'logcheck.php'; // connect to mysql, database, and table
	include 'functions.php'; //
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>APP:: QUOTATION and PURCHASE ORDER SYSTEM</title>
<link rel="stylesheet" type="text/css" href="styles/homePageStyle.css">
<link rel="stylesheet" type="text/css" href="styles/newStyle.css">
<?php include 'dropDownMenuLookAndFeel.php'; // css, javascript for drop down menu.. 

?>

</head>
<body>
<div id="wrapper">
	<div id="header">
		
		<div id="banner">
		  <div id="menu"><?php include 'dropDown.php';?></div>
	  </div>
	</div>
	
	<div id="cont">
		<div id="userGreeting"></div>
		<div id="mainLinks">
			<a href="po.php" class="mainLink">Purchase Order</a>
			<a href="quotation.php" class="mainLink">Quotation</a>
		</div>
		<div id="subLinks">
			<div id="submenu1" class="submenu">
				<a href="#">View All PO's</a>
				<a href="#">Edit PO</a>
				<a href="#">Search PO</a>
			</div>
			<div id="submenu2" class="submenu">
				<a href="#">View All Quotations</a>
				<a href="#">Edit Quotation</a>
				<a href="#">Search Quotation</a>
			</div>
		</div>
	</div>	
	<div id="footer">
	
		created by edward benedict ursal
	</div>
</div>

</body>
</html>
