<?php include "../includes/header.php"; ?>
<?php  
  $id=$_GET["id"];
  
  $query_show = "SELECT * FROM products WHERE id='$id'";
          
  $result     = mysqli_query($con,$query_show);
  $row = mysqli_fetch_array($result); 
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Profile</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="admin_record"><i class="fa fa-user"></i> Customer Record</a></li>
        <li class="active">Edit User Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary well" style="border-top:3px solid skyblue ">
        <?php
       if(isset($_POST["submit"]))
    {
      $product_name = $_POST["product_name"];
      $manufacturer = $_POST["manufacturer"];
      
      $query_insert = "UPDATE products SET product_name= '$product_name', manufacturer = '$manufacturer' WHERE id='$id'";
     
      $result   = mysqli_query($con,$query_insert);
      
      if($result)
        {
          $_SESSION["message"]="The product is Updated";
          echo "<script type='text/javascript'>window.location='product_record'</script>";
        } 
      }

  ?>
      <form  method="post" >
        <div class="row">
          <div class="col-md-6">
            <label> product Name</label>
            <input type="text" class="form-control" name="product_name" placeholder="Product Name" required="" value="<?php echo $row['product_name'] ?>">
          </div>
          
          
                
          </div>
        
        <div class="row">
          <div class="col-md-6">
            <label>Manufacturer </label>
            <input type="text" placeholder="Manufacturer Name" class="form-control" name="manufacturer" required="" value="<?php echo $row['manufacturer'] ?>">
          </div>
          
         
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-edit"></i> Update</button>
            <a href="product_record" title="" class="btn btn-danger"> <i class="fa fa-times" ></i> Cancel</a>
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
  <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
  
</div>

