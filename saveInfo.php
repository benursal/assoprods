<?php
include 'config.php';

$type = $_GET['type'];
$name = strtolower(trim($_GET['name']));
$id = strtolower(trim($_GET['id']));
$address = ucfirst(trim($_GET['address']));

main($type, $id, $name, $address); // call main function

function validateThreeLiner($type, $id, $name, $address) // validate values inputted if TYPE is customer
{
	if($type == 'cust')
	{
		$label = 'Customer'; // variable for label. will be used to identify error
		$idQuery = "SELECT * FROM customer WHERE custID = '$id'";
		$nameQuery = "SELECT * FROM customer WHERE custName = '$name'";
	}
	elseif($type == 'supp')
	{
		$label = 'Supplier'; // variable for label. will be used to identify error
		$idQuery = "SELECT * FROM supplier WHERE sID = '$id'";
		$nameQuery = "SELECT * FROM supplier WHERE name = '$name'";
	}
	
	if(strlen($id) > 0)
	{
		if(strlen($name) > 0)
		{	
			if(strlen($address) > 0)
			{		
				$q = mysql_query($idQuery) or die('Error in looking for match in '.$label.' id');
				
				if(mysql_num_rows($q) == 1)
				{
					$c = $label.' ID, <b>'.$id.'</b>, not available';
				}
				else
				{
					$q = mysql_query($nameQuery) or die('Error in looking for match in '.$label.' name');
					
					if(mysql_num_rows($q) == 1)
					{
						$c = $label.' Name, <b>'.$name.'</b>, not available';
					}
					else
					{
						$c = 1;
					}
				}
			}
			else
			{	
				$c = 'Please Enter Address';
			}
		}
		else
		{
			$c = 'Please Enter '.$label.' Name';
		}
	}
	else
	{
		$c = 'Please Enter '.$label.' ID';
	}
	
	return $c;
} // end of function validateCust

function validateOneLiner($type, $name)
{
	if(strlen($name) > 0)
	{
		if($type == 'del')
		{
			$quer = "SELECT * FROM delivery WHERE delName = '$name'";
		}
		elseif($type == 'terms')
		{
			$quer = "SELECT * FROM terms WHERE termName = '$name'";
		}
		elseif($type == 'val')
		{		
			$quer = "SELECT * FROM validity WHERE valName = '$name'";
		} 
		elseif($type == 'qDesc')
		{
			$quer = "SELECT * FROM quotation WHERE transDescript = '$name'";
		}
		elseif($type == 'poDesc')
		{
			$quer = "SELECT * FROM po WHERE transDescript = '$name'";
		}
		
		$q = mysql_query($quer) or die('error looking for '.$type.' match');
		
		if(isset($_GET['match']))
		{
			$c = 2;
		}
		else
		{
			if(mysql_num_rows($q) == 1) // check if name is not yet taken
			{
				$c = 'Name, <b>'.$name.'</b>, Unavailable';
			}
			else
			{	
				if($type == 'poDesc' || $type == 'qDesc')
				{
					$c = 2;
				}
				else
				{
					$c = 1;
				}
			}
		}
	}
	else
	{
		$c = 'Please Enter Value For Name';
	}
	return $c;
	
} //  End of function validateOther


function main($type, $id, $name, $address)
{
	if($type == 'cust' || $type == 'supp') 
	{
		$s = validateThreeLiner($type, $id, $name, $address); /* unique for customer validation. the $s variable would HOLD the error msg returned by the 
		validateCust function */
	}
	else
	{
		$s = validateOneLiner($type, $name); /* for the other 3 dialog boxes. the $s variable would HOLD the error msg returned by the 
		validateOther function */
	}
		
	if($s == 1) // if the values given by the user are valid, execute this BLOCK of codes
	{
		if($type == 'cust')
		{
			$insString = "customer() VALUES('$id','$name', '$address')";
			$qString = "* FROM customer WHERE custID = '$id'";
		}
		elseif($type == 'supp')
		{
			$insString = "supplier() VALUES('$id','$name', '$address')";
			$qString = "* FROM supplier WHERE sID = '$id'";
		}
		elseif($type == 'terms')
		{
			$insString = "terms() VALUES('','$name')";
			$qString = "* FROM terms WHERE termName = '$name'";
		}
		elseif($type == 'val')
		{
			$insString = "validity() VALUES('','$name')";
			$qString = "* FROM validity WHERE valName = '$name'";
		}
		elseif($type == 'del')
		{
			$insString = "delivery() VALUES('','$name')";
			$qString = "* FROM delivery WHERE delName = '$name'";
		}
		else
		{
			echo 'No such type';
		}
			
		$insert = mysql_query("INSERT INTO ".$insString) or die('error inserting');
		if($insert)
		{	
			$query = mysql_query("SELECT ".$qString) or die('Query error at line 129 of SaveInfo.php');
			if(mysql_num_rows($query) == 1)
			{
				list($i, $n, $a) = mysql_fetch_array($query);
			}
			
			$state = '1,'.$i.','.$n.", ".$a;
		}
		else // if error is in inserting values, assign 0 to $state variable
		{
			$state = 0;
		}
	}
	elseif($s == 2) // only for transaction description dialog box
	{
		$state = '2,tae,mo';
	}
	else // if values given by the user are INVALID, assign whatever error msg was returned by the VALIDATION function used
	{
		$state = $s;
	}
		
	echo $state; // output
}
	
?>