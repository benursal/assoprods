<?php
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
<title>PRINTABLE PAGE</title>
<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>
<link rel="stylesheet" type="text/css" href="styles1.css">
</head>

<body style="font-family:'Times New Roman', Times, serif ">
<div id="menu"></div>
<h3 align="center">PURCHASE ORDER</h3>

<div id="description" style=" width:600px; padding:20px 10px 20px 10px; border:1px solid black; margin-bottom:15px;
font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left">

<strong>Transaction Description:</strong> <?php echo $transDescript;?></div>
<table width="625" height="144" border="0" align="center" id="potbl">
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
   <div id="printable">
<table width="620" border="0" align="center" cellspacing="0" style="border:1px solid black ">
  <tr>
    <td width="53"><div align="center" class="style5">Item No</div></td>
    <td width="30"><div align="center" class="style5">Qty</div></td>
    <td width="60"><div align="center" class="style5">Unit</div></td>
    <td width="250"><div align="center" class="style5">Description</div></td>
    <td width="90"><div align="center" class="style5">
      <div align="left">Unit Price </div>
    </div></td>
    <td width="104"><div align="center" class="style5">
      <div align="left">Amount</div>
    </div></td>
  </tr>
  
    <?php
	$orderline = mysql_query("SELECT * FROM orderline WHERE poNum = '$id' ORDER BY itemNo ASC") or die('error in orderline query');
	if(mysql_num_rows($orderline)>0)
	{
		while(list($ponum,$itemNo,$q,$unit,$desc,$up,$amount) = mysql_fetch_array($orderline))
		{
	?>		<tr>
			<td width="53"><div align="center"><?php echo $itemNo;?></div></td>
  			<td width="30"><div align="center"><?php echo $q;?></div></td>
   			<td width="60"><div align="center"><?php echo $unit;?></div></td>
    		<td width="250"><div align="left"><?php echo $desc;?></div></td>
    		<td width="90"><div align="left"><?php echo 'P '.$up;?></div></td>
    		<td width="104"><div align="left"><b><?php echo 'P '.$amount;?></b></div></td>
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
    <td><div align="left" style="font-size:22px; font-weight:bold "><?php echo 'P '.$totalAmount;?></div></td>
  </tr>

  <tr valign="top">
    <td height="149" colspan="6">

	<table width="620" height="145" border="0" cellpadding="10">
      <tr>
        <td width="300" valign="bottom" style="border:0 ">Prepared By : </td>
        <td width="300" valign="bottom" style="border:0 ">Noted By : </td>
      </tr>
      <tr>
        <td valign="top" style="border:0 "><b><?php echo $prepared;?></b></td>
        <td valign="top" style="border:0 "><p><strong>Alexander P. Poras<br>
          General Manager</strong></p>
          </td>
      </tr>
    </table></td>
  </tr>
</table>
  </div>	
<p align="center">
  <input name="print" type="button" id="print" value="PRINT" onClick="this.style.visibility = 'hidden';print();">
</p>
</body>
</html>
