<?php
include 'logcheck.php';

	if(isset($_GET['num']))
	{
		$num = $_GET['num'];
		
		include 'mainFormValues.class.php';
		$mainForm = new mainFormValues('quotation', $num);
		$values = $mainForm->getWatchValues();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>Quotation Printable View</title>
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
<br>
<table width="625" height="199" border="0" cellspacing="0" class="t1">
  <tr>
    <td width="74" align="left"><div align="right" class="style7">
      <div align="left" class="style6">Customer : </div>
    </div></td>
    <td width="200" align="left" class="style6"><b><?php echo ucfirst($values[1]);?></b><div align="left"></div></td>
    <td width="103" rowspan="5" class="style7">&nbsp;</td>
    <td width="131" height="20"><div align="right" class="style7">
      <p class="style6">Date : </p>
    </div></td>
    <td width="95" align="left"><div align="left" class="style6"><strong>	<?php echo $values[4];?></strong></div></td>
  </tr>
  <tr>
    <td align="left" valign="top"><div align="right" class="style6">
      <div align="left">Address : </div>
    </div></td>
    <td rowspan="2" valign="top"><p align="justify" class="style6">
		<?php
			echo $values[11];
		?>
	</td>
    <td height="20"><div align="right" class="style6"> Quotation  Number: </div></td>
    <td align="left"><div align="left" class="style6"><strong>	<?php echo $values[5];?></strong></div></td>
  </tr>
  <tr>
    <td height="24" align="left"><div align="right" class="style6">
      <div align="left"><span class="style6"><span class="style6"><span class="style7"></span></span></span></div>
    </div></td>
    <td height="24"><div align="right" class="style6">Your Ref. No: </div></td>
    <td align="left"><div align="left" class="style6"><strong>	<?php echo $values[3];?></strong></div></td>
  </tr>
  <tr>
    <td align="left" class="style6"><div align="right" class="style7">
      <div align="left" class="style6">Attention : </div>
    </div></td>
    <td align="left" class="style6">
	<?php echo $values[2];
		$gend = explode(".", strtolower($values[2]));
		switch($gend[0])
		{
			case "mr":
				$addrs = "Sir ";
				break;
			case 'ms':
				$addrs = "Ma'am ";
				break;
			case 'mrs': 
				$addrs = "Ma'am ";
				break;
			default:
				$addrs = "";
		}
		
	?>
	</td>
    <td height="20"><div align="right" class="style7"></div></td>
    <td align="left"><div align="left" class="style6 style7 style7 style9"><strong>	</strong></div></td>
  </tr>
  <tr>
    <td align="left" valign="middle" class="style6"><div align="right" class="style6">
      <div align="left"><span class="style6"><span class="style6"><span class="style6">Subject : </span></span></span></div>
    </div></td>
    <td align="left" valign="middle" class="style6"><?php echo $values[3];?></td>
    <td height="34"><div align="right" class="style7"></div></td>
    <td align="left"><div align="left" class="style6 style7 style7 style9"><strong>	</strong></div></td>
  </tr>
  <tr>
    <td height="20" colspan="5" align="left" valign="middle" class="style6"><div align="center"><span class="style8"><u>Quotation</u></span></div></td>
  </tr>
  <tr>
    <td height="59" colspan="5" valign="middle"><div align="left">
      <p class="style6 style7 style7 style9">Dear <?php echo $addrs;?> :</p>
      <p class="style6 style7 style7 style9">We have the pleasure of submitting our offer to your requirements : </p>
    </div></td>
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
	$normal = 20; // Number of lines in one page
	$otherDiv = 7;
	$orderline = mysql_query("SELECT * FROM orderline WHERE num = '$num' AND type = 'quotation' ORDER BY itemNo ASC") or 
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
<table width="625" border="0" cellspacing="0">
  <tr>
    <td width="175">&nbsp;</td>
    <td width="444"><div align="right"><?php include 'quotationPriceBreakDown.php';?></div></td>
  </tr>
</table>
<table width="625" border="0" cellspacing="0" class="style6">
  <tr class="t1">
    <td width="105" height="20" class="style6"><div align="right" class="style6">
      <div align="left">Delivery : </div>
    </div></td>
    <td width="510" align="left" class="style6"><div align="left" class="style6"><?php echo $values[7];?></div></td>
  </tr>
  <tr class="t1">
    <td height="20" class="style6"><div align="right" class="style7">
      <div align="left" class="style6">Terms : </div>
    </div></td>
    <td align="left" class="style6"><div align="left" class="style6"><?php echo $values[6];?></div></td>
  </tr>
  <tr class="t1">
    <td height="20" align="right" valign="middle" class="style6"><div align="left">Validity : </div></td>
    <td align="left" valign="middle" class="style6"><span class="style6"><?php echo $values[8];?></span></td>
  </tr>
  <tr align="left" class="t1">
    <td height="47" colspan="2" valign="middle" class="style6">We trust that you will find our offer of interest and in the event that you should require any furthuer details or additional information, please do not hesitate to contact us, as we remain at your complete disposal. </td>
  </tr>
</table>
<table width="625" height="54" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td width="273" height="26" valign="bottom"><div align="left">Very truly yours, </div></td>
    <td width="342" valign="bottom"><div align="left">Noted By: </div></td>
  </tr>
  <tr>
    <td height="26" valign="top"><div align="left">
      <p><br>
        ____________________<br>
        <?php echo $values[15];?></p>
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
