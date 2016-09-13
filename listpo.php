<?php
	include 'logcheck.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>Purchase Order List</title>
<link rel="stylesheet" type="text/css" href="styles1.css">
<script language="javascript" type="text/javascript" src="functions2.js"></script>

</head>

<body>
<form>
<?php
	include 'config.php';
	include 'paginate.php';
?>
<div id="menu"><a href="addsupplier.php">Add Supplier</a> | 
<a href="purchaseorder.php">Prepare Purchase Order</a> | <a href="listpo.php">View All POs</a> | <a href="search.php">SEARCH</a> | 
Hello <a href="editprofile.php?uname=<?php echo $_SESSION['uname'];?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></a> | 
<a href="logout.php">LOGOUT</a></div>
<p align="center"><select name="rpp" onChange="document.location = 'listpo.php?rpp='+this.value">
<?php
	$recspp = array("10","20","30","40","ALL");
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
<br>
Total Number of POs Issued : <?php echo $totalrecs;?>
</p>
<table width="804" height="124" border="1" align="center" cellspacing="0">
  <tr>
  
    <td height="25">
	<div id="navigate">
	<table border="0" cellspacing="5">
      <tr bgcolor="#CCCCFF">
        <?php
		if($pagenum >0)
		{
			$p = $pagenum-1;
			echo "<td width=\"81\"><a href=\"listpo.php?pagenum=0&rpp=".$rpp."\">&lt;&lt; FIRST</a> </td>
        	<td width=\"110\"><a href=\"listpo.php?pagenum=".($pagenum-1)."&rpp=".$rpp."\">&lt; PREVIOUS</a></td>";
		}
		else
		{
			echo '';
			echo '';
		}

		
			for($i = 0; $i<$pages;$i++)
			{
				if($i != $pagenum)
				{
					echo "<td width=20 align=center><a href='listpo.php?pagenum=".$i."&rpp=".$rpp."'>".($i+1)."</a></td>";
				}
				else
				{
					echo "<td width=20 align=center bgcolor=orange><b>".($i+1)."</b></td>";
				}
			}
		
		if($pagenum < ($pages-1))
		{
			echo "<td width=\"67\"><a href=\"listpo.php?pagenum=".($pagenum+1)."&rpp=".$rpp."\">NEXT &gt;</a> </td>
        	<td width=\"84\"><a href=\"listpo.php?pagenum=".($pages-1)."&rpp=".$rpp."\">LAST &gt;&gt;</a></td>";
		}
		else
		{
			echo '';
			echo '';
		}
		?>
      </tr>
    </table>
	</div>
	</td>
  </tr>
  <tr>
    <td height="37" valign="top"><table width="798" height="27" border="1" cellspacing="0">
      <tr>
        <td width="110"><div align="center"><strong>PO NUMBER</strong></div></td>
        <td width="287"><div align="center"><strong>DESCRIPTION</strong></div></td>
        <td width="117"><div align="center"><strong>SUPPLIER</strong></div></td>
        <td width="138"><div align="center"><strong>NO. OF ITEMS </strong></div></td>
       <td width="86"><div align="center">&nbsp;</div></td>
        <td width="85"><div align="center">&nbsp;</div></td>
      </tr>
	  <?php
	  $po = mysql_query("SELECT poNum,transDescript,supplierID FROM po ORDER BY year DESC, poNum DESC 
	  LIMIT ".$limit.", ".$rpp) or die('error in po query');
	  if(mysql_num_rows($po)>0)
	  {
	  	while(list($poNum,$desc,$supplierID) = mysql_fetch_array($po))
		{
			$orderline = mysql_query("SELECT itemNo FROM orderline WHERE poNum = '$poNum'") or die('error in orderline query');
			$numofitems = mysql_num_rows($orderline);
		echo "
	  <tr onmouseover=\"this.style.background = 'skyblue'\" onmouseout=\"this.style.background = 'transparent'\">
	  	 <td width=\"109\"><div align=\"center\"><strong><a href=viewPO.php?id=$poNum>$poNum</a></strong></div></td>
        <td width=\"344\"><div align=\"left\"><strong>$desc</strong></div></td>
		<td width=\"117\"><div align=\"center\"><strong>$supplierID</strong></div></td>
		<td width=\"138\"><div align=\"center\">$numofitems item(s)</div></td>
        <td width=\"86\"><div align=\"center\"><strong><a href=editpurchaseorder.php?id=$poNum>[EDIT]</a></strong></div></td>
        <td width=\"85\"><div align=\"center\"><strong>
		<a href='#' onClick=\"confirmDel('$poNum',".$pagenum.",".$rpp.")\">[DELETE]</a></strong></div></td>
	  </tr>";
	 	}
	}
	else
	{
		echo "<td colspan=6><h3 align=center>No Purchase Orders Has Been Issued Yet</h3></td>";
	}
	  ?>
    </table></td>
  </tr>
  <tr>
    <td height="25">
	<div id="navigate">
	<table border="0" cellspacing="5">
       <tr bgcolor="#CCCCFF">
		 <?php
		if($pagenum >0)
		{
			echo "<td width=\"81\"><a href=\"listpo.php?pagenum=0&rpp=".$rpp."\">&lt;&lt; FIRST</a> </td>
        	<td width=\"110\"><a href=\"listpo.php?pagenum=".($pagenum-1)."&rpp=".$rpp."\">&lt; PREVIOUS</a></td>";
		}
		else
		{
			echo '';
			echo '';
		}

		
			for($i = 0; $i<$pages;$i++)
			{
				if($i != $pagenum)
				{
					echo "<td width=20 align=center><a href='listpo.php?pagenum=".$i."&rpp=".$rpp."'>".($i+1)."</a></td>";
				}
				else
				{
					echo "<td width=20 align=center bgcolor=orange><b>".($i+1)."</b></td>";
				}
			}
		
		if($pagenum < ($pages-1))
		{
			echo "<td width=\"67\"><a href=\"listpo.php?pagenum=".($pagenum+1)."&rpp=".$rpp."\">NEXT &gt;</a> </td>
        	<td width=\"84\"><a href=\"listpo.php?pagenum=".($pages-1)."&rpp=".$rpp."\">LAST &gt;&gt;</a></td>";
		}
		else
		{
			echo '';
			echo '';
		}
		?>
      </tr>
    </table>
	</div>
	</td>
  </tr>
</table>
</form>
</body>
</html>
