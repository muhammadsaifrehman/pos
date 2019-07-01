<?php include "../includes/header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>User Profile</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="admin_record"><i class="fa fa-user"></i> Admin Record</a></li>
        <li class="active">User Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
			<?php  
				$id=$_GET["id"];
				
				$query_show = "SELECT * FROM users WHERE id='$id'";
                
                $result     = mysqli_query($con,$query_show);
                $row = mysqli_fetch_array($result); 
                $created_by=$row["created_by"];
                $query_user = "SELECT username FROM users WHERE id='$created_by'";
                
                $result1     = mysqli_query($con,$query_user);
                $row1 = mysqli_fetch_array($result1); 
			?>
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $row['image']; ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $row["username"]; ?></h3>
			  <ul class="list-group list-group-unbordered">
			  	<li class="list-group-item">
                  <b>User Name</b> <a class="pull-right"><?php echo $row["username"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $row["email"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Address</b> <a class="pull-right"><?php echo $row["address"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Created By</b> <a class="pull-right"><?php echo $row1["username"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Created Time</b> <a class="pull-right"><?php echo $row["created_at"]; ?></a>
                </li>
              </ul>

              <a href="admin_record" class="btn btn-default "><b>Back</b></a>
              <a href="edit-<?php echo $id?>" class="btn btn-primary pull-right"><b>Edit</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
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
