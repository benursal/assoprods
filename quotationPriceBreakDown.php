<?php
$grossPrice = $values[9];
			if($values[13] == '12')
			{
				$vat = $values[13]/100;
				$vatable = $grossPrice*$vat;
				$grossPrice += $vatable;
				$vatted = $grossPrice;
				
				$vatRow = "<tr><td>12% VAT </td><td>".number_format($vatable, 2)."</td></tr>
				<tr><td>&nbsp;</td><td style=\"border-top:1px solid white\">".number_format($vatted, 2)."</td></tr>";
			}
			
			if($values[14] != '' AND $values[14] != 0 AND $values[14] != NULL)
			{
				$discountRate = $values[14]/100;
				$discount = $grossPrice*$discountRate;
				$grossPrice -= $discount;
				$discounted = $grossPrice;
				
				$discRow = "<tr><td>less ".$values[14]."% disc </td><td>".number_format($discount, 2)."</td></tr>";
			}
			$netPrice = $grossPrice;
			
			echo "<table border=0 id=hehe>";
			
			if($values[9] != $netPrice)
			{
				echo "<tr><td>Gross Price </td><td>P ".number_format($values[9], 2)."</td></tr>";
			}
			
			echo $vatRow;
			
			echo $discRow;
			
			echo "<tr><td><b>Net Price (12% VAT ".ucfirst($values[12]).") </b></td>
			<td style=\"border-top:1px solid white\"><b><u>PHP ".number_format($netPrice, 2)."</u></b></td></tr>
			
			</table>";
?>