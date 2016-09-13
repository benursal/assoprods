<?php
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.noborder{border-top:0; border-bottom:0; padding-left:5px}
.nobord{border-top:0;border-bottom:1px solid grey;}
.style3 {font-size: 10; font-weight: bold; }
.style4 {font-size: 11px}
.style6 {font-size: 11px; font-weight: bold; }
.style7 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>

<body style="margin-top:.2in; font-family:Arial, Helvetica, sans-serif; font-size:13px ">
<p align="center" class="style1"><u>PURCHASE ORDER</u></p>
<table width="625" height="114" border="1" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td height="16" colspan="4" valign="top" class="noborder" style="border-top:1px solid ">Supplier : <b><?php echo $supp;?></b></td>
    <td width="90" height="16" valign="middle"><div align="right">Date:</div></td>
    <td width="104" valign="middle"><div align="left"><?php echo $date;?></div></td>
  </tr>
  <tr>
    <td height="16" colspan="4" valign="top" class="noborder">&nbsp;</td>
    <td height="16" valign="middle"><div align="right">P.O no. </div></td>
    <td width="104" valign="middle"><div align="left"><?php echo $poNum;?></div></td>
  </tr>
  <tr>
    <td height="16" colspan="4" valign="top" class="noborder">&nbsp;</td>
    <td height="16" valign="middle"><div align="right">Your ref. no.</div></td>
    <td width="104" valign="middle"><div align="left"><?php echo $refNo;?></div></td>
  </tr>
  <tr>
    <td height="16" colspan="4" valign="top" class="noborder">Attention : <?php echo $attn;?></td>
    <td height="16" valign="middle"><div align="right">Delivery:</div></td>
    <td width="104" valign="middle"><div align="left"><?php echo $del;?></div></td>
  </tr>
  <tr>
    <td height="16" colspan="4" valign="top" class="nobord">&nbsp;</td>
    <td height="16" valign="middle"><div align="right">Terms:</div></td>
    <td width="104" valign="middle"><div align="left"><?php echo $terms;?></div></td>
  </tr>
  <tr valign="middle">
    <td width="53" height="16"><div align="center" class="style3 style4">
      <div align="center">Item No. </div>
    </div></td>
    <td width="30"><div align="center" class="style6">Qty</div></td>
    <td width="60"><div align="center" class="style6">Unit</div></td>
    <td width="314"><div align="center" class="style6">Description</div></td>
    <td height="16"><div align="center" class="style6">Unit Price </div></td>
    <td height="16"><div align="center" class="style6">Amount</div></td>
  </tr>
<?php
	$normal = 21;
	$otherDiv = 6;
	$orderline = mysql_query("SELECT * FROM orderline WHERE poNum = '$id' ORDER BY itemNo ASC") or die('error in orderline query');
	if(mysql_num_rows($orderline)>0)
	{
		$numoflines = 0;
		while(list($ponum,$itemNo,$q,$unit,$desc,$up,$amount) = mysql_fetch_array($orderline))
		{
			
?>		<tr valign="top">
			<td width="53" height="15" class="items"><div align="center"><?php echo $itemNo;?></div></td>
  			<td width="30" height="15" class="items"><div align="center"><?php echo $q;?></div></td>
   			<td width="60" height="15" class="items"><div align="center"><?php echo $unit;?></div></td>
    		<td width="314" height="15" class="items"><div align="left"><?php echo $desc;?></div></td>
    		<td width="90" height="15" class="items"><div align="RIGHT">P <?php echo $up;?></div></td>
    		<td width="104" height="15" class="items"><div align="right">P <?php echo $amount;?></div></td>
			</tr>
<?php	
			$num = explode("<br>",$desc);
			$numoflines += sizeof($num);
		}
		
	}

if($normal >=$numoflines)
{
	$diff = $normal- $numoflines;
	for($x = 0; $x<$diff;$x++)
	{
?>
			<tr valign="top">
			<td width="53" height="15" class="items">&nbsp;</td>
  			<td width="30" height="15" class="items">&nbsp;</td>
   			<td width="60" height="15" class="items">&nbsp;</td>
    		<td width="314" height="15" class="items">&nbsp;</td>
    		<td width="90" height="15" class="items">&nbsp;</td>
    		<td width="104" height="15" class="items">&nbsp;</td>
			</tr>
<?php
	}
	$pbreak = 'auto';
}
else
{
	$d = $numoflines - $normal;
	if($d > $otherDiv)
	{
		$pbreak = 'auto';
	}
	else
	{
		$pbreak = 'always';
	}
}
?>
</table>
<table width="617" height="80" border="1" align="center" cellpadding="2" cellspacing="0" style="page-break-before:<?php echo $pbreak;?> ">
<tr><td width="590" height="16"><div align="right"><strong>Total Price ( 12 % VAT Inclusive)</strong></div></td>
  <td width="103"><div align="center"><span class="style7">PHP <?php echo $totalAmount;?></span></div></td>
</tr>
<tr valign="top"><td colspan="2">

<table width="617" height="96" border="0" cellpadding="4" cellspacing="0">
  <tr>
    <td width="301" height="36">Prepared By : </td>
    <td width="305">Noted By: </td>
  </tr>
  <tr>
    <td height="52" valign="top"><hr width="170px" align="left" color="#0B0000" size="1">
        <?php echo $prepared;?></td>
    <td valign="top"><hr width="170px" align="left" color="#0B0000" size="1">
      Alexander P. Porras<br>
      General Manager </td>
  </tr>
</table></td></tr>
</table>
</body>
</html>
