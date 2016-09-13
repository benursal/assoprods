<?php
// FOR AJAX AUTOCOMPLETE  .. GET CUSTOMER ID
$type = $_GET['type']; 
if(isset($_GET['id'])) // check if there is value for id parameter
{
	include 'config.php'; // include 'configuration file
	$id = $_GET['id']; //  assign to variable $id parameter id
	if($type == 'cust')
	{
		$query = "SELECT custName, address FROM customer WHERE custID = '$id'";
	}
	elseif($type == 'supp')
	{
		$query = "SELECT name, address FROM supplier WHERE sID = '$id'";
	}
	
	$getNameQuery = mysql_query($query) or die('Error in getting '.$type.' name and address.');
	
	if(mysql_num_rows($getNameQuery) == 1)
	{
		list($name, $address) = mysql_fetch_array($getNameQuery);
		echo $name."%".$address; // separated by a percent sign '%'
	}
}

?>