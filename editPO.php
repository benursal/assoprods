<?php	//FUNCTION INCLUSIONS
	include 'logcheck.php'; // connect to mysql, database, and table
	include 'functions.php'; //
	//include 'setNum.php'; // function to set PO and Quotation number. FOR THIS PAGE, IT'S PURPOSE IS TO SET QUOTATION NUMBER
	include 'purchaseOrderList.class.php';
 	include 'mainFormValues.class.php';
 //-----------	this code is to check if the q parameter is set.. if yes, then create a purchaseOrderList Object with parameter 'q'
	if(isset($_GET['num']))
	{
		$num = $_GET['num'];
		$poList = new purchaseOrderList('po',$num);
	}
	else
	{
		$poList = new purchaseOrderList('po');
	}
	
	$mainForm = new mainFormValues('po', $num);
	$values = $mainForm->getEditValues();
 //-----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>Edit Purchase Order <?php echo $num;?></title>
<style>
.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
</style>
<?php echo "
<script>";
	echo $poList->getXandY(); // displays the var x and var y values which are needed for item numbers in the item list below
echo "</script>";
?>
<script language="javascript" type="text/javascript" src="js/itemsScript.js"></script>
<script language="javascript" type="text/javascript" src="js/numberFormat.js"></script>
<link rel="stylesheet" type="text/css" href="styles/newStyle.css">
<link rel="stylesheet" type="text/css" href="styles/dialogBoxStyle.css">
<script language="javascript" type="text/javascript" src="js/createXmlHttp.js"></script>
<script language="javascript" type="text/javascript" src="js/addDialogEvents.js"></script>
<script language="javascript" type="text/javascript" src="js/functions.js"></script>
<script language="javascript" type="text/javascript" src="js/functions2.js"></script>
<script language="javascript" type="text/javascript" src="js/functions3.js"></script>

<?php include 'dropDownMenuLookAndFeel.php'; // css, javascript for drop down menu.. 

?>

</head>

<body onLoad="document.getElementById('suppId').focus();" onBeforeUnload="return false;">
<?php  include 'addDialogBox.php';?>

<div id="errorMsg">error message</div>

