<?php include "../includes/header.php"; ?>
<?php  
  $id=$_GET["id"];
  
  $query_show = "SELECT * FROM customers WHERE id='$id'";
          
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
        <li><a href="customer_record"><i class="fa fa-user"></i> Customer Record</a></li>
        <li class="active">Edit User Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary well" style="border-top:3px solid skyblue ">
        <?php
       if(isset($_POST["submit"]))
    {
      $name = $_POST["name"];
      $father_name = $_POST["father_name"];
      $phone_no    = $_POST["phone_no"];
      $address  = $_POST["address"];
      $cnic=$_POST["cnic"];
      $created_at=date("y-m-d h:i:s");
      $query_insert = "UPDATE customers SET name= '$name', father_name = '$father_name', phone_no ='$phone_no',address = '$address',cnic = '$cnic' WHERE id=$id";
      $result   = mysqli_query($con,$query_insert);
      if($result)
        {
          $_SESSION["message"]="The Customer is Updated";
          echo "<script type='text/javascript'>window.location='customer_record'</script>";
        } 
      }

  ?>
      <form  method="post" >
        <div class="row">
          <div class="col-md-4">
            <label> Customer Name</label>
            <input type="text" class="form-control" name="name" placeholder="Customer Name" required="" value="<?php echo $row['name'] ?>">
          </div>
          <div class="col-md-4">
            <label>Father Name </label>
            <input type="text" placeholder="Father Name" class="form-control" name="father_name" required="" value="<?php echo $row['father_name'] ?>">
          </div>
          <div class="col-md-4">
            <label>Phone No</label>
            <input type="text" placeholder="Phone No" class="form-control" name="phone_no" required="" data-inputmask='"mask": "+99(999)-9999999"' data-mask placeholder="Customer Phone No" value="<?php echo $row['phone_no'] ?>">
                
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label>CNIC</label>
            <input type="text" class="form-control" name="cnic" required="" data-inputmask='"mask": "99999-9999999-9"' data-mask placeholder="CNIC" value="<?php echo $row['cnic'] ?>">
          </div>
          <div class="col-md-4">
            <label>Address</label>
            <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $row['address'] ?>">
          </div>
         
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-edit"></i> Update</button>
            <a href="customer_record" title="" class="btn btn-danger"> <i class="fa fa-times" ></i> Cancel</a>
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

