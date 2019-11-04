<?php 

	include"../includes/connection.php";
	if ($_POST["barcode"]) {
		$barcode = $_POST["barcode"];
		$sql="SELECT pppi.* ,p.product_name FROM products_per_purchase_invoice AS pppi INNER JOIN products AS p on pppi.product_id= p.id WHERE pppi.imei = '$barcode' AND pppi.status='available'";
		$sql_result= mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($sql_result);
		echo json_encode($row);
	}
?>