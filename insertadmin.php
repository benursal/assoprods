<?php
//insert admin
$pass = md5($pass);
$insertadmin = mysql_query("INSERT INTO preparer() VALUES('$fname','$lname','$uname','$pass')") or die('error in insertadmin query');
if($insertadmin)
{
	session_start();
	$_SESSION['logged'] = true;
	$_SESSION['uname'] = $uname;
	header('location: purchaseorder.php');
}
?>