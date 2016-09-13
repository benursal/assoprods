<?php include 'logcheck.php';?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>APP :: List Of All Suppliers</title>
<style>
.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
</style>
<link rel="stylesheet" type="text/css" href="styles/newStyle.css">
<script language="javascript" type="text/javascript" src="js/functions3.js"></script>
<?php include 'dropDownMenuLookAndFeel.php'; // css, javascript for drop down menu.. 

?>

</head>

<body onLoad="document.getElementById('suppId').focus();">
<?php 
		if($_POST['addSupp'])
		{
			$suppId = trim($_POST['suppId']);
			$suppName = trim($_POST['suppName']);
			$suppAddress  = trim($_POST['address']);
			
			include 'addCompany.php';
			
			$newSupplier = new addCompany($suppId,$suppName,$suppAddress, 'supplier');
			echo "<div id=\"msg\">".$newSupplier->showMessage()."</div>";
			if($newSupplier->getStatus() == 'good')
			{
				$_POST['suppId'] = '';
				$_POST['suppName'] = '';
				$_POST['address'] = '';
			}
		}
		
		if(isset($_GET['sid']))
		{
			$sid = $_GET['sid'];
			$query = mysql_query("SELECT * FROM supplier WHERE sID = '$sid'") or die('error');
			list($id, $name, $addr) = mysql_fetch_array($query);
			$_POST['suppId'] = $id;
			$_POST['suppName'] = $name;
			$_POST['address'] = $addr;		
			
			$origId = $id; // for purpose of comparison when updating
			$origName = $name; // for purpose of comparison when updating
			
			$submitButton = "<input type=\"submit\" value=\"UPDATE\" name=\"updateSupp\">";
		}
		else
		{
			$submitButton = "<input type=\"submit\" value=\"ADD\" name=\"addSupp\">";
		}
		
		if(isset($_GET['deleted']))
		{
			echo "<div id=\"deleteMsg\">Supplier ID <u>".$_GET['deleted']."</u> Has Been Deleted</div>";
		}
		else
		{
			echo "";
		}
?>
<form name="addSupp" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div id="wrapper">
	<div id="header">
		<div id="banner">
		  <div id="menu"><?php include 'dropDown.php';?></div>
	  </div>
	</div>
	
	<div id="content">
		<div id="title">
		  <h3>All Suppliers</h3>
		</div>
		<div id="addCompany">
			<table border="0" cellspacing="1" cellpadding="10">
				<tr bgcolor="#003300"><td colspan="2"><span>Add New Supplier</span></td></tr>
				<tr bgcolor="#CCFF99"><td align="right">Supplier ID :</td><td align="left">
				<input id="suppId" name="suppId" size="15" value="<?php echo $_POST['suppId'];?>"></td></tr>
				<tr bgcolor="#CCFF99"><td align="right">Supplier Name :</td><td align="left">
				<input id="suppName" name="suppName" size="50" value="<?php echo $_POST['suppName'];?>"></td></tr>
				<tr bgcolor="#CCFF99">
				  <td align="right">Address : </td>
				  <td align="left"><textarea name="address" cols="35" rows="5" id="address" wrap="hard"></textarea></td>
			  </tr>
				<tr bgcolor="#CCFF99"><td align="right"></td><td align="left">
				<input type="submit" value="ADD" name="addSupp">
				<input type="button" value="Cancel" name="cancel" onClick="document.location = 'viewSuppliers.php'">
				</td></tr>
			</table>
		</div>
	
		<div id="titolo">LIST OF SUPPLIERS</div>
		<div id="companyList">
			<?php
				
				$query = mysql_query("SELECT * FROM supplier ORDER BY sID ASC") or die('error');			
				if(mysql_num_rows($query) > 0)
				{
					$x = 1;
					echo "<table border=0 cellpaddnig=10 cellspacing=2>";
					echo "<tr bgcolor=pink><th width=140>Supplier ID</th><th width=400>Supplier Name</th>";
					echo "<th width=90>EDIT</th><th width=90>DELETE</th></tr>";
					while(list($suppId,$suppName) = mysql_fetch_array($query))
					{
				
						$color = ($x%2 == 0) ? 'white' : 'yellow';
						
						echo "<tr bgcolor=$color><td>".strtoupper($suppId)."</td><td>$suppName</td>";
						echo "<td><a href=\"viewSuppliers.php?sid=$suppId\">[EDIT]</a></td>
						<td><a href=# onclick=\"deleteItem('".ucwords('supplier')."','$suppId');return false;\">[DELETE]</a></td></tr>";
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

