<?php
	include 'logcheck.php';
	include 'config.php';
	include 'functions.php';
	include 'setPO.php';
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>ASSOPHIL:: Purchase Order Entry</title>
<script language="javascript" type="text/javascript" src="ajax.js"></script>
<script language="javascript" type="text/javascript" src="functions.js"></script>
<script language="javascript" type="text/javascript" src="formvalidate.js"></script>
<script language="javascript" type="text/javascript" src="editformvalidate2.js"></script>
<link rel="stylesheet" type="text/css" href="styles1.css">
</head>

<body onLoad="ipafocus('supplier');">
<div id="menu"><a href="addsupplier.php">Add Supplier</a> | 
<a href="purchaseorder.php">Prepare Purchase Order</a> | <a href="listpo.php">View All POs</a> | <a href="search.php">SEARCH</a> | 
Hello <a href="editprofile.php?uname=<?php echo $_SESSION['uname'];?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></a> | 
<a href="logout.php">LOGOUT</a></div>
<div id="msg">
<?php
if(isset($_GET['id']))
{
	echo "Purchase Order No. <a href='viewPO.php?id=".$_GET['id']."'>".$_GET['id']."</a> has been successfully prepared! 
	Click the PO-number Link to view details";
}
else
{
	echo '';
}
?>
</div>
<h2 align="center">PURCHASE ORDER</h2>
<form name="form1" method="post" action="poComplete.php" onSubmit="return validate()">
<!-- number of lines-->
<input type="hidden" name="numoflines" id="numoflines" value="1">
<!-- number of lines-->
  
  <table width="826" height="502" border="0" align="center" id="potbl">
    <tr align="left" valign="top">
      <td height="23" colspan="6">
	  <div id="col1">
	  	<table width="500" height="80" border="0" cellspacing="0">
  <tr>
    <td width="149" height="38"><div align="center">Supplier ID : </div></td>
    <td width="305"><select name="supplier" id="supplier" onChange="getSupplierName(this.value,'supname');">
        <option value="0">[Select Supplier]</option>
        <?php
		  $getSupplier = mysql_query("SELECT * FROM supplier ORDER BY sID ASC") or die('error in getting supplier');
		  while(list($sid,$sname) = mysql_fetch_array($getSupplier))
		  {
		  	echo "<option value='$sid'>$sid</option>";
		  }
		  ?>
      </select>
    </td>
  </tr>
  <tr>
    <td height="50" colspan="2"><span id="supname" style="padding-left:20px;color:darkblue;font-family:Verdana, Arial, Helvetica, 
		  sans-serif; font-size:24px; text-align:center "></span></td>
  </tr>
  <tr>
    <td><div align="center">Attention : </div></td>
    <td><input name="attention" type="text" id="attention" size="25" maxlength="40"></td>
  </tr>
</table>
	  </div>
	  <div id="col2">
	    <table width="300" height="100" border="0" cellspacing="4">
          <tr>
            <td>Date: </td>
            <td><input name="fakedate" value="<?php echo date('d-M-y');?>" size="15" readonly="true"> 
			<input type="hidden" name="date" value="<?php echo date('Y-m-d');?>">
			<input type="hidden" name="year" value="<?php echo date('Y');?>">
			</td>
          </tr>
          <tr>
            <td>P.O no: </td>
            <td><input name="poNum" value="<?php echo $poNum;?>" readonly="true" size="15"></td>
          </tr>
          <tr>
            <td>Your ref. no: </td>
            <td><input type="text" name="refNo" size="10"></td>
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
						echo "<option value='$v'>$v</option>";
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
					echo "<option value='$val'>$val</option>";
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
		<div id="orders1" class="orders">
 		 <div style="width:90px; " id="itemno"><input type="hidden" size="7" id="item1" name="item[]" value="1">1</div>
		 <div style=" width:55px;" id="qty"><input type="text" size="3" id="qty1" name="qty[]"></div>
		 <div style="width:53px; " id="unit"><input type="text" size="4" id="unit1" name="unit[]"></div>
		 <div style="width:300px; " id="descriptions"><textarea rows="3" cols="30" id="descript1" name="descript[]"></textarea></div>
		 <div style="width:101px; " id="unitprice"><input type="text" size="7" id="up1" name="up[]"></div>
		 <div style="width:127px; float:left; font-size:16px" id="lineamount1"></div><input type="hidden" name="amount[]" id="amount1">
		 <div style="width:75px; "><input type="button" id="add1" value="Add Line" style="font-size:10px;" onClick="checkOrderline(1);ipafocus('qty2')"> 
		 <input type="button" name="remove1" id="remove1" value="Remove" style="font-size:10px; display:none" onClick="removeline(1)">
		 <input type="button" name="update1" id="update1" value="Update" style="font-size:10px; display:none" onClick="edit(1)"></div>
		 <script>assignnumoflines();</script>
		</div>
		</div>
	  </td>
    </tr>
    <tr>
      <td height="23"><div id="totalamount" align="right"><strong>Total Price (12% VAT Inclusive)</strong>
	  <input name="total" type="text" id="total" style=" border:0; color:darkblue; font-size:20px; font-weight:600; 
			  text-align:center" value="P 0.00" size="15" readonly="true"> <input type="hidden" id="totalprice" name="totalprice">
      </div></td>
    
    </tr>
    <tr>
      <td height="115" colspan="6" align="left" valign="top"><table width="670" height="139" border="0">
          <tr valign="bottom">
            <td width="344">Prepared By : </td>
            <td width="310">Noted By: </td>
          </tr>
          <tr>
            <td><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?>
			<input name="prepared" type="hidden" id="prepare" value="<?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?>"></td>
            <td>Alexander P. Poras<br>
            General Manager </td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="48" colspan="6" align="left" valign="top" style="padding-left:30px "><p>
          <input name="desccheck" type="checkbox" id="desccheck" value="checkbox" 
		  onClick="showDescript(this.id,'descrip','transDesc')">
          <strong>Make Transaction Description </strong></p>
          <p align="left"> <span id="descrip" style="display:none ">
            <textarea name="transDesc" cols="40" rows="6" id="transDesc" disabled></textarea>
          </span> </p>
          <p align="left">&nbsp; </p></td>
    </tr>
    <tr valign="middle">
      <td height="34" colspan="6" align="left"><div align="center">
          <input name="save" type="submit" id="save" value="SAVE">
          <input type="reset" name="Reset" value="Cancel">
      </div></td>
    </tr>
  </table>
</form>
<p align="center">&nbsp;</p>
</body>
</html>
