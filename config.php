<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'assoprods';


	mysql_connect($host,$user,$pass) or die('cannot connect to database server');
	mysql_select_db($db) or die('connection to database unsuccessful');
?>