<?php	//FUNCTION INCLUSIONS
	include 'logcheck.php'; // connect to mysql, database, and table
	include 'functions.php'; //
	include 'setNum.php'; // function to set PO and Quotation number. FOR THIS PAGE, IT'S PURPOSE IS TO SET QUOTATION NUMBER
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>APP:: QUOTATION</title>
<style>
.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
</style>
<script>
	var x = 1;
	var y = 1;
</script>
<script language="javascript" type="text/javascript" src="js/itemsScript.js"></script>
<script language="javascript" type="text/javascript" src="js/numberFormat.js"></script>
<link rel="stylesheet" type="text/css" href="styles/newStyleQuote.css">
<link rel="stylesheet" type="text/css" href="styles/dialogBoxStyle.css">
<script language="javascript" type="text/javascript" src="js/createXmlHttp.js"></script>
<script language="javascript" type="text/javascript" src="js/addDialogEvents.js"></script>
<script language="javascript" type="text/javascript" src="js/qFunctions.js"></script>
<script language="javascript" type="text/javascript" src="js/qFunctions2.js"></script>
<script language="javascript" type="text/javascript" src="js/discountFuncts.js"></script>
<?php include 'dropDownMenuLookAndFeel.php'; // css, javascript for drop down menu.. 

?>
</head>

<body onLoad="document.getElementById('custId').focus();" onBeforeUnload="return false;">
<?php  include 'addDialogBox.php';?>

<div id="errorMsg">error message</div>

