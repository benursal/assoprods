<?php
//logcheck
session_start();
if($_SESSION['logged'] == true)
{
	
	include 'config.php';
	$getuser = mysql_query("SELECT fname, lname FROM preparer WHERE username = '".$_SESSION['uname']."'") or die('error in getuser query');
	list($_SESSION['fname'],$_SESSION['lname']) = mysql_fetch_array($getuser);
	$_SESSION['name'] = ucfirst($_SESSION['fname'])." ".ucfirst($_SESSION['lname']);
}
else
{
	header('location: login.php');
}
?>