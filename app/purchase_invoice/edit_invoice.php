<?php include "../includes/header.php"; ?>
<?php  
  $id=$_GET["id"];
  
  $query_show = "SELECT * FROM purchase_invoice WHERE id='$id'";
          
  $result     = mysqli_query($con,$query_show);
  $row1 = mysqli_fetch_array($result); 
  $did=$row1["distributer_id"];
    $original_price=0;
  $discount_per_item=0;
  $query_product = "SELECT purchase_price,discount_per_item FROM products_per_purchase_invoice WHERE purchase_invoice_id='$id'";
          
  $result_product     = mysqli_query($con,$query_product);

  while ($row2 = mysqli_fetch_assoc($result_product)) {
     $purchase_price=$purchase_price+$row2["purchase_price"];
     $disocunt_per_item=$disocunt_per_item+$row2["discount_per_item"];
   } 

  

  $distributer_data = "SELECT name FROM distributer WHERE id='$did'";
          
  $result_distributer = mysqli_query($con,$distributer_data);
  $distributer_row=mysqli_fetch_assoc($result_distributer);
  $namee=$distributer_row["name"];

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Invoice</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="invoice_record"><i class="fa fa-user"></i> Invoice Record</a></li>
        <li class="active">Edit purchase invoice</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary well" style="border-top:3px solid skyblue ">

        <?php
       
      if(isset($_POST["submit"]))
      {
      
      $distributer_id = $_POST["distributer_id"];
      $date           = $_POST["date"];
      $comment        = $_POST["comment"];
      $amount_paid=$_POST["amount_paid"];
      

 
      $discount_of_invoice=$_POST["discount_of_invoice"];
      $payable_amount= $purchase_price-$amount_paid-$discount_of_invoice;  
      $query_update = "UPDATE purchase_invoice SET distributer_id='$distributer_id',`date`='$date',comment='$comment', amount_paid = '$amount_paid' ,amount_payable = '$payable_amount' , discount_of_invoice='$discount_of_invoice' WHERE id = $id";
      

      $result   = mysqli_query($con,$query_update);
      

      if($result)
        {
          $_SESSION["message"]="The invoice is updated ";
          echo "<script type='text/javascript'>window.location='invoice_record'</script>";
        } 
      }

  ?>
      <form  method="post" >
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label> Distributer Name</label>  
                <select name="distributer_id" class="form-control" required="">
                <option value="<?php echo $did; ?>"> <?php  echo $namee;?></option>
                <?php 
                  $query=mysqli_query($con,"SELECT * FROM distributer where id!=$did");  
                  while ($row=mysqli_fetch_assoc($query)) {?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                  <?php 
                  }  
                  ?>
                </select>
              </div>
            </div>
          
          <div class="col-md-4">
            
            <div class="form-group">
                <label>Date:</label>
              
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control " name="date" value="<?php echo $row1['date']; ?>">
                </div>
                <!-- /.input group -->
              </div>
          </div>

          <div class="col-md-4">
            <label for="">Discount On Invoice</label>
            <input type="text" class="form-control" value="<?php echo $row1['discount_of_invoice']; ?>" name="discount_of_invoice">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label for="">Discount On Products</label>
            <input type="text" name="" class="form-control" value="<?php echo $row1['product_discount']; ?>"  readonly>
          </div>
          <div class="col-md-4">
            <label for="">Paid Amount</label>
            <input type="text" class="form-control" value="<?php echo $row1['amount_paid']; ?>" name="amount_paid">
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label>Comment </label>
                <textarea name="comment" class="form-control" placeholder="comment" rows="4"> <?php echo $row1['comment']; ?></textarea>
                </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-edit"></i> Update</button>
            <a href="invoice_record" title="" class="btn btn-danger"> <i class="fa fa-times" ></i> Cancel</a>
          </div>
        </div>
      </div>
    </form>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include"../includes/footer.php" ?>
  
