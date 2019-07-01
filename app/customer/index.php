<?php include "../includes/header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Manage Customer</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer Record</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-xs-12">
         
         

          <div class="box">
            <div class="box-header">
              <button class="btn btn-success" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-customer" title="Add new User"><i class="fa fa-plus"></i></button>
              <br>
              <?php session_message(); ?>
              <?php error_message(); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>Sr No #</th>
                  <th>Customer Name</th>
                  <th>Father Name</th>
                  <th>Address</th>
                  <th>CNIC</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query_show = "SELECT * FROM customers ";
                $i=1;
                $result     = mysqli_query($con,$query_show);
                while ($row = mysqli_fetch_array($result)) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php  echo $row['name'] ;?></td>
                    <td><?php  echo $row['father_name'] ;?></td>
                    <td><?php  echo $row['address'] ;?></td>
                    <td> <?php  echo $row['cnic'] ;?></td>
                     <td>
                    <a href="view-<?php echo $row['id']; ?>" title="View"><i class="fa fa-eye" style="color:orange;font-size: 15px;margin:5px;"></i></a>
                    <a href="edit-<?php echo $row['id']; ?>" title="Edit"><i class="fa fa-pencil" style="color:skyblue;font-size: 15px;margin:5px;"></i></a>
                    <a href="delete-<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure ??')"><i class="fa fa-trash" style="color:red;font-size: 15px;margin:5px;"></i></a>
                  </td>
                  </tr>
                  <?php
                  $i++;
                }
                ?>
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include"../includes/footer.php" ?>
  

 <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<div class="modal fade" id="modal-customer">
    <div class="modal-dialog model-xs">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Customer</h4>
        </div>
        <div class="modal-body" >
          <form  method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10">
                <label> Customer Name</label>
                <input type="text" class="form-control" name="name" placeholder="User Name" required="">
                <label>Father Name </label>
                <input type="text" placeholder="Father Name" class="form-control" name="father_name" required="">
                <label>Phone No</label>
                <input type="text" placeholder="Phone No" class="form-control" name="phone_no" required="" data-inputmask='"mask": "+99(999)-9999999"' data-mask placeholder="Customer Phone No">
                <label>CNIC</label>
                <input type="text" class="form-control" name="cnic" required="" data-inputmask='"mask": "99999-9999999-9"' data-mask placeholder="CNIC">
                <label>Address</label>
                <textarea class="form-control" name="address" placeholder="Address" required="" rows="3"></textarea>
                <div class="row">
                  <br>
                  <div class="col-md-3"></div>
                  <div class="col-md-6 form-group">
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    <button data-dismiss="modal" class="btn btn-info">Cancel</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
   <?php
    if(isset($_POST["submit"]))
    {
      $name = $_POST["name"];
      $father_name = $_POST["father_name"];
      $phone_no    = $_POST["phone_no"];
      $address  = $_POST["address"];
      $cnic=$_POST["cnic"];
      $created_at=date("y-m-d h:i:s");
      $query_insert = "INSERT INTO customers(name, father_name,phone_no,address,cnic,created_by,created_at) VALUES ('$name','$father_name','$phone_no','$address','$cnic','$user','$created_at')";
      $result   = mysqli_query($con,$query_insert);
      if($result)
        {
          $_SESSION["message"]="The Customer is inserted";
          echo "<script type='text/javascript'>window.location='customer_record'</script>";
        } 
      }
  ?>

