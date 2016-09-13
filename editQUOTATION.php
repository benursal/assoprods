<?php	//FUNCTION INCLUSIONS
	include 'logcheck.php'; // connect to mysql, database, and table
	include 'functions.php'; //
	//include 'setNum.php'; // function to set PO and Quotation number. FOR THIS PAGE, IT'S PURPOSE IS TO SET QUOTATION NUMBER
	include 'quotationList.class.php';
 	include 'mainFormValues.class.php';
 //-----------	this code is to check if the q parameter is set.. if yes, then create a purchaseOrderList Object with parameter 'q'
	if(isset($_GET['num']))
	{
		$num = $_GET['num'];
		$qList = new QuotationList($num);
	}
	
	$mainForm = new mainFormValues('quotation', $num);
	$values = $mainForm->getEditValues();
 //-----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>Edit Quotation <?php echo $num;?></title>
<style>
.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
</style>
<?php echo "
<script>";
	echo $qList->getXandY(); // displays the var x and var y values which are needed for item numbers in the item list below
echo "</script>";
?>
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

<form method="post" action="updateQuotation.php?type=quotation&q=<?php echo $qList->getRefNoValue();?>" 
onSubmit="return false;" name="quotation" id="quotation">
<div id="wrapper">
	<div id="header">
		<div id="logo">logo</div>
		<div id="banner">
		  <div id="menu"><?php include 'dropDown.php';?></div>
	  </div>
	</div>
	
	<div id="content">
		<div id="title">
		  <h3>Edit Quotation <?php echo $num;?></h3>
		</div>
		<div id="transDescript"><b>Transaction Name :</b> 
		<input type="hidden" id="transDesc" name="qDesc" value="<?php echo $values[10];?>"><?php echo $values[10];?>
		</div>
		<div id="quote">
			<div id="mainForm">
			  <table width="779" height="442" border="0">
                  <tr>
                    <td width="398" height="218" valign="top"><table width="391" height="166" border="0">
                      <tr>
                        <td width="138" height="40"><div align="right">Customer ID : </div></td>
                        <td width="10">&nbsp;</td>
                        <td width="238" height="40"><div align="left">
                         <select name="custId" id="custId" onChange="getName('cust', this.value, 'custName', 'custAddress')">
						 	<option value="">[Select Supplier]</option>
							<?php
						 		$sInfoQuery = mysql_query("SELECT * FROM customer") or die('Error in custId and custName query');
						 		while(list($custId, $custName) = mysql_fetch_array($sInfoQuery))
								{
									if($custId == $values[0])
									{
										echo "<option value='$custId' selected>$custId</option>";
									}
									else
									{
										echo "<option value='$custId'>$custId</option>";
									}
								}
							?>
						 </select> <input type="button" id="addCust" value="Add" class="addButton" onClick="showDialog('cust', 'custId');">
                        </div></td>
                      </tr>
                      <tr>
                        <td height="36"><div align="right">Customer Name : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="36"><div align="left">
                          <input name="custName" type="text" id="custName" size="35" readonly="true" value="<?php echo $values[1];?>">
                        </div></td>
                      </tr>
					  <tr>
                        <td height="36"><div align="right">Address : </div></td>
                        <td>&nbsp;</td>
                        <td height="36"><div align="left">
                          <textarea id="custAddress" name="custAddress" cols="34" rows="3" readonly wrap="hard"><?php 
						  
						  echo $values[11];
						  
						  ?>
						  </textarea>
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
                        <td height="36"> <div align="right">Subject : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="36"><div align="left">
						<input name="subject" type="text" id="subject" value="<?php echo $values[3];?>"></div>
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
                        <td height="35"><div align="right">Quotation Number : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="35"><div align="left">
                         <input name="quotNum" type="text" id="transNum" readonly="true" value="<?php echo $values[5];?>">
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
                        <td height="35"><div align="right">Validity : </div></td>
                        <td width="10">&nbsp;</td>
                        <td height="35"><div align="left">
                          <select name="validity" id="validity">
						  	<option value="">[Select One]</option>
							<?php
								$getValidity = mysql_query("SELECT * FROM validity") or die('Error in validity query');
								while(list($vid,$vname) = mysql_fetch_array($getValidity))
								{
									if($vid == $values[8])
									{
										echo "<option value=$vid selected>$vname</option>";
									}
									else
									{
										echo "<option value=$vid>$vname</option>";
									}
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
					<?php echo $qList->getItemList();?>
				</div>
			</div>
		</div>
		<div id="totalAmountDiv">
			Price is 12% VAT 
			<select name="vatInc">
			<?php $inclusion = array("inclusive", "exclusive");
				foreach($inclusion as $k=>$v)
				{
					$sel = ($v == $values[12]) ? " selected" : "";
					echo "<option value=$v $sel>".ucfirst($v)."</option>";
				}	
			?>
			</select>	
			:<span id="total">P <?php echo number_format($qList->getTotal(),2);?></span>
			<input type="hidden" id="formattedTotal" name="formattedTotal" value="<?php echo $qList->getTotal();?>">
		</div>
		<div id="discnt"><span id="vatS">
		<?php
			$checked = ($values[13] == '12') ? " checked" : "";
			
			if($values[14] != '' AND $values[14] != '0' AND $values[14] != NULL)
			{
				$checked2 = "checked";
				$vis = "visible";
			}
			else
			{
				$checked2 = "";
				$vis = "hidden";
			}
		?>
		<input type="checkbox" name="vat" id="vat" value="12"<?php echo $checked;?>>Add VAT </span>
			<span id="discS"><input type="checkbox" id="disc" name="disc" onClick="showDiscount()"<?php echo $checked2;?>> Add Discount </span>
			<span id="rateS" style="visibility:<?php echo $vis;?> ">| | 
			Rate : <input type="text" id="rate" name="rate" size="10" onKeyPress="return isNumberKey(event);" 
			value="<?php echo $values[14];?>"></span>
		</div>
		<div id="buttons">
			<input type="button" value="Save Changes" onClick="validateMainForm('quotation', 'custId', 'Customer');"> 
			<input type="button" value="Refresh" onClick="refreshTransaction('editQUOTATION.php?num=<?php echo $num;?>');"> 
			<input type="Button" value="Cancel" onClick="cancelTransaction();">
		</div>
	</div>
	<div id="footer">
	<input type="hidden" id="refNo" name="refNo" value="hahah">
		created by edward benedict ursal
	</div>
</div>
</form>
</body>
</html>
