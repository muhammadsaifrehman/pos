<?php include "../includes/header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Customer Profile</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="distributer_record"><i class="fa fa-user"></i> Distributer Record</a></li>
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
				
				$query_show = "SELECT * FROM customers WHERE id='$id'";
                
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
             

              <h3 class="profile-username text-center"><?php echo $row["name"]; ?></h3>
			  <ul class="list-group list-group-unbordered">
			  	<li class="list-group-item">
                  <b>Customer Name</b> <a class="pull-right"><?php echo $row["name"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Father Name</b> <a class="pull-right"><?php echo $row["father_name"]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>CNIC</b> <a class="pull-right"><?php echo $row["cnic"]; ?></a>
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

              <a href="distributer_record" class="btn btn-default "><i class="fa fa-backward"></i> <b>Back</b></a>
              <a href="edit-<?php echo $id?>" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> <b>Edit</b></a>
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

 

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
