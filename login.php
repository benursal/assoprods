<?php	//FUNCTION INCLUSIONS
	include 'config.php'; // connect to mysql, database, and table
	include 'functions.php'; //
	
if($_POST['log'])
{
	$username = $_POST['username'];
	$pass = md5($_POST['pass']);
	
	$userQuery = mysql_query("SELECT * FROM preparer WHERE username = '$username'") or die('error!!!');
	if(mysql_num_rows($userQuery) == 1)
	{
		session_start();
		$_SESSION['logged'] = true;
		$_SESSION['uname'] = $username;
		header("location: logging.php");
	}
	else
	{
		$error = 'Invalid Username or Password!';
	}
}
	
 //-----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>APP :: Log-In</title>
<style>
.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
</style>
<link rel="stylesheet" type="text/css" href="styles/newStyle.css">
<link rel="stylesheet" type="text/css" href="styles/loginStyle.css">

<script language="javascript" type="text/javascript" src="js/createXmlHttp.js"></script>
<script language="javascript" type="text/javascript" src="js/addDialogEvents.js"></script>

</head>

<body onLoad="document.getElementById('username').focus()">

<div id="msg"><?php echo $error;?></div>
<div id="wrapper">
	<div id="header">
		<div id="logo">logo</div>
		<div id="banner">
		  
	  </div>
	</div>
	
	<div id="content" style="height:430px; ">
		<div id="title">
		  <h3>&nbsp;</h3>
		</div>
	  <div id="login">
			<h2>User Login</h2>
			<form name="loginForm" method="post">
		    <table width="296" border="1" cellpadding="5">
              <tr>
                <td><div align="right">Username : </div></td>
                <td><div align="center">
                  <input name="username" type="text" id="username" size="30">
                </div></td>
              </tr>
              <tr style="display:none ">
                <td><div align="right">Password : </div></td>
                <td><div align="center">
                  <input name="pass" type="password" id="pass" size="30">
                </div></td>
              </tr>
              <tr>
                <td><div align="right"></div></td>
                <td><div align="right">
                  <input name="log" type="submit" id="log" value="Sign-In">
                </div></td>
              </tr>
            </table>
			</form>
	  </div>
  </div>
	<div id="footer">
	<input type="hidden" id="transDesc" name="poDesc" value="">
		created by edward benedict ursal
	</div>
</div>
</body>
</html>
