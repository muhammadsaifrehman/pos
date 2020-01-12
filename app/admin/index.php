<?php include "../includes/header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Manage Admin</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin Record</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-xs-12">
         
         

          <div class="box">
            <div class="box-header">
              <button class="btn btn-success btn-sm" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-user" title="Add new User"><i class="fa fa-plus"></i></button>
              <br>
              <?php session_message(); ?>
              <?php error_message(); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                
              
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>Sr No #</th>
                  <th>User Name</th>
                  <th>Email Address</th>
                  <th>Address</th>
                  <th>User Photo</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query_show = "SELECT * FROM users ";
                $i=1;
                $result     = mysqli_query($con,$query_show);
                while ($row = mysqli_fetch_array($result)) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php  echo $row['username'] ;?></td>
                    <td><?php  echo $row['email'] ;?></td>
                    <td><?php  echo $row['address'] ;?></td>
                    <td> <a href="<?php  echo $row['image'];?>"><img src="<?php  echo $row['image'];?>" class="img-circle" width="50px" height="50px"></a></td>
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

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<div class="modal fade" id="modal-user">
    <div class="modal-dialog model-xs">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Admin</h4>
        </div>
        <div class="modal-body" >
          <form  method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10">
                <label> User Name</label>
                <input type="text" class="form-control" name="username" placeholder="User Name" required="">
                <label>Password</label>
                <input type="password" placeholder="password" class="form-control" name="password" required="">
                <label>Email</label>
                <input type="email" placeholder="Email Address" class="form-control" name="email" required="">
                <label>Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address" required="">
                <label>Profile Picture</label>
                <input type="file" class="form-control" name="profile" placeholder="Image" required="">
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
      $username = $_POST["username"];
      $password = $_POST["password"];
      $email    = $_POST["email"];
      $address  = $_POST["address"];
      $filename = $_FILES["profile"]['name'];
      $tempname = $_FILES["profile"]['tmp_name'];
      $ext      = pathinfo($filename, PATHINFO_EXTENSION);
      $size     = $_FILES["profile"]["size"]; 
      $folder   ="uploads/".$filename;
      
      move_uploaded_file($tempname, $folder);
      $created_at=date("y-m-d h:i:s");
      $query_insert = "INSERT INTO users(username, password, email,image,address,created_by,created_at) VALUES ('$username','$password','$email','$folder','$address','$user','$created_at')";
      $result   = mysqli_query($con,$query_insert);
      if($result)
        {
          $_SESSION["message"]="The record is inserted";
          echo "<script type='text/javascript'>window.location='admin_record'</script>";
        } 
      }


  ?>

