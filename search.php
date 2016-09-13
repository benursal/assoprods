<?php
	include 'logcheck.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>ASSOCIATED PRODUCTS :: SEARCH</title>
<link rel="stylesheet" type="text/css" href="styles1.css">
<script language="javascript" type="text/javascript" src="functions2.js"></script>
</head>

<body onLoad="document.getElementById('key').focus()">
<div id="menu"><a href="addsupplier.php">Add Supplier</a> | 
<a href="purchaseorder.php">Prepare Purchase Order</a> | <a href="listpo.php">View All POs</a> | <a href="search.php">SEARCH</a> | 
Hello <a href="editprofile.php?uname=<?php echo $_SESSION['uname'];?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></a> | 
<a href="logout.php">LOGOUT</a></div>
<H3 align="center">KEYWORD SEARCH</H3>
<?php
	$cat = array('PO Number'=>'poNum','Product Description'=>'descript','Transaction Description'=>'transDescript');
?>
<FORM action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
<div id="keyw" style="text-align:center">
  <p>SEARCH : 
      <input name="key" type="text" id="key" size="30" maxlength="50"> 
      <input type="submit" value="SEARCH!" name="search"> 
      FROM 
      <select name="category">
        <?php
	if(!isset($_GET['category']))
	{
		$c = 'poNum';
	}
	else
	{
		$c = $_GET['category'];
	}
	foreach($cat as $k=>$v)
	{
		if($v == $c)
		{
			echo "<option value=\"$v\" selected>$k</option>";
		}
		else
		{
			echo "<option value=\"$v\">$k</option>";
		}
	}
?>
      </select>
  </p>
  <p>
<?php
  if(isset($_GET['search']))
  {
  	$key = $_GET['key'];
	$category = $_GET['category'];
	
	include 'config.php';
	if($category == 'poNum')
	{
		$getpo = mysql_query("SELECT poNum,transDescript,supplierID FROM po WHERE poNum LIKE '$key%' OR poNum LIKE '%$key' ORDER BY poNum DESC") 
		or die('error in getpo1 query');
	}
	else if($category == 'descript')
	{
		$getpo = mysql_query("SELECT DISTINCT(po.poNum),po.transDescript, po.supplierID FROM po,orderline 
		WHERE (descript LIKE '$key%' OR descript LIKE '%$key' OR descript LIKE '%$key%') AND po.poNum = orderline.poNum ORDER BY poNum DESC") 
		or die('error in getpo2 query');
	}
	else
	{
		$getpo = mysql_query("SELECT poNum,transDescript,supplierID FROM po WHERE transDescript LIKE '$key%' OR transDescript LIKE '%$key' 
		OR transDescript LIKE '%$key%' ORDER BY poNum DESC") 
		or die('error in getpo3 query');
	}
		$numrows = mysql_num_rows($getpo);
		echo '<FONT FACE=VERDANA><B>'.$numrows.'</B> results found</FONT><br>';
		if($numrows>0)
		{
?>
			<table border=1>
			<tr>
			<td width="110"><div align="center"><strong>PO NUMBER</strong></div></td>
       	 	<td width="287"><div align="center"><strong>DESCRIPTION</strong></div></td>
        	<td width="117"><div align="center"><strong>SUPPLIER</strong></div></td>
        	<td width="138"><div align="center"><strong>NO. OF ITEMS </strong></div></td>
       		<td width="86"><div align="center">&nbsp;</div></td>
        	<td width="85"><div align="center">&nbsp;</div></td>
			</tr>
<?php
			while(list($poNum,$desc,$supplierID) = mysql_fetch_array($getpo))
			{
				$numoforderline = mysql_query("SELECT * FROM orderline WHERE poNum = '$poNum'") or die('error in numoforderline query');
				$numofitems = mysql_num_rows($numoforderline);
				include 'ponumsearch.php';
			}
			echo "</table>";
		}
  }
  
?>
 </p>
</div>
	
</FORM>
</body>
</html>
