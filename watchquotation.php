<?php	//FUNCTION INCLUSIONS
	include 'logcheck.php'; // connect to mysql, database, and table
	include 'functions.php'; //
	
	if(isset($_GET['num']))
	{
		$num = $_GET['num'];
	}
 	$type = 'quotation'; //set type to 'po' so that the variables in the include 'watchVariables would be appropriate for POs
 	include 'watchVariables.php';
	include 'mainFormValues.class.php';
	$mainForm = new mainFormValues($type, $num);
	$values = $mainForm->getWatchValues();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title><?php echo $title;?></title>
<style>
.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
</style>
<link rel="stylesheet" type="text/css" href="styles/quoteViewRecordStyle.css">
<?php include 'dropDownMenuLookAndFeel.php'; // css, javascript for drop down menu.. 

?>

</head>

<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">logo</div>
		<div id="banner">
		  <div id="menu"><?php include 'dropDown.php';?></div>
	  </div>
	</div>
	
	<div id="content">
		<div id="title">
		  <h3><?php echo $title;?></h3>
		</div>
		<div id="quote">
			<div id="mainForm">
			  <table width="779" height="442" border="0">
                  <tr>
                    <td width="398" height="218" valign="top">
					<table width="391" height="166" border="0">
                      <?php for($x=0; $x<4;$x++)
					  {
					  ?>
					  <tr>
                        <td width="138" height="40"><div align="right"><?php echo $labels[$x]." : ";?></div></td>
                        <td width="10">&nbsp;</td>
                        <td width="238" height="40">
						<div align="left">
						<?php echo $values[$x];?>
                        </div></td>
                      </tr>
					  <?php
					  }
					  ?>
					
                    </table></td>
                    <td width="371" align="right" valign="top"><div align="left"></div>
                      <table width="332" height="166" border="0">
                      <?php for($x; $x < sizeof($labels); $x++)
					  {
					  ?>
					  <tr>
                        <td width="135" height="40"><div align="right"><?php echo $labels[$x]." : ";?></div></td>
                        <td width="10">&nbsp;</td>
                        <td width="182" height="40">
						<div align="left">
						<?php echo $values[$x];?>
                        </div>
						</td>
                      </tr>
              			<?php 
						}
						?>
					  <tr><td>&nbsp;</td></tr>
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
				</div>
				<div id="itemList">
					<?php 
						include 'watchItemList.class.php';
						$itemList = new watchItemList('quotation', $num);
						$itemList->showItemList();
					?>
				</div>
			</div>
		</div>
		<div id="totalAmountDiv">
		<?php
		//==========================================================================
			include 'quotationPriceBreakDown.php';
	//=======================================================================================			
		?>
		</div>
		<div id="buttons">
			<input type="submit" id="edit" value="   EDIT   " onClick="document.location ='editQUOTATION.php?num=<?php echo $num;?>'">
			<a href="qPrintable.php?type=po&num=<?php echo $num;?>" target="_blank" 
style="font-size:14px; color:white; font-family:verdana">
View Printable Page</a>
		</div>
	</div>
	<div id="footer">
		created by edward benedict ursal
	</div>
</div>
</body>
</html>
