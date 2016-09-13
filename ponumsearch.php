<?php
echo "
			 <tr onmouseover=\"this.style.background = 'skyblue'\" onmouseout=\"this.style.background = 'transparent'\">
	  	 <td width=\"109\"><div align=\"center\"><strong><a href=viewPO.php?id=$poNum>$poNum</a></strong></div></td>
        <td width=\"300\"><div align=\"left\"><strong>$desc</strong></div></td>
		<td width=\"117\"><div align=\"center\"><strong>$supplierID</strong></div></td>
		<td width=\"138\"><div align=\"center\">$numofitems item(s)</div></td>
        <td width=\"86\"><div align=\"center\"><strong><a href=editpurchaseorder.php?id=$poNum>[EDIT]</a></strong></div></td>
        <td width=\"85\"><div align=\"center\"><strong>
		<a href='#' onClick=\"confirmDel('$poNum')\">[DELETE]</a></strong></div></td>
	  </tr>";

?>