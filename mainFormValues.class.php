<?php

class mainFormValues
{
	private $watchValues; // for viewing.. Not for editing
	private $editValues; // for editing
	private $tableName;
	private $transNum;
	
	public function mainFormValues($t, $n)
	{
		$this->tableName = $t;
		$this->transNum = $n;
	//----------------------------------------------
		$query = mysql_query("SELECT * FROM ".$this->tableName." WHERE transNum = '".$this->transNum."'") or 
		die("error line 16 mainFormValues.class.php");
		if(mysql_num_rows($query) == 1)
		{
			if($this->tableName == 'quotation')
			{
				list($num,$year,$date,$id,$subj,$delivery,$validity,$terms, $attn, $desc, $total, $prepared) = mysql_fetch_array($query);
				$queryForCust = mysql_query("SELECT custName, address FROM customer WHERE custID = '$id'") or 
				die('error in get customer name query');
				
				if(mysql_num_rows($queryForCust) == 1)
				{
					list($custName, $address) = mysql_fetch_array($queryForCust);
				}
				
				$queryForDisc = mysql_query("SELECT inclusion, vat, rate FROM discounts WHERE transNum = '".$this->transNum."'") or 
				die('error in line 30 of mainFormValues.class.php'); 
				
				if(mysql_num_rows($queryForDisc) == 1)
				{
					list($inc, $vat, $rate) = mysql_fetch_array($queryForDisc);
				}
				
				$queryForTerms = mysql_query("SELECT termName FROM terms WHERE termNum = '$terms'") or 
				die('error in get terms name query');
				
				if(mysql_num_rows($queryForTerms) == 1)
				{
					list($termName) = mysql_fetch_array($queryForTerms);
				}
				
				$queryForDel = mysql_query("SELECT delName FROM delivery WHERE delNum = '$delivery'") or 
				die('error in get delivery name query');
				
				if(mysql_num_rows($queryForDel) == 1)
				{
					list($delName) = mysql_fetch_array($queryForDel);
				}
				
				$queryForValid = mysql_query("SELECT valName FROM validity WHERE valNum = '$validity'") or 
				die('error in get validity name query');
				
				if(mysql_num_rows($queryForDel) == 1)
				{
					list($valName) = mysql_fetch_array($queryForValid);
				}
				
				$this->editValues = array($id,$custName, $attn, $subj,$date,$num,$terms,$delivery, $validity, $total, $desc, $address,
				$inc, $vat, $rate);
				$this->watchValues = array($id,$custName, $attn, $subj,$date,$num,$termName,$delName, $valName, $total, $desc, $address,
				$inc, $vat, $rate, $prepared);
				
			}// END FOR IF($THIS->TABLENAME == 'QUOTATION')
			elseif($this->tableName == 'po')
			{
				list($num,$year,$date,$refNo,$id,$delivery,$terms,$attn,$desc,$total, $prepared, $qTotal) = mysql_fetch_array($query);
				
				$queryForSupp = mysql_query("SELECT name, address FROM supplier WHERE sID = '$id'") or 
				die('error in get supplier name query');
				
				if(mysql_num_rows($queryForSupp) == 1)
				{
					list($suppName, $addr) = mysql_fetch_array($queryForSupp);
				}
				
				$queryForTerms = mysql_query("SELECT termName FROM terms WHERE termNum = '$terms'") or 
				die('error in get terms name query');
				
				if(mysql_num_rows($queryForTerms) == 1)
				{
					list($termName) = mysql_fetch_array($queryForTerms);
				}
				
				$queryForDel = mysql_query("SELECT delName FROM delivery WHERE delNum = '$delivery'") or 
				die('error in get delivery name query');
				
				if(mysql_num_rows($queryForDel) == 1)
				{
					list($delName) = mysql_fetch_array($queryForDel);
				}
				$this->editValues = array($id,$suppName,$attn,$refNo,$date,$num, $terms,$delivery, $total, $desc, $addr);
				$this->watchValues = array($id,$suppName,$attn,$refNo,$date,$num, $termName,$delName, $total, $desc, $addr, $prepared,
				$qTotal);
			}// END FOR IF($THIS->TABLENAME == 'PO')
		}
		else
		{
			$this->editValues = 'No such '.strtoupper($this->tableName);
			$this->watchValues = 'No such '.strtoupper($this->tableName);
		}
	}// end of CONSTRUCTOR
	
	public function getWatchValues()
	{
		return $this->watchValues;
	}
	
	public function getEditValues()
	{
		return $this->editValues;
	}
}
?>