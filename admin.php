<?php
$errors = array();
if(isset($_POST['save']))
{
	include 'config.php';
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['username'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass'];
	$confirm = md5($_POST['confirm']);
	
	$getpreparer = mysql_query("SELECT username FROM preparer WHERE username = '$uname'") or die('error in getpreparer query');
	if(mysql_num_rows($getpreparer) == 1)
	{
		$errors[] = 'Username <b>'.$uname.'</b> is already taken!  Please enter another.';
		$uname = '';
	}
	
	$getconfirm = mysql_query("SELECT code FROM confirmcode WHERE code = '$confirm'") or die('error in getconfirm query');
	if(mysql_num_rows($getconfirm) == 0)
	{
		$errors[] = 'SECRET CODE incorrect!';
		$confirm ='';
	}
	
	if(sizeof($errors) == 0)
	{
		include 'insertadmin.php';
	}
}
else
{
	$fname = 'First Name';
	$lname = 'Last Name';
	$uname = '';
	$pass = '';
	$confirm = '';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ASSOCIATED PRODUCTS :: ADMIN REG</title>
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
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onSubmit="return validate()">
  <table width="545" height="290" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#333333">
    <tr bgcolor="#666666">
      <td height="45" colspan="2"><div align="center">
        <p class="style1 style2">ADMIN REGISTRATION</p>
      </div></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td width="175" height="30"><div align="right" class="style4">Name : </div></td>
      <td width="367"><input name="fname" type="text" id="fname" size="25" style="color:#999999;" value="<?php echo $fname;?>"
	  onFocus="checkname(this.value, 'First Name',this.id);" onBlur="backtodflt(this.value,'First Name',this.id);">
      <input name="lname" type="text" id="lname" style="color:#999999;" value="<?php echo $lname;?>" 
	  onFocus="checkname(this.value, 'Last Name',this.id);" onBlur="backtodflt(this.value,'Last Name',this.id);"></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td height="30"><div align="right" class="style4">Username : </div></td>
      <td><input name="username" type="text" id="username" value="<?php echo $uname;?>" size="25" maxlength="20"></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td height="30"><div align="right" class="style4">Password : </div></td>
      <td><input name="pass" type="password" id="pass" value="<?php echo $pass;?>" size="25"></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td height="33"><div align="right" class="style4">Re-Type Password : </div></td>
      <td><input name="pass2" type="password" id="pass2" value="<?php echo $pass2;?>" size="25"></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td height="33"><div align="right" class="style4">Secret Code : </div></td>
      <td><input name="confirm" type="password" id="confirm" size="25"></td>
    </tr>
    <tr bgcolor="#99CCFF">
      <td height="33"><div align="right"></div></td>
      <td height="50"><div align="center">
        <input name="save" type="submit" id="save" value="SAVE">
        <input name="cancel" type="button" id="cancel" value="CANCEL" onClick="document.location = 'index.php'">
      </div></td>
    </tr>
  </table>
  <div id="msg">
  
  <?php
  	echo "<ul>";
  	if(sizeof($errors)>0)
	{
		foreach($errors as $k => $v)
		{
			echo "<li>$v</li>";
		}
	}
  	echo "</ul>";
  ?>
  </div>
</form>
</body>
</html>
