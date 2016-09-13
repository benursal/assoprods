<?php
//quotation
include 'config.php';
class QuotationList
{
	private $refNo = array(); // reference number
	private $itemList = '';
	private $total;
	private $x; // for javascript x variable
	private $y; //for javascript y variable
	private $url;
	private $type; // type of form the transNum belongs to.  Synonym of table name
	
	public function QuotationList($q)
	{
		
			//$this->refNo['readOnly'] = 'readonly';
			$this->refNo['value'] = $q;
			$this->x = 1;
			$this->y = 1;
			
			//query section //
			$getTotal = mysql_query("SELECT totalAmount FROM quotation WHERE transNum = '$q'") or 
			die('Error in getting total. Line 20 of quotationList.class.php');
			
			if(mysql_num_rows($getTotal) == 1)
			{
				list($t) = mysql_fetch_array($getTotal);
				
				$getItems = mysql_query("SELECT * FROM orderline WHERE type = 'quotation' AND num = '$q' 
				ORDER BY itemNo ASC") or 
				die('Error in getting items.. Line 28 of quotationList.class.php');
				
				if(mysql_num_rows($getItems) > 0)
				{
					$a = 0;
					while(list($type,$num, $itemNo,$qty,$unit,$desc,$sp, $up,$amount) = mysql_fetch_array($getItems))
					{
						$class = ($itemNo%2 == 0)?'items2':'items'; // set background color of each line of item
						
						$desc = str_replace('<br>', chr(13), $desc); 
						$this->itemList .= "
						<div id=\"item".$itemNo."\" class=$class>
						<div id=\"item_no_i".$itemNo."\" class=\"item_no_i\">".$itemNo."</div>
						<div id=\"quantity_i".$itemNo."\" class=\"quantity_i\">
						<input name=\"qty[]\" id=\"qty".$itemNo."\" size=\"3\" maxlength=\"5\" onKeyPress=\"return isNumberKey(event);\" 
						onKeyUp=\"calculate(event, this.id, 'up".$itemNo."', 'amount_i".$itemNo."', $itemNo)\" value=$qty>
						</div>   
						<div id=\"unit_measure_i".$itemNo."\" class=\"unit_measure_i\">
						<input name=\"unit[]\" id=\"unit".$itemNo."\" size=\"4\" maxlength=\"5\" value=$unit></div>
						<div id=\"description_i".$itemNo."\" class=\"description_i\">
						<textarea cols=\"34\" rows=\"3\" id=\"descript".$itemNo."\" name=\"descript[]\" wrap=\"hard\">$desc</textarea></div>
						<div id=\"supp_price_i".$itemNo."\" class=\"supp_price_i\">
						<input name=\"sp[]\" id=\"sp".$itemNo."\" size=\"12\" maxlength=\"20\" value=$sp>
						</div>
						<div id=\"unit_price_i".$itemNo."\" class=\"unit_price_i\"> 
						<input name=\"up[]\" id=\"up".$itemNo."\" size=\"12\" maxlength=\"20\" value=\"$up\" 
						onKeyUp=\"calculate(event, this.id, 'qty".$itemNo."', 'amount_i".$itemNo."', $itemNo, 8)\">
						</div>
						<div id=\"amount_i".$itemNo."\" class=\"amount_i\">P ".number_format($amount, 2)."</div>
						<div id=\"actions_i".$itemNo."\" class=\"actions_i\">
						<a href=\"#\" id=\"addItem".$itemNo."\" class=\"addItem\" onClick=\"addItem('q'); return false\">+</a> 
						<a href=\"#\" id=\"removeItem".$itemNo."\" onClick=\"remove(".$itemNo.",".$itemNo.", 8); return false\">-</a>
						<input type=\"hidden\" id=\"hid".$itemNo."\" name=\"hid[]\" value=\"".$itemNo."\">
						</div>
						<input type=\"text\" id=\"itemAmount".$itemNo."\" name=\"amount[]\" class=\"nkaTago\" 
						value=".$amount.">
					</div>
					";
					$a++;
					} // END OF WHILE LOOP BLOCK OF CODES
				$this->total = $t;
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