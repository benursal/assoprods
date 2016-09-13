<?php
include 'logcheck.php';
$errors = array();
if(isset($_POST['save']))
{
	include 'config.php';
	$getProfile = mysql_query;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>ASSOCIATED PRODUCTS :: EDIT ADMIN PROFILE</title>
<link rel="stylesheet" type="text/css" href="styles1.css">
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style2 {color: #FFFFFF}
.style4 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<script language="javascript" type="text/javascript" src="functions.js"></script>
<script language="javascript" type="text/javascript" src="adminscript.js"></script>
</head>

<body>
<div id="menu"><a href="addsupplier.php">Add Supplier</a> | 
<a href="purchaseorder.php">Prepare Purchase Order</a> | <a href="listpo.php">View All POs</a> | <a href="search.php">SEARCH</a> | 
Hello <a href="editprofile.php?uname=<?php echo $_SESSION['uname'];?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></a> | 
<a href="logout.php">LOGOUT</a></div>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onSubmit="return validate()">
  <table width="545" height="218" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#333333">
    <tr bgcolor="#666666">
      <td height="45" colspan="2"><div align="center">
        <p class="style1 style2">EDIT PROFILE</p>
      </div></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td width="175" height="30"><div align="right" class="style4">Username : </div></td>
      <td width="367" align="left"><font face="Verdana, Arial, Helvetica, sans-serif"><?php echo $_SESSION['uname'];?></font>
	  <input name="username" value="<?php echo $_SESSION['uname'];?>" style="display:none"></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td height="30"><div align="right" class="style4">Name : </div></td>
      <td align="left"><input name="fname" type="text" id="fname" size="25" style="color:black;" value="<?php echo $_SESSION['fname'];?>"
	  onFocus="checkname(this.value, 'First Name',this.id);" onBlur="backtodflt(this.value,'First Name',this.id);">
      <input name="lname" type="text" id="lname" style="color:black;" value="<?php echo $_SESSION['lname'];?>" 
	  onFocus="checkname(this.value, 'Last Name',this.id);" onBlur="backtodflt(this.value,'Last Name',this.id);"></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td height="30"><div align="right" class="style4">Password : </div></td>
      <td align="left"><input name="pass" type="password" id="pass" size="25"></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td height="33"><div align="right" class="style4">Re-Type Password : </div></td>
      <td align="left"><input name="pass2" type="password" id="pass2" size="25"></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td height="33"><div align="right"></div></td>
      <td height="50"><div align="center">
        <input name="update" type="submit" id="update" value="UPDATE">
        <input type="reset" name="Reset" value="CANCEL">
      </div></td>
    </tr>
  </table>
  <div id="msg2">
  
  <?php
  /*	echo "<ul>";
  	if(sizeof($errors)>0)
	{
		foreach($errors as $k => $v)
		{
			echo "<li>$v</li>";
		}
	}
  	echo "</ul>";*/
  ?>
  </div>
</form>
</body>
</html>
