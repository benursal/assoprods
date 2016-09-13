<?php
include 'config.php';
if(isset($_POST['Submit']))
{
	$code = md5($_POST['code']);
	
	$insert = mysql_query("INSERT INTO confirmcode() VALUES('$code')") or die('error in insert query');
	if($insert)
	{
		header('location : secretcode.php');
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<title>Untitled Document</title>
</head>

<body>
<form name="form1" method="post" action="secretcode.php">
  <input name="code" type="text" id="code" size="20" maxlength="20">
  <input type="submit" name="Submit" value="Submit">
</form>
</body>
</html>
