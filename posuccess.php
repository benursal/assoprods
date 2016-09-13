<?php
if(isset($_GET['id']))
{
	echo "<h3>PO Number <font color=green>".$_GET['id']."</font> successfully saved</h3>";
}
else
{
	header('location: purchaseorder.php');
}
?>
<br>
<a href="purchaseorder.php">Create Another Purchase Order</a>