<?php 
include"../includes/connection.php";
include"../includes/session.php";
if (isset($_POST["insert_account"])) {
	$net_total_of_products=$_POST["net_total_of_products"];
	$products_discount=$_POST["products_discount"];//Poducts discount
	$net_total=$_POST["net_total"];
	$amount_paid=$_POST["amount_paid"];
	$amount_payable=$_POST["amount_payable"];
	$purchaseInvoiceId=$_POST["purchaseInvoiceId"];
	$net_discount_of_invoice=$_POST["net_discount_of_invoice"];
	$amount_paid=$_POST["amount_paid"];
	$amount_payable=$_POST["amount_payable"];
	$discount_of_invoice=$net_discount_of_invoice-$products_discount;
	 //echo "Total Amount of the product".$net_total_of_products."<br> Discount on Product".$products_discount."<br>Total Amount ".$net_total."<br>Paid Amount".$amount_paid."<br> Amount Remaining ".$amount_payable."<br> Net discount of the invoice".$net_discount_of_invoice.'<br> discount on the invoice'.$discount_of_invoice;
	$sql_invoice="UPDATE purchase_invoice SET product_discount ='$products_discount' ,discount_of_invoice = '$discount_of_invoice' , net_total_of_discount = '$net_discount_of_invoice' ,amount_paid='$amount_paid', amount_payable='$amount_payable' WHERE id = '$purchaseInvoiceId' ";
	$result=mysqli_query($con,$sql_invoice);
	if ($result) {
		$_SESSION["message"]="The products are recorded and account is managed";
		echo "<script>window.location='invoice_record';</script>";
	}
}
?>