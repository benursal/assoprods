<?php

class updateCompany
{
	private $id;
	private $name;
	private $address;
	private $tableName;
	private $msg;
	private $status = 'bad';
	
	public function updateCompany($i,$oi, $n, $on, $add, $table)
	{
		switch($table)
		{
			case 'customer':
				$qString1 = "SELECT * FROM $table WHERE custID = '$i'";
				$qString2 = "SELECT * FROM $table WHERE custName = '$n'";
				$updateString = "SET custID = '$i', custName = '$n', address = '$a' WHERE custID = '$oi'";
			break;
			case 'supplier':
				$qString1 = "SELECT * FROM $table WHERE sID = '$i'";
				$qString2 = "SELECT * FROM $table WHERE name = '$n'";
				$updateString = "";
		}
		
		if(strlen($i) == 0)
		{
			$this->msg = "Please Enter ".strtoupper($table)." ID";
		}
		else
		{
			if(strlen($n) == 0)
			{
				$this->msg = "Please Enter ".strtoupper($table)." Name";
			}
			else
			{
				if(strlen($add) == 0)
				{
					$this->msg = "Please Enter ".strtoupper($table)." Address";
				}
				else
				{
					if(strtolower($i) != strtolower($oi))
					{					
						$query1 = mysql_query($qString1) or die('error line 35 of updateCompany.php');
						if(mysql_num_rows($query1) == 1)
						{
							$this->msg = strtoupper($table)." ID, <b>$i</b>, is not available";
						}
						else
						{
							if(strtolower($n) != strtolower($on))
							{
								$query2 = mysql_query($qString2) or die('error line 42 of updateCompany.php');
								if(mysql_num_rows($query2) == 1)
								{
									$this->msg = strtoupper($table)." Name, <b>$n</b>, is not available";
								}
								else
								{
									$insert = mysql_query("UPDATE $table ".$updateString) 
									or die('error in line 47 of addCompany.php');
									if($insert)
									{
										$this->msg = strtoupper($table)." ID <b>$i</b> Successfully Added!";
										$this->status = 'good';
									}
								} // END OF if(mysql_num_rows($qString2) == 1)
							} // END OF ELSE BLOCK OF if(mysql_num_rows($qString1) == 1)
						}
					}
					else
					{
						if(strtolower($n) != strtolower($on))
						{
							$query2 = mysql_query($qString2) or die('error line 42 of updateCompany.php');
							if(mysql_num_rows($query2) == 1)
							{
								$this->msg = strtoupper($table)." Name, <b>$n</b>, is not available";
							}
							else
							{
								$insert = mysql_query("UPDATE $table ".$updateString)
								or die('error in line 47 of addCompany.php');
								if($insert)
								{
									$this->msg = strtoupper($table)." ID <b>$i</b> Successfully Added!";
									$this->status = 'good';
								}
							} // END OF if(mysql_num_rows($qString2) == 1)
						} // END OF ELSE BLOCK OF if(mysql_num_rows($qString1) == 1)
						else
						{
							$insert = mysql_query("UPDATE $table ".$updateString)
							or die('error in line 47 of addCompany.php');
							if($insert)
							{
								$this->msg = strtoupper($table)." ID <b>$i</b> Successfully Added!";
								$this->status = 'good';
							}
						}
					}
				}// END OF ELSE BLOCK OF if(strlen($add) == 0)
			} // END OF ELSE BLOCK OF if(strlen($n) == 0)
		} // END OF ELSE BLOCK OF IF(strlen($i) == 0)
	}// END OF constructor method definition

	public function showMessage()
	{
		return $this->msg;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
}

?>