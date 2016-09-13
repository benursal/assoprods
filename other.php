<?php 
		$getOrderline = mysql_query("SELECT itemNo,qty,unit,descript,unitPrice,amount FROM orderline WHERE poNum = '$id' ORDER BY
		itemNo ASC") or die('error in getOrderline query');
		
	if(mysql_num_rows($getOrderline)>0)
	{
		while(list($i,$qty,$unit,$desc,$up,$amount) = mysql_fetch_array($getOrderline))
		{
	?>

<div id="orders<?php echo $i;?>" class="orders">
 		 <div style="width:90px; " id="itemno"><?php echo $i;?>
		 <input type="hidden" size="7" id="item<?php echo $i;?>" name="item[]" value="<?php echo $i;?>"></div>
		 
		 <div style=" width:55px;" id="qty"><input type="text" size="3" id="qty<?php echo $i;?>" name="qty[]" 
		 value="<?php echo $qty;?>"></div>
		 <div style="width:53px; " id="unit">
		 <input type="text" size="4" id="unit<?php echo $i;?>" name="unit[]" value="<?php echo $unit;?>"></div>
		 <div style="width:300px; " id="descriptions"><textarea rows="3" cols="30" id="descript<?php echo $i;?>" 
		 name="descript[]"><?php echo $desc;?></textarea></div>
		 <div style="width:101px; " id="unitprice">
		   <input type="text" size="7" id="up<?php echo $i;?>" name="up[]" value="<?php echo $up;?>">
		 </div>
		 <div style="width:127px; float:left; font-size:16px" id="lineamount<?php echo $i;?>">P <?php echo $amount;?></div>
		 <input type="hidden" name="amount[]" id="amount<?php echo $i;?>" value="<?php echo $amount;?>">
		 <div style="width:75px; "><input type="button" id="add<?php echo $i;?>" value="Add Line" style="font-size:10px;display:none" 
		 onClick="checkOrderline(<?php echo $i;?>)"> 
		 <input type="button" name="remove<?php echo i;?>" id="remove<?php echo $i;?>" value="Remove" 
		 style="font-size:10px; display:block" onClick="removeline(<?php echo $i;?>)">
		 <input type="button" name="update<?php echo $i;?>" id="update<?php echo $i;?>" value="Update" 
		 style="font-size:10px; display:block" onClick="testing(<?php echo $i;?>)">
 		</div>
	
<?php
		}
	}
		?>