<?php include "../includes/header.php"; ?>
<?php  
  $id=$_GET["id"];
  
  $query_show = "SELECT * FROM users WHERE id='$id'";
          
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
        <li><a href="admin_record"><i class="fa fa-user"></i> Admin Record</a></li>
        <li class="active">Edit User Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary well" style="border-top:3px solid skyblue ">
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
      
      if ($filename) {
        move_uploaded_file($tempname, $folder);
        $query_insert = "UPDATE  users SET username ='$username', password = '$password', email = '$email',image = '$folder',address = '$address' WHERE id= '$id'";
      }
      else{
        $query_insert = "UPDATE  users SET username ='$username', password = '$password', email = '$email',address = '$address' WHERE id= '$id'";
      }
      $result   = mysqli_query($con,$query_insert);
      if($result)
        {
          $_SESSION["message"]="The record is updated";
          echo "<script type='text/javascript'>window.location='admin_record'</script>";
        } 
      }


  ?>
      <form  method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-4">
            <label> User Name</label>
            <input type="text" class="form-control" name="username" placeholder="User Name" required="" value="<?php echo $row['username']; ?>" autofocus="">
          </div>
          <div class="col-md-4">
            <label>Password</label>
            <input type="password" placeholder="password" class="form-control" name="password" required="" value="<?php echo $row['password']; ?>">
          </div>
          <div class="col-md-4">
            <label>Email</label>
            <input type="email" placeholder="Email Address" class="form-control" name="email" required="" value="<?php echo $row['email']; ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label>Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address" required="" value="<?php echo $row['address']; ?>">
          </div>
          <div class="col-md-4">
            <label>Profile Picture</label>
            <input type="file" class="form-control" name="profile" placeholder="Image" >
          </div>
         
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-edit"></i> Update</button>
            <a href="admin_record" class="btn btn-danger"> <i class="fa fa-trash"></i> Cancel</a>
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

  
</div>

