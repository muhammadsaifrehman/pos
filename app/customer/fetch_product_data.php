<?php 

	include"../includes/connection.php";
	session_start();
	$user = $_SESSION["user_name"];
	if (isset($_POST["barcode"])) {
		$barcode = $_POST["barcode"];
		$sql="SELECT pppi.* ,p.product_name FROM products_per_purchase_invoice AS pppi INNER JOIN products AS p on pppi.product_id= p.id WHERE pppi.imei = '$barcode' AND status = 'available'";
		$sql_result= mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($sql_result);
		echo json_encode($row);
	}
	elseif (isset($_POST["customer_id"])&&isset($_POST["total_amount"])&&isset($_POST["net_total"])&&isset($_POST["paid_amount"])&&isset($_POST["remaining"])&&isset($_POST["status"])&&isset($_POST["productIdArr"])&&isset($_POST["salepriceArr"])&&isset($_POST["imeiArr"])&&isset($_POST["discountArr"])) {
		$customer_id = $_POST["customer_id"];
		$invoice_date = $_POST["invoice_date"];
		$total_amount = $_POST["total_amount"];
		$net_total = $_POST["net_total"];
		$discount = $total_amount - $net_total;
		$paid_amount = $_POST["paid_amount"];
		
		$remaining = $_POST["remaining"];
		
		$status = $_POST["status"];
		
		$productIdArr = $_POST["productIdArr"];
		
		$salepriceArr = $_POST["salepriceArr"];
		
		$imeiArr = $_POST["imeiArr"];
		$created_at =date("y-m-d h:i:s");
		$discountArr = $_POST["discountArr"];
		$length = count($productIdArr);
$sale_invoice_head= "INSERT INTO sale_invoice (customer_id,invoice_date,total_amount,discount,net_total,amount_paid,remaining,status,created_by,created_at) VALUES ('$customer_id ','$invoice_date','$total_amount','$discount','$net_total','$paid_amount','$remaining ','$status','$user','$created_at')";
$sql_result = mysqli_query($con,$sale_invoice_head);
$last_id = mysqli_insert_id($con);
$transection_detail = "INSERT INTO transection_details (type,invoice_id,transection_date,paid_amount,status,created_by,created_at)VALUES('sale','$last_id','$invoice_date','$paid_amount','$status','$user','$created_at')";
$result_transection_detail= mysqli_query($con,$transection_detail);
    for ($i=0; $i < $length; $i++) { 
    	$fetch_product_id = mysqli_query($con,"SELECT product_id FROM products_per_purchase_invoice WHERE id='$productIdArr[$i]'");
    	$product_reocrd = mysqli_fetch_assoc($fetch_product_id);
    	$product_id = $product_reocrd["product_id"];
    	$sale_invoce_details = "INSERT INTO sale_invoice_product_details (sale_id,product_id,sale_price,imei,discount_per_item,created_by,created_at) VALUES ('$last_id','$product_id','$salepriceArr[$i]','$imeiArr[$i]','$discountArr[$i]','$user','$created_at')";
    	$sql_detail_result = mysqli_query($con,$sale_invoce_details);
    	$sql_update = "UPDATE products_per_purchase_invoice SET  status = 'sold' WHERE id = '$productIdArr[$i]'";
    	$result_update = mysqli_query($con,$sql_update);

    }
		if ($result_update) {
		
          
          echo json_encode($result_update);
        
		}
	}
?>
