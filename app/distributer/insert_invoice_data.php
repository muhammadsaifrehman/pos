<?php
include"../includes/connection.php";
$id=4;
  $credit_Sum=0;
$query_money="SELECT remaining FROM purchase_invoice WHERE status = 'Unpaid' AND distributer_id= '$id' OR status = 'Partially' AND distributer_id= '$id'";
$result_credit_money = mysqli_query($con,$query_money);
 while($row_credit = mysqli_fetch_assoc($result_credit_money)){
$credit_Sum  = $credit_Sum + $row_credit["remaining"];

 }
  echo $credit_Sum;
?>