<form method="post" action="saveQuotation.php" onSubmit="return false;" name="quotation" id="quotation">
<div id="wrapper">
	<div id="header">
		<div id="banner">
		  <div id="menu"><?php include 'dropDown.php';?></div>
	  </div>
	</div>
	
	<div id="content">
		<div id="title"><h3>Create Quotation</h3></div>
		<div id="quote">
			<div id="mainForm">
			  <table width="779" height="442" border="0">
                  <tr>
                    <td width="398" height="218" valign="top"><table width="391" height="196" border="0">
                      <tr>
                        <td width="138" height="40"><div align="right">Customer ID : </div></td>
                        <td width="10">&nbsp;</td>
                        <td width="238" height="40"><div align="left">
                         <select name="custId" id="custId" onChange="getName('cust', this.value, 'custName', 'custAddress')">
						 	<option value="">[Select Customer]</option>
							<?php
						 		$cInfoQuery = mysql_query("SELECT * FROM customer") or die('Error in custId and custName query');
						 		while(list($custId, $custName) = mysql_fetch_array($cInfoQuery))
								{
									echo "<option value='$custId'>$custId</option>";
								}
							?>
						 </select> <input type="button" id="addCust" value="Add" class="addButton" onClick="showDialog('cust', 'custId');">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="36"><div align="right">Customer Name : </div></td>
                        <td>&nbsp;</td>
                        <td height="36"><div align="left">
                            <input name="custName" type="text" id="custName" size="35" readonly="true">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="36"><div align="right">Address : </div></td>
                        <td>&nbsp;</td>
                        <td height="36"><div align="left">
                          <textarea id="custAddress" name="custAddress" cols="34" rows="3" readonly wrap="hard"></textarea>
                        </div></td>
                      </tr>
                      <tr>
                        <td height="36"> <div align="right">Attention : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="36"><div align="left">
                          <input name="attention" type="text" id="attention" size="20">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="36"> <div align="right">Subject : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="36"><div align="left">
                          <input name="subject" type="text" id="subject" size=30 
			maxlength=100>
                        </div></td>
                      </tr>
                    </table></td>
                    <td width="371" align="right" valign="top"><div align="left"></div>
                      <table width="332" height="224" border="0">
                      <tr>
                        <td width="135" height="35"><div align="right">Date :</div></td>
                        <td width="10">&nbsp;</td>
                        <td width="182" height="35"><div align="left">
                          <input name="fakeDate" type="text" id="date" readonly="true" value="<?php echo date('d-M-y');?>">
						  <input type="hidden" name="date" value="<?php echo date('Y-m-d');?>">
						  <input type="hidden" name="year" value="<?php echo date('Y');?>">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="35"><div align="right">Quotation Number : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="35"><div align="left">
                          <input name="quotNum" type="text" id="transNum" readonly="true" value="<?php echo setNum('q');?>">
                        </div>
						</td>
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
									echo "<option value=$tid>$tname</option>";
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
									echo "<option value=$did>$dname</option>";
								}
							?>
                          </select> <input type="button" id="addDelivery" value="Add" onClick="showDialog('del', 'delivery');">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="35"><div align="right">Validity : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="35"><div align="left">
                          <select name="validity" id="validity">
						  	<option value="">[Select One]</option>
							<?php
								$getValidity = mysql_query("SELECT * FROM validity") or die('Error in validity query');
								while(list($vid,$vname) = mysql_fetch_array($getValidity))
								{
									echo "<option value=$vid>$vname</option>";
								}
							?>
                          </select> <input type="button" id="addValidity" value="Add" onClick="showDialog('val', 'validity');">
                        </div></td>
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
					<div id="supp_price">S-Price</div>
					<div id="unit_price">Unit Price</div>
					<div id="amount">Amount</div>
					<div id="actions">Actions</div>
				</div>
				<div id="itemList">
					<div id="item1" class="items">
						<div id="item_no_i1" class="item_no_i">1</div>
						<div id="quantity_i1" class="quantity_i">
						<input name="qty[]" id="qty1" size="3" maxlength="5" onKeyPress="return isNumberKey(event);" 
						onKeyUp="calculate(event, this.id, 'up1', 'amount_i1', 1, 8)">
						</div>   
						<div id="unit_measure_i1" class="unit_measure_i"><input name="unit[]" id="unit1" size="4" maxlength="5"></div>
						<div id="description_i1" class="description_i">
						<textarea cols="34" rows="3" id="descript1" name="descript[]" wrap="hard"></textarea>
						</div>
						<div id="supp_price_i1" class="supp_price_i">
						<input name="sp[]" id="sp1" size="12" maxlength="20">
						</div>
						<div id="unit_price_i1" class="unit_price_i">
						<input name="up[]" id="up1" size="12" maxlength="20" onKeyUp="calculate(event, this.id, 'qty1', 'amount_i1', 1, 8)">
						</div>
						<div id="amount_i1" class="amount_i">P 0.00</div>
						<div id="actions_i1" class="actions_i"><a href="#" id="addItem1" class="addItem" onClick="addItem('q'); return false">+</a> 
						<a href="#" id="removeItem1" onClick="remove(1,1, 8); return false">-</a>
						<input type="hidden" id="hid1" name="hid[]" value="1">
						</div>
						<input type="text" id="itemAmount1" name="amount[]" value="0" class="nkaTago">
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="refNo" name="refNo" value="hehe">
		<div id="totalAmountDiv">
			Price is 12% VAT 
			<select name="vatInc">
				<option value="inclusive" selected>Inclusive</option>
				<option value="exclusive">Exclusive</option>
			</select>	
			:<span id="total">P 0.00</span>
			<input type="hidden" id="formattedTotal" name="formattedTotal">
		</div>
		<div id="discnt"><span id="vatS"><input type="checkbox" name="vat" id="vat" value="12">Add VAT </span>
			<span id="discS"><input type="checkbox" id="disc" name="disc" onClick="showDiscount()"> Add Discount </span>
			<span id="rateS" style="visibility:hidden ">| | 
			Rate : <input type="text" id="rate" name="rate" size="10" onKeyPress="return isNumberKey(event);"></span>
		</div>
		<div id="buttons">
			<input type="button" value="Save Only" onClick="validateMainForm('quotation', 'custId', 'Customer');"> 
			<input type="button" value="Refresh" onClick="refreshTransaction('quotation.php');"> 
			<input type="Button" value="Cancel" onClick="cancelTransaction();">
		</div>
	</div>
	<div id="footer">
	<input type="hidden" id="transDesc" name="qDesc" value="">
		created by edward benedict ursal
	</div>
</div>
</form>
</body>
</html>
