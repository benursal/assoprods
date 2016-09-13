<?php
include 'logcheck.php';
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		include 'config.php';
		$getPOnum = mysql_query("SELECT poNum,attention,date,supplierID, refNo,delivery, terms,prepared,totalAmount,transDescript FROM 
		po WHERE poNum = '$id'") or die('error in getPOnum query');
		
		if(mysql_num_rows($getPOnum) == 1)
		{
			list($poNum,$attn,$date, $sID,$refNo,$del,$terms,$prepared,$totalAmount,$transDescript) = mysql_fetch_array($getPOnum);
			$getSupp = mysql_query("SELECT name FROM supplier WHERE sID = '$sID'") or die('error in getSupp query');
			if(mysql_num_rows($getSupp) == 1)
			{
				list($supp) = mysql_fetch_array($getSupp);
			}
		}
		else
		{
			header('location:listpo.php');
		}
	}
	else
	{
		header('location: listpo.php');
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>Associated Products:: View Purchase Order No. <?php echo $id;?></title>
<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>
<link rel="stylesheet" type="text/css" href="styles1.css">
</head>

<body>
<div id="menu"><a href="addsupplier.php">Add Supplier</a> | 
<a href="purchaseorder.php">Prepare Purchase Order</a> | <a href="listpo.php">View All POs</a> | <a href="search.php">SEARCH</a> | 
Hello <a href="editprofile.php?uname=<?php echo $_SESSION['uname'];?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></a> | 
<a href="logout.php">LOGOUT</a></div>
<p>&nbsp;</p>
<h3 align="center">PURCHASE ORDER</h3>
<div id="edit" style=" width:730px;font-family:Verdana, Arial, Helvetica, sans-serif; text-align:right">
	<div style="width:380px; float:left"><a href="printablepage.php?id=<?php echo $poNum;?>" target="_blank">View Printable Page</a></div>
	<div style="width:350px; float:left"><a href="editpurchaseorder.php?id=<?php echo $id;?>">EDIT</a></div>
</div>

<div id="description" style=" width:730px; padding:20px 10px 20px 10px; border:2px solid darkblue; margin-bottom:15px;
font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left">

<strong>Transaction Description:</strong> <?php echo $transDescript;?></div>
<table width="755" height="144" border="0" align="center" id="potbl">
  <tr>
    <td width="116" height="54" valign="bottom"><div align="right">Supplier : </div></td>
    <td width="325" align="left" valign="bottom"><b><?php echo $supp;?></b></td>
    <td width="292" rowspan="3" align="left" valign="top"><table width="292" height="134" border="0" align="center">
      <tr>
        <td width="109" height="24" align="left" valign="top">Date : </td>
        <td width="126"><strong><?php echo $date;?></strong></td>
      </tr>
      <tr>
        <td height="23" align="left" valign="top">P. O. no : </td>
        <td><strong><?php echo $poNum;?></strong></td>
      </tr>
      <tr>
        <td height="23" align="left" valign="top">Your Ref. No : </td>
        <td><strong><?php echo $refNo;?></strong></td>
      </tr>
      <tr>
        <td height="23" align="left" valign="top">Delivery : </td>
        <td><strong><?php echo $del;?></strong></td>
      </tr>
      <tr>
        <td height="24" align="left" valign="top">Terms : </td>
        <td><strong><?php echo $terms;?></strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="48"><div align="right">Attention : </div></td>
    <td align="left" valign="middle"><b><?php echo $attn;?></b></td>
  </tr>
  <tr>
    <td height="23" colspan="2"><div align="right">&nbsp;</div></td>
  </tr>
</table>
<table width="753" border="1" align="center">
  <tr bgcolor="#66FFCC">
    <td width="64"><div align="center" class="style5">Item No</div></td>
    <td width="54"><div align="center" class="style5">Qty</div></td>
    <td width="60"><div align="center" class="style5">Unit</div></td>
    <td width="300"><div align="center" class="style5">Description</div></td>
    <td width="111"><div align="center" class="style5">Unit Price </div></td>
    <td width="124"><div align="center" class="style5">Amount</div></td>
  </tr>
  
    <?php
	$orderline = mysql_query("SELECT * FROM orderline WHERE poNum = '$id' ORDER BY itemNo ASC") or die('error in orderline query');
	if(mysql_num_rows($orderline)>0)
	{
		while(list($ponum,$itemNo,$q,$unit,$desc,$up,$amount) = mysql_fetch_array($orderline))
		{
	?>		<tr>
			<td width="64"><div align="center"><?php echo $itemNo;?></div></td>
  			<td width="54"><div align="center"><?php echo $q;?></div></td>
   			<td width="60"><div align="center"><?php echo $unit;?></div></td>
    		<td width="300"><div align="left"><?php echo $desc;?></div></td>
    		<td width="111"><div align="center"><?php echo 'P '.$up;?></div></td>
    		<td width="124"><div align="center"><b><?php echo 'P '.$amount;?></b></div></td>
			</tr>
	<?php	
		}
	}
	else
	{
		echo "<td align=center colspan = 6><H4>NO ORDERS</h4>";
	}
	?>
  <tr>
    <td colspan="5"><div align="right"></div>      <div align="right"><STRONG>Total Price (12% VAT Inclusive)</STRONG> </div></td>
    <td><div align="center" style="font-size:22px; font-weight:bold "><?php echo 'P '.$totalAmount;?></div></td>
  </tr>
  <tr valign="top">
    <td height="149" colspan="6"><table width="744" height="145" border="0" cellpadding="10">
      <tr>
        <td width="324" valign="bottom">Prepared By : </td>
        <td width="367" valign="bottom">Noted By : </td>
      </tr>
      <tr>
        <td valign="top"><b><?php echo $prepared;?></b></td>
        <td valign="top"><p><strong>Alexander P. Poras<br>
          General Manager</strong></p>
          </td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
