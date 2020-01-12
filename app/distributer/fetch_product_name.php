<?php
include"../includes/connection.php";
session_start();
$user = $_SESSION["user_name"];

  if(isset($_POST['productId'])){

  $productId = $_POST['productId'];

  $productName = "SELECT product_name from products WHERE id = '$productId'";
  $result=mysqli_query($con,$productName);
  $row=mysqli_fetch_assoc($result);

  echo json_encode($row);
}
else if(isset($_POST["distributer_id"]) && isset($_POST["total_amount"]) && 
	isset($_POST["invoice_date"]) && isset($_POST["net_total"]) && isset($_POST["paid"]) && 
	isset($_POST["remaining"]) && isset($_POST["invoice_status"]) && isset($_POST["productIdArr"]) && isset($_POST["expStartingArr"]) && isset($_POST["expEndingArr"]) && 
	isset($_POST["originalPriceArr"]) &&isset($_POST["discountArr"]) && 
	isset($_POST["purchasePriceArr"]) && isset($_POST["salePriceArr"]) && 
	isset($_POST["statusArr"]) && isset($_POST["imeiArr"]))
	{
	$distributer_id = $_POST["distributer_id"];
	$total_amount =$_POST["total_amount"];
	$invoice_date = $_POST["invoice_date"];
	$net_total=$_POST["net_total"];
	$paid=$_POST["paid"];
	$remaining=$_POST["remaining"];
	$invoice_status=$_POST["invoice_status"];
	
	$discount = $total_amount-$net_total; 
	$created_at = date("y-m-d h:i:s");
	
	

	$sql_invoice_head="INSERT INTO purchase_invoice (distributer_id,invoice_date,total_amount, discount,net_total,amount_paid,remaining,status,created_by,created_at) VALUES ('$distributer_id', '$invoice_date', '$total_amount','$discount','$net_total', '$paid', '$remaining', '$invoice_status', '$user','$created_at')";
	$invoice_head_result = mysqli_query($con,$sql_invoice_head);
	$last_id = mysqli_insert_id($con);
	// Inserting data in the transection table
	$transection_detail = "INSERT INTO transection_details (type,invoice_id,transection_date,paid_amount,status,created_by,created_at)VALUES('purchase','$last_id','$invoice_date','$paid','$invoice_status','$user','$created_at')";
$result_transection_detail= mysqli_query($con,$transection_detail);

	$productIdArr = $_POST["productIdArr"];
	$array_length = count($productIdArr);
    $expStartingArr=$_POST["expStartingArr"];
    $expEndingArr=$_POST["expEndingArr"];
    $originalPriceArr=$_POST["originalPriceArr"];
    $discountArr=$_POST["discountArr"];
    $purchasePriceArr=$_POST["purchasePriceArr"];
    $salePriceArr=$_POST["salePriceArr"];
    $statusArr=$_POST["statusArr"];
    $imeiArr=$_POST["imeiArr"];
    for ($i=0; $i < $array_length; $i++) { 
       $sale_invoice_details="INSERT INTO products_per_purchase_invoice (purchase_invoice_id, product_id,expiry_starting_date,expiry_ending_date,original_price,discount_per_item, purchase_price,sale_price,status,imei,created_by, created_at) VALUES ('$last_id', '$productIdArr[$i]', '$expStartingArr[$i]', '$expEndingArr[$i]','$originalPriceArr[$i]','$discountArr[$i]', '$purchasePriceArr[$i]', '$salePriceArr[$i]', '$statusArr[$i]', '$imeiArr[$i]', '$user', '$created_at');";
       $result_detail= mysqli_query($con,$sale_invoice_details);    
        
    }  
    echo json_encode($result_detail);      


}
?>