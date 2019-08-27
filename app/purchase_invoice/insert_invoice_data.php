<?php include "../includes/connection.php";
 session_start();
 $user=$_SESSION["user_name"];

$purchaseInvoiceId=$_POST["purchaseInvoiceId"];
$productIdArr=$_POST["productIdArr"];
$expStartingArr=$_POST["expStartingArr"];
$expEndingArr=$_POST["expEndingArr"];
$discountArr=$_POST["discountArr"];
$originalPriceArr=$_POST["originalPriceArr"];
$purchasePriceArr=$_POST["purchasePriceArr"];
$salePriceArr=$_POST["salePriceArr"];
$statusArr=$_POST["statusArr"];
$imeiArr=$_POST["imeiArr"];
$length=count($productIdArr);
$created_at=date("y-m-d h:i:s");
// echo json_encode($originalPriceArr);
// echo json_encode($discountArr);
// echo json_encode($salePriceArr);
// echo json_encode($statusArr);
// echo json_encode($imeiArr);
// echo json_encode($purchaseInvoiceId);
// echo json_encode($productIdArr);
// echo json_encode($expStartingArr);
// echo json_encode($expEndingArr);
// echo json_encode($length);
for ($i=0; $i <$length ; $i++) { 
	$sql="INSERT INTO products_per_purchase_invoice (purchase_invoice_id,product_id,expiry_starting_date,expiry_ending_date,original_price,discount_per_item,purchase_price,sale_price,status,imei,created_by,created_at) VALUES ('$purchaseInvoiceId','$productIdArr[$i]','$expStartingArr[$i]','$expEndingArr[$i]','$originalPriceArr[$i]','$discountArr[$i]','$purchasePriceArr[$i]','$salePriceArr[$i]','$statusArr[$i]','$imeiArr[$i]','$user','$created_at')";
	$result=mysqli_query($con,$sql);
	echo json_encode($result);
	
}

	

 ?>