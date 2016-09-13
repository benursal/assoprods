<?php
if(isset($_GET['id']))
{	
		$i = $_GET['id'];
		$h = $i + 1;
	echo "	<div id=\"orders".$i."\" class=\"orders\">
 		 <div style=\"width:90px; \" id=\"itemno\"><input type=\"hidden\" size=\"7\" id=\"item".$i."\" name=\"item[]\" value=\"".$i."\">".$i."</div>
		 <div style=\" width:55px;\" id=\"qty\"><input type=\"text\" size=\"3\" id=\"qty".$i."\" name=\"qty[]\"></div>
		 <div style=\"width:53px; \" id=\"unit\"><input type=\"text\" size=\"4\" id=\"unit".$i."\" name=\"unit[]\"></div>
		 <div style=\"width:300px; \" id=\"descriptions\"><textarea rows=\"3\" cols=\"30\" id=\"descript".$i."\" name=\"descript[]\"></textarea></div>
		 <div style=\"width:101px; \" id=\"unitprice\">
		   <input type=\"text\" size=\"7\" id=\"up".$i."\" name=\"up[]\">
		 </div>
		 <div style=\"width:127px; float:left; font-size:16px\" id=\"lineamount".$i."\"></div><input type=\"hidden\" name=\"amount[]\" id=\"amount".$i."\">
		 <div style=\"width:75px; \">
		 <input type=\"button\" id=\"add".$i."\" value=\"Add Line\" style=\"font-size:10px;\" onClick=\"checkOrderline(".$i."); ipafocus('qty".$h."')\"> 
		 <input type=\"button\" id=\"remove".$i."\" value=\"Remove\" style=\"font-size:10px; display:none\" onClick=\"removeline(".$i.")\">
		 <input type=\"button\" name=\"update\" id=\"update".$i."\" value=\"Update\" style=\"font-size:10px; display:none\" onClick=\"edit(".$i.")\">
 		</div>";
}
		
?>