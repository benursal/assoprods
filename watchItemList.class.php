<?php
//watch item list

class watchItemList
{
	private $tableName;
	private $transNum;
	
	public function watchItemList($table, $num)
	{
		$this->tableName = $table;
		$this->transNum = $num;
	}
	
	public function showItemList()
	{
		$query = mysql_query("SELECT * FROM orderline WHERE type = '".$this->tableName."' AND num = '".$this->transNum."' 
		ORDER BY itemNo ASC") or 
		die("query error in line 18 of watchItemList.class.php");
		
		if(mysql_num_rows($query) > 0)
		{
			while(list($type,$no,$iNo,$qty,$unit,$descript,$sp,$unitPrice,$amount)= mysql_fetch_array($query))
			{
				//$descript = str_replace(CHR(13), "<br>", $descript);
				$class = ($iNo%2 == 0) ? 'items2' : 'items';
				echo "
				<div id=\"item1\" class=$class>
						<div id=\"item_no_i1\" class=\"item_no_i\">$iNo</div>
						<div id=\"quantity_i1\" class=\"quantity_i\">$qty</div>   
						<div id=\"unit_measure_i1\" class=\"unit_measure_i\">$unit</div>
						<div id=\"description_i1\" class=\"description_i\" style=\"text-align:left; padding-left:10px;\">
							$descript
						</div>";
						if($this->tableName == 'quotation')
						{
							echo "<div id=\"supp_price_i1\" class=\"supp_price_i\">P ".number_format($sp,2)."</div>";
						}
						echo "
						<div id=\"unit_price_i1\" class=\"unit_price_i\">P ".number_format($unitPrice,2)."</div>
						<div id=\"amount_i1\" class=\"amount_i\">P ".number_format($amount,2)."</div>
				</div>";
			}
		}
		else
		{
			echo "No ".strtoupper($this->tableName)." Number <u>".$this->transNum."</u> Recorded.";
		}
	}

}
?>