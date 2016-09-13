<?php
include 'logcheck.php';

	if(isset($_GET['num']))
	{
		$num = $_GET['num'];
	
		include 'mainFormValues.class.php';
		$mainForm = new mainFormValues('po', $num);
		$values = $mainForm->getWatchValues();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>Purchase Order Printable View</title>
<link rel="stylesheet" type="text/css" href="styles/poPrintableView.css">
<script>
function pbreak(val)
{
	document.getElementById('itemTable').style.pageBreakAfter = val;
}
</script>
<style type="text/css">
<!--
.style9 {font-size: 11px}
-->
</style>
</head>

<body>
<table width="684" height="76" border="0">
  <tr>
    <td width="664"><div align="center"><img src="images/letterHead.GIF" width="613" height="110"></div></td>
  </tr>
</table>
<p class="style8"><u>Purchase Order</u></p>
<table width="625" height="132" border="0" cellspacing="0" class="t1">
  <tr>
    <td width="75"><div align="right" class="style7">Supplier : </div></td>
    <td width="203" align="left" class="style7"><b><?php echo ucfirst($values[1]);?></b><div align="left"></div></td>
    <td width="146" rowspan="5" class="style7">&nbsp;</td>
    <td width="94" height="20"><div align="right" class="style7">
      <p>Date : </p>
    </div></td>
    <td width="95" align="left"><div align="left" class="style6 style7 style7 style9"><strong>	<?php echo $values[4];?></strong></div></td>
  </tr>
  <tr>
    <td valign="top"><div align="right" class="style7">Address : </div></td>
    <td rowspan="2" valign="top"><p align="justify" class="style7">
		<?php
			echo $values[10];
		?>
	</td>
    <td height="20"><div align="right" class="style7">PO Number: </div></td>
    <td align="left"><div align="left" class="style6 style7 style7 style9"><strong>	<?php echo $values[5];?></strong></div></td>
  </tr>
  <tr>
    <td height="24"><div align="right" class="style6"><span class="style6"><span class="style6"><span class="style7"></span></span></span></div></td>
    <td height="24"><div align="right" class="style7">Your Ref. No: </div></td>
    <td align="left"><div align="left" class="style6 style7 style7 style9"><strong>	<?php echo $values[3];?></strong></div></td>
  </tr>
  <tr>
    <td><div align="right" class="style7">Attention : </div></td>
    <td align="left" class="style7"><?php echo $values[2];?></td>
    <td height="20"><div align="right" class="style7">Delivery : </div></td>
    <td align="left"><div align="left" class="style6 style7 style7 style9"><strong>	<?php echo $values[7];?></strong></div></td>
  </tr>
  <tr>
    <td><div align="right" class="style6"><span class="style6"><span class="style6"><span class="style7"></span></span></span></div></td>
    <td class="style7">&nbsp;</td>
    <td height="31"><div align="right" class="style7">Terms : </div></td>
    <td align="left"><div align="left" class="style6 style7 style7 style9"><strong>	<?php echo $values[6];?></strong></div></td>
  </tr>
</table>
<table width="625" height="23" border="0" cellspacing="0" class="t2">
  <tr>
    <td width="59"><div align="center" class="style3">Item No.</div></td>
    <td width="34"><div align="center" class="style3">Qty</div></td>
    <td width="48"><div align="center" class="style3">Unit</div></td>
    <td width="262"><div align="center" class="style3">Description</div></td>
    <td width="80"><div align="center" class="style3">Unit Price</div></td>
    <td width="116"><div align="center" class="style3">Amount</div></td>
  </tr>
</table>

<table width="625" border="0" cellspacing="0" class="t2" id="itemTable">
<?php
	$normal = 28; // Number of lines in one page
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
			for($v = 0;$v <= sizeof($desc);$v++)
			{
				$itemNo = ($v > 0 ) ? '&nbsp;' : $itemNo[$v];
				$q = ($v > 0 ) ? '&nbsp;' : $q[$v];
				$unit = ($v > 0 ) ? '&nbsp;' : $unit[$v];
				$up = ($v > 0 ) ? '&nbsp;' : 'P '.number_format($up[$v],2);
				$amount = ($v > 0 ) ? '&nbsp;' : 'P '.number_format($amount[$v],2);
			
				if($v < sizeof($desc))
				{
?>
  <tr>
    <td width="59" valign="top"><div align="center"><?php echo $itemNo;?></div></td>
    <td width="34" valign="top"><div align="center"><?php echo $q;?></div></td>
    <td width="48" valign="top"><div align="center"><?php echo $unit;?></div></td>
    <td width="262" align="left" valign="top">
    <div align="left"><?php echo $desc[$v];?></div></td>
	<td width="80" valign="top"><div align="center"><?php echo $up;?></div></td>
    <td width="116" valign="top"><div align="center"><?php echo $amount;?></div></td>
  </tr>

<?php
				}
				elseif($v == sizeof($desc))
				{
?>
<tr>
    <td width="59" valign="top"><div align="center">&nbsp;</div></td>
    <td width="34" valign="top"><div align="center">&nbsp;</div></td>
    <td width="48" valign="top"><div align="center">&nbsp;</div></td>
    <td width="262" align="left" valign="top">
    <div align="left">&nbsp;</div></td>
	<td width="80" valign="top"><div align="center">&nbsp;</div></td>
    <td width="116" valign="top"><div align="center">&nbsp;</div></td>
  </tr>
<?php				
					$numoflines +=1;
				}
			}
		}
	}

if($normal >=$numoflines)
{
	$diff = $normal- $numoflines;
	for($x = 0; $x<$diff;$x++)
	{
?>
 <tr>
    <td width="59" valign="top"><div align="center">&nbsp;</div></td>
    <td width="34" valign="top"><div align="center">&nbsp;</div></td>
    <td width="48" valign="top"><div align="center">&nbsp;</div></td>
    <td width="262" align="left" valign="top">
    <div align="left">&nbsp;</div></td>
	<td width="80" valign="top"><div align="center">&nbsp;</div></td>
    <td width="116" valign="top"><div align="center">&nbsp;</div></td>
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
<table width="625" border="0" cellspacing="0" class="t2">
  <tr>
    <td><div align="right" class="style4">Total Price ( 12 % VAT Inclusive)</div></td>
    <td width="116" class="style4"><?php echo "P ".number_format($values[8], 2);?></td>
  </tr>
</table>
<table width="625" height="54" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td width="273" height="26" valign="bottom"><div align="left">Prepared By:</div></td>
    <td width="342" valign="bottom"><div align="left">Noted By: </div></td>
  </tr>
  <tr>
    <td height="26" valign="top"><div align="left">
      <p><br>
        ____________________<br>
       <?php echo $values[11];?></p>
    </div></td>
    <td valign="top"><div align="left">
      <p><br>
        ____________________<br>
        Alexander P. Porras<br>
General Manager</p>
    </div></td>
  </tr>
</table>

<?php //echo $numoflines;?>
<div align="center"><br>
  <input name="print" type="button" id="print" value="PRINT" onClick="this.style.visibility = 'hidden';print();">
</div>
</body>
</html>
