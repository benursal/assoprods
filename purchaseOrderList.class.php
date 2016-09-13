<?php
//purchase order 
include 'config.php';
class purchaseOrderList
{
	private $refNo = array(); // reference number
	private $itemList = '';
	private $total;
	private $x; // for javascript x variable
	private $y; //for javascript y variable
	private $url;
	private $type; // type of form the transNum belongs to.  Synonym of table name
	
	public function purchaseOrderList($table, $q = NULL)
	{
		$this->type = $table; // set value of table name
		if($q == NULL)
		{
			//$this->refNo['readOnly'] = '';
			$this->refNo['value'] = '';
			$this->total = '0.00';
			$this->x = 1;
			$this->y = 1;
			$this->url = 'po.php';
			
			$this->itemList = "
			<div id=\"item1\" class=\"items\">
						<div id=\"item_no_i1\" class=\"item_no_i\">1</div>
						<div id=\"quantity_i1\" class=\"quantity_i\">
						<input name=\"qty[]\" id=\"qty1\" size=\"3\" maxlength=\"5\" onKeyPress=\"return isNumberKey(event);\" 
						onKeyUp=\"calculate(event, this.id, 'up1', 'amount_i1', 1, 7)\">
						</div>   
						<div id=\"unit_measure_i1\" class=\"unit_measure_i\">
						<input name=\"unit[]\" id=\"unit1\" size=\"4\" maxlength=\"5\"></div>
						<div id=\"description_i1\" class=\"description_i\">
						<textarea cols=\"37\" rows=\"3\" id=\"descript1\" name=\"descript[]\" wrap=\"hard\"></textarea></div>
						<div id=\"unit_price_i1\" class=\"unit_price_i\"> 
						<input name=\"up[]\" id=\"up1\" size=\"15\" maxlength=\"20\" 
						onKeyUp=\"calculate(event, this.id, 'qty1', 'amount_i1', 1, 7)\">
						</div>
						<div id=\"amount_i1\" class=\"amount_i\">P 0.00</div>
						<div id=\"actions_i1\" class=\"actions_i\">
						<a href=\"#\" id=\"addItem1\" class=\"addItem\" onClick=\"addItem('p'); return false\">+</a> 
						<a href=\"#\" id=\"removeItem1\" onClick=\"remove(1,1, 7); return false\">-</a>
						<input type=\"hidden\" id=\"hid1\" name=\"hid[]\" value=\"1\">
						</div>
						<input type=\"text\" id=\"itemAmount1\" name=\"amount[]\" value=\"0\" class=\"nkaTago\">
					</div>
			";
		} // END OF IF BLOCK..  OF  ($q ==  NULL)
		else
		{
			if($table == 'q')
			{
				$param = 'q';
			}
			elseif($table == 'po')
			{
				$param = 'p' ;
			}
			//$this->refNo['readOnly'] = 'readonly';
			$this->refNo['value'] = $q;
			
			//query section //
			$getTotal = mysql_query("SELECT totalAmount FROM ".$this->type." WHERE transNum = '$q'") or 
			die('Error in getting total. Line 52 of purchaseOrderList.class.php');
			
			if(mysql_num_rows($getTotal) == 1)
			{
				list($t) = mysql_fetch_array($getTotal);
				
				$getItems = mysql_query("SELECT * FROM orderline WHERE type = '".$this->type."' AND num = '$q' 
				ORDER BY itemNo ASC") or 
				die('Error in getting items.. Line 66 of purchaseOrderList.class.php');
				
				if(mysql_num_rows($getItems) > 0)
				{
					$a = 0;
					while(list($type,$num, $itemNo,$qty,$unit,$desc, $sp, $up,$am) = mysql_fetch_array($getItems))
					{
						$class = ($itemNo%2 == 0)?'items2':'items'; // set background color of each line of item
						
						if($this->type == 'quotation')
						{
							$amount = $sp * $qty;
							$p = $sp;
							$this->total += $amount;
						}
						elseif($this->type == 'po')
						{
							$amount = $am;
							$p = $up;
							$this->total = $t;
						}
						
						$desc = str_replace('<br>', chr(13), $desc); 
						//$desc = str_replace(CHR(13), "<br>", $desc);
						$this->itemList .= "
						<div id=\"item".$itemNo."\" class=$class>
						<div id=\"item_no_i".$itemNo."\" class=\"item_no_i\">".$itemNo."</div>
						<div id=\"quantity_i".$itemNo."\" class=\"quantity_i\">
						<input name=\"qty[]\" id=\"qty".$itemNo."\" size=\"3\" maxlength=\"5\" onKeyPress=\"return isNumberKey(event);\" 
						onKeyUp=\"calculate(event, this.id, 'up".$itemNo."', 'amount_i".$itemNo."', $itemNo, 7)\" value=$qty>
						</div>   
						<div id=\"unit_measure_i".$itemNo."\" class=\"unit_measure_i\">
						<input name=\"unit[]\" id=\"unit".$itemNo."\" size=\"4\" maxlength=\"5\" value='$unit'></div>
						<div id=\"description_i".$itemNo."\" class=\"description_i\">
						<textarea cols=\"37\" rows=\"3\" id=\"descript".$itemNo."\" name=\"descript[]\" wrap=\"hard\">$desc</textarea></div>
						<div id=\"unit_price_i1\" class=\"unit_price_i\"> 
						<input name=\"up[]\" id=\"up".$itemNo."\" size=\"15\" maxlength=\"20\" value='$p' 
						onKeyUp=\"calculate(event, this.id, 'qty".$itemNo."', 'amount_i".$itemNo."', $itemNo, 7)\">
						</div>
						<div id=\"amount_i".$itemNo."\" class=\"amount_i\">P ".number_format($amount, 2)."</div>
						<div id=\"actions_i".$itemNo."\" class=\"actions_i\">
						<a href=\"#\" id=\"addItem".$itemNo."\" class=\"addItem\" onClick=\"addItem('p'); return false\">+</a> 
						<a href=\"#\" id=\"removeItem".$itemNo."\" onClick=\"remove(".$itemNo.",".$itemNo.", 7); return false\">-</a>
						<input type=\"hidden\" id=\"hid".$itemNo."\" name=\"hid[]\" value=\"".$itemNo."\">
						</div>
						<input type=\"text\" id=\"itemAmount".$itemNo."\" name=\"amount[]\" class=\"nkaTago\" 
						value=".$amount.">
					</div>
					";
					$a++;
					} // END OF WHILE LOOP BLOCK OF CODES
				
				$this->x = $a;
				$this->y = $a;
				$this->url = 'po.php?q='.$q;
				
				} // END OF IF BLOCK.. OF  (mysql_num_rows($getItems) > 0)
				else
				{
					echo "<script>document.location = 'po.php';</script>";
				}
			} //  END OF IF BLOCK ... OF  (mysql_num_rows($getTotal) == 1)
			else
			{
				echo "<script>document.location = 'po.php';</script>";
			} // END OF ELSE BLOCK.. OF (mysql_num_rows($getTotal) == 1)
		} // END OF ELSE BLOCK ... OF  ($q == NULL)
	}// END OF CONSTRUCTOR METHOD
	
	public function getTotal()
	{
		return $this->total;
	}
	/*
	public function getRefNoReadOnly()
	{
		return $this->refNo['readOnly'];
	}*/
	
	public function getRefNoValue()
	{
		return $this->refNo['value'];
	}
	
	public function getItemList()
	{
		return $this->itemList;
	}
	
	public function getXandY()
	{
		$vars = "var x = parseInt(".$this->x.");";
		$vars .="var y = parseInt(".$this->y.");";
		
		return $vars;
	} 
	
	public function getUrl()
	{
		return $this->url;
	}
}
?>