<?php 
	include "../includes/connection.php";
	include "../includes/session.php";
	$id=$_GET["id"];
	
	$sql_delete=mysqli_query($con,"DELETE FROM customers WHERE id='$id'");
	if ($sql_delete) {
		$_SESSION["message"]="Record is deleted";
		echo "<script>window.location='customer_record';</script>";
	}
	

?>