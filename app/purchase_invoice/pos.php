<?php include "../includes/session.php"; ?>
<?php include "../includes/connection.php"; ?>

<?php
    if(isset($_POST["submit"]))
    {
      $distributer_id = $_POST["distributer_id"];
      $date           = $_POST["date"];
      $comment        = $_POST["comment"];  
      $created_at=date("y-m-d h:i:s");
      $query_insert = "INSERT INTO purchase_invoice(distributer_id,`date`,comment,created_by,created_at,product_discount,net_total_of_discount,discount_of_invoice, amount_paid,amount_payable) VALUES ('$distributer_id','$date','$comment','$user','$created_at','0','0','0','0','0')";
      echo $query_insert;
     
      $result   = mysqli_query($con,$query_insert);
      var_dump($result);

      if($result)
        {
          $_SESSION["message"]="The invoice is generated ";
          echo "<script type='text/javascript'>window.location='invoice_record'</script>";
        } 
      }
  ?>
  
      
   
