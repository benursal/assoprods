<?php

if(isset($_GET['table']) AND isset($_GET['id']))
{
	include 'config.php';
	$table = strtolower($_GET['table']);
	$id = strtolower($_GET['id']);
	
	if($table == 'po' || $table == 'quotation')
	{
		include 'deleteForm.php'; // for both po and quotation tables
		if($table == 'po')
		{
			$url = 'viewPOs.php';
		}
		elseif($table == 'quotation')
		{
			$url = 'viewQuotes.php';
		}
	}
	elseif($table == 'customer' || $table == 'supplier')
	{
		include 'deleteCompany.php'; // for both suppliers and customers
		if($table == 'customer')
		{
			$url = 'viewCustomers.php';
		}
		elseif($table == 'supplier')
		{
			$url = 'viewSuppliers.php';
		}	
	}
	deleteRecord($table, $id, $url);
}
else
{	
	echo "<h3>ERROR, MY FRIEND!!!</h3>";
}
?>