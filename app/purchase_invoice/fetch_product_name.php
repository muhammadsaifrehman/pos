<?php
include"../includes/connection.php";

  if(isset($_POST['productId'])){

  $productId = $_POST['productId'];

  $productName = "SELECT product_name from products WHERE id = '$productId'";
  $result=mysqli_query($con,$productName);
  $row=mysqli_fetch_assoc($result);

  echo json_encode($row);
}
?>