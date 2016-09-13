<?php
		$id = $_GET['id'];
		include 'config.php';
		$getPOnum = mysql_query("SELECT poNum,attention,date,supplierID, refNo,delivery, terms,prepared,totalAmount,transDescript FROM 
		po WHERE poNum = '$id'") or die('error in getPOnum query');
		
		if(mysql_num_rows($getPOnum) == 1)
		{
			list($poNum,$attn,$date, $sID,$refNo,$del,$terms,$prepared,$totalAmount,$transDescript) = mysql_fetch_array($getPOnum);
			$getSupp = mysql_query("SELECT * FROM supplier WHERE sID = '$sID'") or die('error in getSupp query');
			if(mysql_num_rows($getSupp) == 1)
			{
				list($supp,$supname) = mysql_fetch_array($getSupp);
			}
		}
		else
		{
			header('location:listpo.php');
		}
?>
