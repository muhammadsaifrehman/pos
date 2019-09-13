<?php 
$purchaseInvoiceId=$_POST["purchaseInvoiceId"];
$discount=0;
  $original_price=0;
  include("../includes/connection.php");

  $sql_fetch=mysqli_query($con,"SELECT original_price,discount_per_item FROM products_per_purchase_invoice WHERE purchase_invoice_id= '$purchaseInvoiceId'");
  while($row=mysqli_fetch_assoc($sql_fetch)) {
    $original_price=$original_price+$row["original_price"];
    $discount+=$row["discount_per_item"];
}

echo json_encode(array($original_price, $discount));
?>