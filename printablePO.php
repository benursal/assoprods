<?php
	if(isset($_GET['num']))
	{
		$num = $_GET['num'];
		
		include 'config.php';
		include 'mainFormValues.class.php';
		$mainForm = new mainFormValues('po', $num);
		$values = $mainForm->getWatchValues();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>PRINTABLE PURCHASE ORDER</title>
<link rel="stylesheet" type="text/css" href="styles/printableStyle.css">
<script>
function pbreak(val)
{
	document.getElementById('firsttbl').style.pageBreakAfter = val;
}
</script>
</head>

<body style="margin-top:.4in; font-family:Arial, Helvetica, sans-serif; font-size:13px ">
<p align="center" class="style1"><u>Purchase Order</u></p>
<table width="625" id="firsttbl" height="114" border="1" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td height="16" colspan="4" valign="top" class="noborder" style="border-top:0px solid; border-left:0px solid ">
	<b><?php echo $values[0];?></b>
	<?php $values[10] = str_replace(CHR(13), "<br>", $values[10]);
			echo ucfirst($values[10]);
		?>
	</td>
    <td width="90" height="16" valign="middle" class="bords" style="border-top:0px solid; border-left:0px solid "><div align="right">Date:</div></td>
    <td width="104" valign="middle" class="bords" style="border-top:0px solid; border-left:0px solid "><div align="left"><?php echo $values[4];?></div></td>
  </tr>
  <tr>
    <td height="16" colspan="4" valign="top" class="noborder" style="border-top:0px solid; border-left:0px solid ">&nbsp;
		
	</td>
    <td height="16" valign="middle" class="bords" style="border-top:0px solid; border-left:0px solid "><div align="right">P.O no. </div></td>
    <td width="104" valign="middle" class="bord" style="border-top:0px solid; border-left:0px solid "><div align="left"><?php echo $values[5];?></div></td>
  </tr>
  <tr>
    <td height="16" colspan="4" valign="top" class="noborder" style="border-top:0px solid; border-left:0px solid ">&nbsp;</td>
    <td height="16" valign="middle" class="bords" style="border-top:0px solid; border-left:0px solid "><div align="right">Your ref. no.</div></td>
    <td width="104" valign="middle" class="bord" style="border-top:0px solid; border-left:0px solid "><div align="left"><?php echo $values[3];?></div></td>
  </tr>
  <tr>
    <td height="16" colspan="4" valign="top" class="noborder" style="border-top:0px solid; border-left:0px solid ">Attention : <?php echo $values[2];?></td>
    <td height="16" valign="middle" class="bords" style="border-top:0px solid; border-left:0px solid "><div align="right">Delivery:</div></td>
    <td width="104" valign="middle" class="bord" style="border-top:0px solid; border-left:0px solid "><div align="left"><?php echo $values[7];?></div></td>
  </tr>
  <tr>
    <td height="16" colspan="4" valign="top" class="nobord" style="border-top:0px solid; border-left:0px solid ">&nbsp;</td>
    <td height="16" valign="middle" class="bords" style="border-bottom:1px solid black "><div align="right">Terms:</div></td>
    <td width="104" valign="middle" class="bord" style="border-bottom:1px solid black "><div align="left"><?php echo $values[6];?></div></td>
  </tr>
  <tr valign="middle">
    <td width="53" height="21" class="headings" style="border-top:0px solid; border-left:0px solid ">
	<div align="center" class="style3 style4">
      <div align="center">Item No. </div>
    </div></td>
    <td width="30" class="headings"><div align="center" class="style6" style="border-top:0px solid; border-left:0px solid ">Qty</div></td>
    <td width="60" class="headings"><div align="center" class="style6" style="border-top:0px solid; border-left:0px solid ">Unit</div></td>
    <td width="314" class="headings"><div align="center" class="style6" style="border-top:0px solid; border-left:0px solid ">Description</div></td>
    <td height="15" class="headings"><div align="center" class="style6" style="border-top:0px solid; border-left:0px solid ">Unit Price </div></td>
    <td height="15" class="headings" style="border-right:0 "><div align="center" class="style6">Amount</div></td>
  </tr>
<?php
	$normal = 20; // Number of lines in one page
	$otherDiv = 7;
	$orderline = mysql_query("SELECT * FROM orderline WHERE num = '$num' AND type = 'po' ORDER BY itemNo ASC") or 
	die('error in orderline query');
	if(mysql_num_rows($orderline)>0)
	{
		$numoflines = 0;
		while(list($type,$ponum,$itemNo,$q,$unit,$desc,$sp, $up,$amount) = mysql_fetch_array($orderline))
		{
			$desc = str_replace(CHR(13), "<br>", $desc);
			
			$itemNo = explode("<br>",$itemNo);
			$q = explode("<br>",$q);
			$unit = explode("<br>",$unit);
			$desc = explode("<br>",$desc);
			$up = explode("<br>",$up);
			$amount = explode("<br>",$amount);
			
			$numoflines += sizeof($desc);
			for($v = 0;$v < sizeof($desc);$v++)
			{
				$itemNo = ($v > 0 ) ? '&nbsp;' : $itemNo[$v];
				$q = ($v > 0 ) ? '&nbsp;' : $q[$v];
				$unit = ($v > 0 ) ? '&nbsp;' : $unit[$v];
				$up = ($v > 0 ) ? '&nbsp;' : 'P '.number_format($up[$v],2);
				$amount = ($v > 0 ) ? '&nbsp;' : 'P '.number_format($amount[$v],2);
			
?>			<tr valign="top">
			<td width="53" height="15" class="items" style="border-top:0px solid; border-left:0px solid "><div align="center"><?php echo $itemNo;?></div></td>
  			<td width="30" height="15" class="items" style="border-top:0px solid; border-left:0px solid "><div align="center"><?php echo $q;?></div></td>
   			<td width="60" height="15" class="items" style="border-top:0px solid; border-left:0px solid "><div align="center"><?php echo $unit;?></div></td>
    		<td width="314" height="15"><div align="left"><?php echo $desc[$v];?></div></td>
    		<td width="90" height="15" class="items" style="border-top:0px solid; border-left:0px solid "><div align="RIGHT"><?php echo $up;?></div></td>
    		<td width="104" height="15" class="items" style="border-top:0px solid; border-left:0px solid; border-right:0"><div align="right"><?php echo $amount;?></div></td>
			</tr>
<?php	
			}
		}
		
	}

if($normal >=$numoflines)
{
	$diff = $normal- $numoflines;
	for($x = 0; $x<$diff;$x++)
	{
?>
			<tr valign="top">
			<td width="53" height="15" class="items" style="border-top:0px solid; border-left:0px solid; border-right:0px solid ">&nbsp;</td>
  			<td width="30" height="15" class="items" style="border-top:0px solid; border-left:0px solid ">&nbsp;</td>
   			<td width="60" height="15" class="items" style="border-left:0 ">&nbsp;</td>
    		<td width="314" height="15">&nbsp;</td>
    		<td width="90" height="15" class="items" style="border-left:0 ">&nbsp;</td>
    		<td width="104" height="15" class="items" style="border-left:0; border-right:0">&nbsp;</td>
			</tr>
<?php
	}
	$pbreak = 'auto';
}
else
{
	$d = $numoflines - $normal;
	if($d >=$otherDiv && $d<=36)
	{
		$pbreak = 'auto';
	}
	else
	{
		$pbreak = 'always';
	}
}
//echo $pbreak;
//echo $d;
echo "<script>pbreak('$pbreak');</script>";

?>

</table>
<table width="625" height="112" border="0" align="center" cellpadding="2" cellspacing="0">
<tr><td width="587" height="16" style="border-left:1px solid BLACK; border-bottom:1px solid black"><div align="right">
<strong>Total Price ( 12 % VAT Inclusive)</strong></div></td>
  <td width="105" style="border-left:1px solid BLACK; border-right:1px solid black; border-bottom:1px solid black ">
  <div align="right"><span class="style7">P <?php echo number_format($values[8],2);?></span></div></td>
</tr>
<tr valign="top"><td colspan="2">

<table width="617" height="96" border="0" cellpadding="4" cellspacing="0">
  <tr>
    <td width="301" height="36">Prepared By : </td>
    <td width="305">Noted By: </td>
  </tr>
  <tr>
    <td height="52" valign="top"><hr width="170px" align="left" color="#0B0000" size="1">
        Harold Dy</td>
    <td valign="top"><hr width="170px" align="left" color="#0B0000" size="1">
      Alexander P. Porras<br>
      General Manager </td>
  </tr>
</table></td></tr>
</table>
<div align="center"><br>
  <input name="print" type="button" id="print" value="PRINT" onClick="this.style.visibility = 'hidden';print();">
</div>
</body>
</html>
