<?php include 'logcheck.php';?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>APP :: List Of All Customers</title>
<style>
.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
</style>
<link rel="stylesheet" type="text/css" href="styles/newStyle.css">
<script language="javascript" type="text/javascript" src="js/functions3.js"></script>
<?php include 'dropDownMenuLookAndFeel.php'; // css, javascript for drop down menu.. 

?>

</head>

<body onLoad="document.getElementById('custId').focus();">
<?php 
		if($_POST['addCust'])
		{
			$custId = trim($_POST['custId']);
			$custName = trim($_POST['custName']);
			$custAddress  = trim($_POST['address']);
			
			include 'addCompany.php';
			
			$newCustomer = new addCompany($custId,$custName, $custAddress, 'customer');
			echo "<div id=\"msg\">".$newCustomer->showMessage()."</div>";
			if($newCustomer->getStatus() == 'good')
			{
				$_POST['custId'] = '';
				$_POST['custName'] = '';
				$_POST['address'] = '';
			}
		}
		
		if(isset($_GET['cid']))
		{
			$cid = $_GET['cid'];
			$query = mysql_query("SELECT * FROM customer WHERE custID = '$cid'") or die('error');
			list($id, $name, $addr) = mysql_fetch_array($query);
			$_POST['custId'] = $id;
			$_POST['custName'] = $name;
			$_POST['address'] = $addr;		
			
			$origId = $id; // for purpose of comparison when updating
			$origName = $name; // for purpose of comparison when updating
			
			$submitButton = "<input type=\"submit\" value=\"UPDATE\" name=\"updateCust\">";
		}
		else
		{
			$submitButton = "<input type=\"submit\" value=\"ADD\" name=\"addCust\">";
		}
		
		if($_POST['updateCust'])
		{
			$custId = trim($_POST['custId']);
			$custName = trim($_POST['custName']);
			$custAddress  = trim($_POST['address']);
			
			include 'updateCompany.php';
			
			$updateCustomer = new updateCompany($custId, $origId, $custName, $origName, $custAddress, 'customer');
			echo "<div id=\"msg\">".$updateCustomer->showMessage()."</div>";
			if($updateCustomer->getStatus() == 'good')
			{
				$_POST['custId'] = '';
				$_POST['custName'] = '';
				$_POST['address'] = '';
			}
		}
		
		if(isset($_GET['deleted']))
		{
			echo "<div id=\"deleteMsg\">Customer ID <u>".$_GET['deleted']."</u> Has Been Deleted</div>";
		}
		else
		{
			echo "";
		}
?>
<form name="addCust" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div id="wrapper">
	<div id="header">
		<div id="banner">
		  
		  <div id="menu"><?php include 'dropDown.php';?></div>
	  </div>
	</div>
	
	<div id="content">
		<div id="title">
		  <h3>All Customers</h3>
		</div>
		<div id="addCompany">
			<table border="0" cellspacing="1" cellpadding="10">
				<tr bgcolor="#003300"><td colspan="2"><span>Add New Customer</span></td></tr>
				<tr bgcolor="#CCFF99"><td align="right">Customer ID :</td><td align="left">
				<input id="custId" name="custId" size="15" value="<?php echo trim($_POST['custId']);?>"></td></tr>
				<tr bgcolor="#CCFF99"><td align="right">Customer Name :</td><td align="left">
				<input id="custName" name="custName" size="50" value="<?php echo trim($_POST['custName']);?>"></td></tr>
				<tr bgcolor="#CCFF99">
                  <td align="right">Address : </td>
                  <td align="left">
				  <textarea name="address" cols="35" rows="5" id="address" wrap="hard"><?php echo trim($_POST['address']);?></textarea></td>
			  </tr>
				<tr bgcolor="#CCFF99"><td align="right"></td><td align="left">
				<?php echo $submitButton;?>
				<input type="button" value="Cancel" name="cancel" onClick="document.location = 'viewCustomers.php'">
				</td></tr>
			</table>
		</div>
	
		<div id="titolo">LIST OF CUSTOMERS</div>
		<div id="companyList">
			<?php
				
				$query = mysql_query("SELECT * FROM customer ORDER BY custID ASC") or die('error');			
				if(mysql_num_rows($query) > 0)
				{
					$x = 1;
					echo "<table border=0 cellpaddnig=10 cellspacing=2>";
					echo "<tr bgcolor=pink><th width=140>Customer ID</th><th width=400>Customer Name</th>";
					echo "<th width=90>EDIT</th><th width=90>DELETE</th></tr>";
					while(list($custId,$custName, $address) = mysql_fetch_array($query))
					{
				
						$color = ($x%2 == 0) ? 'white' : 'yellow';
						
						echo "<tr bgcolor=$color><td>".strtoupper($custId)."</td><td>$custName</td>";
						echo "<td><a href=\"viewCustomers.php?cid=$custId\">[EDIT]</a></td>
						<td><a href=# onclick=\"deleteItem('".ucwords('customer')."','$custId');return false;\">[DELETE]</a></td></tr>";
						$x++;
					}
					echo "</table>";
				}
			?>
		</div>
	</div>
	<div id="footer">
		created by edward benedict ursal
	</div>
</div>
</form>
</body>
</html>

