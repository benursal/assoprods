<?php //dropdown menu html structure
;?>
<ul id="sddm">
    <li><a href="index.php">Home</a>
    </li>
    <li><a href="#" 
        onmouseover="mopen('m1')" 
        onmouseout="mclosetime()">Purchase Order</a>
        <div id="m1" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="po.php">Create PO</a>
        <a href="viewPOs.php" target="_blank">View All POs</a>
        <a href="searchPO.php" target="_blank">Search PO</a>
        </div>
    </li>
     <li><a href="#" 
        onmouseover="mopen('m2')" 
        onmouseout="mclosetime()">Quotation</a>
        <div id="m2" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="quotation.php">Create Quotation</a>
        <a href="viewQuotes.php" target='_blank'>View All Quotations</a>
        <a href="searchQuotation.php" target="_blank">Search Quotation</a>
        </div>
    </li>
      <li><a href="#" 
        onmouseover="mopen('m3')" 
        onmouseout="mclosetime()">Companies</a>
        <div id="m3" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="viewCustomers.php">View All Customers</a>
        <a href="viewSuppliers.php">View All Suppliers</a>
        </div>
    </li>
	<li><a href="logout.php">Logout <?php echo ucfirst($_SESSION['name']);?></a></li>
</ul>
<div style="clear:both"></div>