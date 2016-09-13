<?php
	
	//include 'functions.php';
	//include 'setPO.php';
	include 'logcheck.php';
	if(isset($_GET['id']))
	{
		include 'mainformdata.php';
	}
	else
	{
		header('location:listpo.php');
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>ASSOPHIL::EDIT Purchase Order No <?php echo $id;?></title>
<script language="javascript" type="text/javascript" src="ajax.js"></script>
<script language="javascript" type="text/javascript" src="functions.js"></script>
<script language="javascript" type="text/javascript" src="editformvalidate.js"></script>
<script language="javascript" type="text/javascript" src="editformvalidate2.js"></script>
<link rel="stylesheet" type="text/css" href="styles1.css">
<script>
function testing(num)
{
	var itm = document.getElementById('item'+num);
	var qty = document.getElementById('qty'+num);
	var unt = document.getElementById('unit'+num);
	var desc = document.getElementById('descript'+num);
	var up = document.getElementById('up'+num);
	var amount = document.getElementById('amount'+num); //  amoun
	
	//var flds =new Array{"item","qty","unt","desc","up","amount"};
	alert(up.value);
	alert(amount.value);
	/*
	for(var a = 0;a<6;a++)
	{
		alert(flds[a]+': '+flds[a].value);
	}*/
}
</script>
</head>

<body>
<form name="form1" method="post" action="completeEditpo.php" onSubmit="return validate()">
<div id="menu"><a href="addsupplier.php">Add Supplier</a> | 
<a href="purchaseorder.php">Prepare Purchase Order</a> | <a href="listpo.php">View All POs</a> | <a href="search.php">SEARCH</a> | 
Hello <a href="editprofile.php?uname=<?php echo $_SESSION['uname'];?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></a> | 
<a href="logout.php">LOGOUT</a></div>
<div id="msg">
<?php
if(isset($_GET['id']))
{
	$transDescript = str_replace("<br>", CHR(13),$transDescript);
	echo "<B>Transaction Description :</b> <textarea name=\"transDesc\" id=\"transDesc\" cols=50 rows=3>".$transDescript."</textarea>";
}
else
{
	echo '';
}
?>
</div>
<h2 align="center">EDIT PURCHASE ORDER</h2>
  <table width="826" height="502" border="0" align="center" id="potbl">
    <tr align="left" valign="top">
      <td height="23" colspan="6">
	  <div id="col1">
	  	<table width="500" height="80" border="0" cellspacing="0">
  <tr>
    <td width="149" height="38"><div align="center">Supplier ID : </div></td>
    <td width="305"><select name="supplier" id="supplier" onChange="getSupplierName(this.value,'supname');">
        <?php
		  $getSupplier = mysql_query("SELECT * FROM supplier ORDER BY sID ASC") or die('error in getting supplier');
		  while(list($sid,$sname) = mysql_fetch_array($getSupplier))
		  {
		  	if($sid == $supp)
			{
				echo "<option value='$sid' selected>$sid</option>";
		  	}
			else
			{
				echo "<option value='$sid'>$sid</option>";
			}
		  }
		  ?>
      </select>
    </td>
  </tr>
  <tr>
    <td height="50" colspan="2"><span id="supname" style="padding-left:20px;color:darkblue;font-family:Verdana, Arial, Helvetica, 
		  sans-serif; font-size:24px; text-align:center "><?php echo $supname;?></span></td>
  </tr>
  <tr>
    <td><div align="center">Attention : </div></td>
    <td><input name="attention" type="text" id="attention" size="25" maxlength="40" value="<?php echo $attn;?>"></td>
  </tr>
</table>
	  </div>
	  <div id="col2">
	    <table width="300" height="100" border="0" cellspacing="4">
          <tr>
            <td>Date: </td>
            <td><input name="fakedate" value="<?php echo $date;?>" size="15" readonly="true"> 
			<input type="hidden" name="date" value="<?php echo $date;?>">
			</td>
          </tr>
          <tr>
            <td>P.O no: </td>
            <td><input name="poNum" value="<?php echo $poNum;?>" readonly="true" size="15"></td>
          </tr>
          <tr>
            <td>Your ref. no: </td>
            <td><input type="text" name="refNo" id="refNo" size="10" value="<?php echo $refNo;?>"></td>
          </tr>
          <tr>
            <td>Delivery: </td>
            <td>
			<?php
			$delarray = array('4 - 6 WEEKS','6 - 8 WEEKS','8 - 12 WEEKS','5 - 8 DAYS');
			$termsarray = array('30 DAYS','45 DAYS','60 DAYS PDC','COD');
			?>
			<select name="delivery">
				<?php
					foreach($delarray as $k=>$v)
					{
						if($v == $del)
						{
							echo "<option value='$v' selected>$v</option>";
						}
						else
						{
							echo "<option value='$v'>$v</option>";
						}
					}
				?>
			</select>
			</td>
          </tr>
          <tr>
            <td>Terms: </td>
            <td>
			<select name="terms">
			<?php
				foreach($termsarray as $key=>$val)
				{
					if($val == $terms)
					{
						echo "<option value='$val' selected>$val</option>";
					}
					else
					{
						echo "<option value='$val'>$val</option>";
					}
				
				}
			?>
			</select>
			</td>
          </tr>
        </table>
	  </div>
	  </td>
    </tr>
    <tr>
      <td width="826">
	 	<div id="headers">
		 <div style="width:90px; " id="itemno">Item No.</div>
		 <div style=" width:55px;" id="qty">Qty</div>
		 <div style="width:53px; " id="unit">Unit</div>
		 <div style="width:300px; " id="descriptions">Descriptions</div>
 		 <div style="width:101px; " id="unitprice">Unit Price</div>
 		 <div style="width:127px; float:left " id="amount">Amount</div>
		 <div style="width:75px; "></div>
		</div>
		<div id="orderline">
		
	<?php
	$getOrderline = mysql_query("SELECT itemNo,qty,unit,descript,unitPrice,amount FROM orderline WHERE poNum = '$id' ORDER BY
		itemNo ASC") or die('error in getOrderline query');
		
	if(mysql_num_rows($getOrderline)>0)
	{
		while(list($i,$qty,$unit,$desc,$up,$amount) = mysql_fetch_array($getOrderline))
		{
			$numoflines = mysql_num_rows($getOrderline);
			echo "<input type=hidden name=numoflines id=numoflines value=".$numoflines.">";
			$desc = str_replace("<br>",CHR(13), $desc);
	echo "	<div id=\"orders".$i."\" class=\"orders\">
 		 <div style=\"width:90px; \" id=\"itemno\"><input type=\"hidden\" size=\"7\" id=\"item".$i."\" name=\"item[]\" value=\"".$i."\">".$i."</div>
		 <div style=\" width:55px;\" id=\"qty\"><input type=\"text\" size=\"3\" id=\"qty".$i."\" name=\"qty[]\" value=".$qty."></div>
		 <div style=\"width:53px; \" id=\"unit\"><input type=\"text\" size=\"4\" id=\"unit".$i."\" name=\"unit[]\" value=".$unit."></div>
		 <div style=\"width:300px; \" id=\"descriptions\">
		 <textarea rows=\"3\" cols=\"30\" id=\"descript".$i."\" name=\"descript[]\">".$desc."</textarea></div>
		 <div style=\"width:101px; \" id=\"unitprice\">
		   <input type=\"text\" size=\"7\" id=\"up".$i."\" name=\"up[]\" value=".$up.">
		 </div>
		 <div style=\"width:127px; float:left; font-size:16px\" id=\"lineamount".$i."\"></div>
		 <input type=\"hidden\" name=\"amount[]\" id=\"amount".$i."\" value=\$amount\>
		 <div style=\"width:75px; \"><input type=\"button\" id=\"add".$i."\" value=\"Add Line\" style=\"font-size:10px;display:none\"> 
		 <input type=\"button\" id=\"remove".$i."\" value=\"Remove\" style=\"font-size:10px; display:block\" onClick=\"removeline(".$i.")\">
		  <input type=\"button\" name=\"update\" id=\"update".$i."\" value=\"Update\" style=\"font-size:10px; display:block\" onClick=\"edit2(".$i.")\">
		 </div></div><script>checkOrderline($i)</script><script>assignnumoflines()</script>";
		}
	}
		?>
		</div>
	  </td>
    </tr>
	<tr><td><input type="button" name="addmore" id="addmore" value="Add More Items" 
	onClick="checkOrderline(<?php echo $numoflines;?>, false,'tae');this.style.display = 'none'; ipafocus('qty<?php echo $numoflines+1;?>')"></td></tr>
    <tr>
      <td height="23"><div id="totalamount" align="right"><strong>Total Price (12% VAT Inclusive)</strong>
	  <input name="total" type="text" id="total" style=" border:0; color:darkblue; font-size:20px; font-weight:600; 
			  text-align:center" size="15" readonly="true" value="P <?php echo $totalAmount;?>"> 
			  <input type="hidden" id="totalprice" name="totalprice" value="<?php echo $totalAmount;?>">
      </div></td>
    
    </tr>
    <tr>
      <td height="115" colspan="6" align="left" valign="top"><table width="670" height="139" border="0">
          <tr valign="bottom">
            <td width="344">Prepared By : </td>
            <td width="310">Noted By: </td>
          </tr>
          <tr>
            <td><?php echo $prepared;?></td>
            <td>Alexander P. Poras<br>
            General Manager </td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="48" colspan="6" align="left" valign="top" style="padding-left:30px "><p>&nbsp;
          </p></td>
    </tr>
    <tr valign="middle">
      <td height="34" colspan="6" align="left"><div align="center">
          <input name="edit" type="submit" id="edit" value="UPDATE">
          <input name="cancel" type="button" id="cancel" value="CANCEL" 
		  onClick="document.location = 'editpurchaseorder.php?id=<?php echo $poNum;?>'">
      </div></td>
    </tr>
  </table>
</form>
<p align="center">&nbsp;</p>
</body>
</html>
