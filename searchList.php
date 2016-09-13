<?php
/* Created By : Edward Benedict Ursal
 * Date : July 16, 2009
 * Filename : searchList.class.php
 * Description : 
 *
*/

class searchList
{
	private $limit; // the limit for the query
	private $queryString;
	private $recordList; //  list of records
	private $numberOfRecords;
	private $tableName;
	
	public function mainFormList($table, $start = NULL, $numRecs = NULL) // $lim Stands for limit 
	{
		if($start == NULL)
		{
			$this->limit = '';
		} 
		else
		{
			$this->limit = " LIMIT ".(($start-1)*$numRecs).",".$numRecs; 
		}
		$this->tableName = $table;
		$this->queryString = "SELECT transNum, date, transDescript FROM ".$table.$this->limit;
		
		//--- GET THE NUMBER OF RECORDS ----
		$query = mysql_query("SELECT * FROM ".$table) or die("error in getting number of records");
		$this->numberOfRecords = mysql_num_rows($query);
	}
	
	public function displayRecords($search = NULL)
	{
		$query = mysql_query($this->queryString) or die('Error in getting query');
		if(mysql_num_rows($query) > 0)
		{
			if($this->tableName == 'quotation')
			{
				$xtraTh = "<th>CREATE PO</th>";
			}
			
			$x = 0;
			
			echo "<table border=0 cellpaddnig=10 cellspacing=2>";
			echo "<tr><th>".strtoupper($this->tableName)." NO.</th><th>DESCRIPTION</th><th>DATE ISSUED</th>";
			echo "<th>No. Of Items</th>$xtraTh<th>EDIT</th><th>DELETE</th></tr>";
			while(list($num, $date, $transDesc) = mysql_fetch_array($query))
			{
				$getNumItems= mysql_query("SELECT * FROM orderline WHERE type= '".$this->tableName."' AND num='$num'") or die
				("error in line 45 of  mainForList.class.php");
			
				$numOfItems=mysql_num_rows($getNumItems);
			
				$color = ($x%2 == 0) ? 'white' : '#FFFF66';
				if($this->tableName == 'quotation')
				{
					$xtraTd = "<td><a href=po.php?q=$num>Create PO</a></td>";
				}
				echo "<tr bgcolor=$color><td width=130><a href=watch".$this->tableName.".php?num=$num>$num</a></td>";
				echo "<td width=220 align=left>$transDesc</td><td>$date</td>";
				echo "<td>$numOfItems</td>$xtraTd<td><a href=edit".strtoupper($this->tableName).".php?num=$num>[EDIT]</a></td>
				<td><a href=# onclick=\"deleteItem('".ucwords($this->tableName)."','$num');return false;\">[DELETE]</a></td></tr>";
				$x++;
			}
			echo "</table>";
		}
		else
		{
			if($search !=true)
			{
				echo 	"<h1>No ".strtoupper($this->tableName)." Recorded Yet</h1>";
			}
		}	
	}
	
	public function getNumOfRecs()
	{
		return $this->numberOfRecords;
	}
}

?>