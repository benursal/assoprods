<?php
include 'logcheck.php';
$errors = array();
if(isset($_POST['save']))
{
	include 'config.php';
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	//supplier id
	if(trim($id) == '')
	{
		$errors[] = 'Please Enter Supplier ID';
		$id = '';
	}
	else
	{
		$allsuppliers = mysql_query("SELECT sID FROM supplier WHERE sID = '$id'") or die('error in allsuppliers query');
		if(mysql_num_rows($allsuppliers) == 1)
		{
			$errors[] = 'Supplier ID <b>'.$id.'</b> already taken! Please enter another ID. ';
			$id = '';
		}
	}
	//supplier name
	if(trim($name) == '')
	{
		$errors[] = 'Please enter Supplier Name! ';
		$name = '';
	}
	else
	{
		$allsuppliers2 = mysql_query("SELECT name FROM supplier WHERE name = '$name'") or die('error in allsuppliers2 query');
		if(mysql_num_rows($allsuppliers2) == 1)
		{
			$errors[] = 'Supplier Name <b>'.$name.'</b> aleady taken!  Please enter another name.';
			$name = '';
		}
	}
	
	if(sizeof($errors)==0)
	{
		include 'insertsupplier.php';
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Associated Products :: ADD SUPPLIER</title>
<script language="javascript" type="text/javascript" src="functions.js"></script>
<script language="javascript" type="text/javascript" src="suppliervalidate.js"></script>
<script language="javascript" type="text/javascript" src="ajax.js"></script>
<script language="javascript" type="text/javascript" src="ajax2.js"></script>
<link rel="stylesheet" type="text/css" href="styles1.css">
<style type="text/css">
<!--
.style2 {
	font-size: 24px;
	font-family: "Courier New", Courier, mono;
	font-weight: bold;
}
.style3 {color: #CCFFFF}
-->
</style></head>

<body onLoad="document.getElementById('id').focus();">
<div id="menu"><a href="addsupplier.php">Add Supplier</a> | 
<a href="purchaseorder.php">Prepare Purchase Order</a> | <a href="listpo.php">View All POs</a> | <a href="search.php">SEARCH</a> | 
Hello <a href="editprofile.php?uname=<?php echo $_SESSION['uname'];?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></a> | 
<a href="logout.php">LOGOUT</a></div>
<form onSubmit="return validate()" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <p>&nbsp;</p>
  <table width="472" height="200" border="1" align="center" cellpadding="0" cellspacing="5">
    <tr>
      <td colspan="2"><div align="center">ADD NEW SUPPLIER </div></td>
    </tr>
    <tr>
      <td width="144"><div align="right">Supplier ID : </div></td>
      <td width="312" align="left"><input name="id" type="text" id="id" tabindex="1" value="<?php echo $id;?>"></td>
    </tr>
    <tr>
      <td><div align="right">Supplier Name : </div></td>
      <td align="left"><input name="name" type="text" id="name" tabindex="2" size="40" maxlength="50" value="<?php echo $name;?>"></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input name="save" type="submit" id="save" value="S A V E">
      </div></td>
    </tr>
  </table>
  <DIV id="msg2" style="font-family:Verdana, Arial, Helvetica, sans-serif;color:red; font-size:12px ">
  <?php
  	if(sizeof($errors) > 0)
	{
		echo "<ul type=disc>";
		foreach($errors as $k => $v)
		{
			echo "<li>$v</li>";
		}
		echo "</ul>";
  	}
	
	if(isset($_GET['id']))
	{
		echo "Supplier <b>".$_GET['id']."</b> successfully added! ";
	}
  ?>
  </DIV>
<div id="supplierList" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:darkblue; font-weight:bold ">
<p>&nbsp;</p>
  <table width="688" height="102" border="1" cellspacing="0">
    <tr bgcolor="#9999CC">
      <td height="48" colspan="4"><div align="center" class="style2">LIST OF SUPPLIERS </div></td>
      </tr>
    <tr bgcolor="#000066">
      <td width="96"><div align="center" class="style3">ID</div></td>
      <td width="402"><div align="center" class="style3">NAME</div></td>
      <td width="81"><div align="center" class="style3">EDIT</div></td>
      <td width="81"><div align="center" class="style3">DELETE</div></td>
    </tr>
<?php 
	$getallsuppliers = mysql_query("SELECT sID, name FROM supplier ORDER BY sID ASC") or die('error in getallsuppliers query');
	if(mysql_num_rows($getallsuppliers)>0)
	{
		$e = 1;
		while(list($s,$n) = mysql_fetch_array($getallsuppliers))
		{
		echo "
    <tr bgcolor=#99ccff onmouseover=\"this.style.background='#99ff66'\" onmouseout=\"this.style.background='#99ccff'\">
     <td width=\"96\">
	 <div align=\"center\" id=su$e>$s</div>
	 <input type=hidden id=hid$e value=$s>
	 <input id=s$e value=$s size=10 style=\"display:none;text-align:center\"></td>
	 
      <td width=\"320\">
	  <div align=\"left\" style=\" padding-left:10px; font-weight:300\" id=na$e>$n</div>
	  
	  <input id=n$e value='$n' size=45 style=\"display:none; text-align:left\">
	  
	  </td>
      <td width=\"81\"><div align=\"center\">
	  <input id=edit$e type=button value=EDIT class=suppliers onClick=\"editSupplier($e)\"></div></td>
	  
      <td width=\"81\"><div align=\"center\">
	  
	  <input id=delete$e type=button value=DELETE class=suppliers></div></td>
    </tr>";
		$e++;
		}
	}
	else
	{
		echo "<h4>You have no suppliers in your list</h4>";
	}
?>	
  </table>
  <p>&nbsp;</p>

</div>
</form>
<p>&nbsp;</p>
</body>
</html>