<form method="post" action="updatePO.php?type=po&q=<?php echo $poList->getRefNoValue();?>" onSubmit="return false;" name="po" id="po">
<div id="wrapper">
	<div id="header">
		<div id="logo">logo</div>
		<div id="banner">
		  
		  <div id="menu"><?php include 'dropDown.php';?></div>
	  </div>
	</div>
	
	<div id="content">
		<div id="title">
		  <h3>Edit Purchase Order <?php echo $num;?></h3>
		</div>
		<div id="transDescript"><b>Transaction Name :</b> 
		<input type="hidden" id="transDesc" name="poDesc" value="<?php echo $values[9];?>"><?php echo $values[9];?>
		</div>
		<div id="quote">
			<div id="mainForm">
			  <table width="779" height="442" border="0">
                  <tr>
                    <td width="398" height="218" valign="top"><table width="391" height="166" border="0">
                      <tr>
                        <td width="138" height="40"><div align="right">Supplier ID : </div></td>
                        <td width="10">&nbsp;</td>
                        <td width="238" height="40"><div align="left">
                         <select name="suppId" id="suppId" onChange="getName('supp', this.value,'suppName', 'suppAddress')">
						 	<option value="">[Select Supplier]</option>
							<?php
						 		$sInfoQuery = mysql_query("SELECT * FROM supplier") or die('Error in suppId and suppName query');
						 		while(list($suppId, $suppName) = mysql_fetch_array($sInfoQuery))
								{
									if($suppId == $values[0])
									{
										echo "<option value='$suppId' selected>$suppId</option>";
									}
									else
									{
										echo "<option value='$suppId'>$suppId</option>";
									}
								}
							?>
						 </select> <input type="button" id="addSupp" value="Add" class="addButton" onClick="showDialog('supp', 'suppId');">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="36"><div align="right">Supplier Name : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="36"><div align="left">
                          <input name="suppName" type="text" id="suppName" size="35" readonly="true" value="<?php echo $values[1];?>">
                        </div></td>
                      </tr>
					  <tr>
                        <td height="36"><div align="right">Address : </div></td>
                        <td>&nbsp;</td>
                        <td height="36"><div align="left">
                            <textarea id="suppAddress" name="suppAddress" cols="34" rows="3" readonly wrap="hard"><?php
								echo $values[10];
							?></textarea>
                        </div></td>
                      </tr>
                      <tr>
                        <td height="36"> <div align="right">Attention : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="36"><div align="left">
                          <input name="attention" type="text" id="attention" size="20" value="<?php echo $values[2];?>">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="36"> <div align="right">Ref Number : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="36"><div align="left"><input type="text" id="refNo" name="refNo" value="<?php echo $values[3];?>"></div>
						<input type="hidden" name="subject" type="text" id="subject" value="heheh">
						</td>
                      </tr>
                    </table></td>
                    <td width="371" align="right" valign="top"><div align="left"></div>
                      <table width="332" height="224" border="0">
                      <tr>
                        <td width="135" height="35"><div align="right">Date :</div></td>
                        <td width="10">&nbsp;</td>
                        <td width="182" height="35"><div align="left">
                          <input name="fakeDate" type="text" id="date" readonly="true" value="<?php echo $values[4];?>">
						  <input type="hidden" name="date" value="<?php echo date('Y-m-d');?>">
						  <input type="hidden" name="year" value="<?php echo date('Y');?>">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="35"><div align="right">PO Number : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="35"><div align="left">
                          <input name="poNum" type="text" id="transNum" readonly="true" value="<?php echo $values[5];?>">
                        </div></td>
                      </tr>
					   <tr>
                        <td height="35"><div align="right">Terms : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="35"><div align="left">
                          <select name="terms" id="terms">
						  	<option value="">[Select One]</option>
							<?php
								$getTerms = mysql_query("SELECT * FROM terms") or die('Error in terms query');
								while(list($tid,$tname) = mysql_fetch_array($getTerms))
								{
									if($tid == $values[6])
									{
										echo "<option value=$tid selected>$tname</option>";
									}
									else
									{
										echo "<option value=$tid>$tname</option>";
									}
								}
							?>
                          </select> <input type="button" id="addTerm" value="Add" onClick="showDialog('terms', 'terms');">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="35"><div align="right">Delivery : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="35"><div align="left">
                          <select name="delivery" id="delivery">
						  	<option value="">[Select One]</option>
							<?php
								$getDelivery = mysql_query("SELECT * FROM delivery") or die('Error in delivery query');
								while(list($did,$dname) = mysql_fetch_array($getDelivery))
								{
									if($did == $values[7])
									{
										echo "<option value=$did selected>$dname</option>";
									}
									else
									{
										echo "<option value=$did>$dname</option>";
									}
								}
							?>
                          </select> <input type="button" id="addDelivery" value="Add" onClick="showDialog('del', 'delivery');">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="35">&nbsp;</td>
                        <td width="10">&nbsp;</td>
                        <td height="35">&nbsp;</td>
                      </tr>
					  
                    </table></td>
                  </tr>
                  <tr>
                    <td height="218" valign="top">&nbsp;</td>
                    <td align="right" valign="top">&nbsp;</td>
                  </tr>
              </table>
			</div>
			<div id="subForm">
				<div id="headings">
					<div id="item_no">Item No</div>
					<div id="quantity">Qty</div>   
					<div id="unit_measure">Unit</div>
					<div id="description">Description</div>
					<div id="unit_price">Unit Price</div>
					<div id="amount">Amount</div>
					<div id="actions">Actions</div>
				</div>
				<div id="itemList">
					<?php echo $poList->getItemList();?>
				</div>
			</div>
		</div>
		<input type="hidden" id="validity" name="validity" value="haha">
		<div id="totalAmountDiv">
			Price is 12% VAT Included:<span id="total">P <?php echo number_format($poList->getTotal(),2);?></span>
			<input type="hidden" id="formattedTotal" name="formattedTotal" value="<?php echo $poList->getTotal();?>">
		</div>
		<div id="buttons">
			<input type="button" value="Save Changes" onClick="validateMainForm('po', 'suppId', 'Supplier');"> 
			<input type="button" value="Refresh" onClick="refreshTransaction('editPO.php?num=<?php echo $num;?>');"> 
			<input type="Button" value="Cancel" onClick="cancelTransaction();">
		</div>
	</div>
	<div id="footer">
		created by edward benedict ursal
	</div>
</div>
</form>
</body>
</html>
