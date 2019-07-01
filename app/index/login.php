<?php include"../includes/connection.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- PHP Code -->
 
        
      <?php

        if (isset($_POST["submit"])) {
            $username=mysqli_real_escape_string($con,$_POST["username"]);
            $password=mysqli_real_escape_string($con,$_POST["password"]);
           // echo $username,$pas;
            //Query 
            $sql="SELECT * FROM users WHERE username='$username' AND password='$password' ";
            $result=mysqli_query($con,$sql);
            $row=mysqli_num_rows($result);
            $fetch=mysqli_fetch_assoc($result);
            if ($row>0) {
              session_start();
              $_SESSION["user_name"]=$fetch["id"];
              echo "<script type='text/javascript'>window.location='../index/admin_view'</script>";
            }
            else{
             ?>
             <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
             invalid User Name or Password
             </div>
             <?php
            }
        } 
      ?>
        
      
  
  <!-- Php code ends here -->
  <div class="login-logo">
    <a href="#"><b>Point of Sale</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><h4 align="center">Login to start your session</h4></p>

    <form  method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="User Name" name="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        
        <div class="input-group">
          <input type="password" class="form-control" id="pwd" name="password" placeholder="password">
          <span class="input-group-addon"><i class="fa fa-eye" title="show password" id="eye"></i></span>
        </div>
        
        <br> <br>
      </div>
      <div class="row">

        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <a href="#">I forgot my password</a><br>
    <a href="#" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>

    var pwd = document.getElementById('pwd');
    var eye = document.getElementById('eye');

    eye.addEventListener('click',togglePass);

    function togglePass(){
      eye.classList.toggle('active');
      
      (pwd.type=='password')? pwd.type='text' :
      pwd.type='password';
      eye.classList.toggle('active');
      
      (eye.title=='show password')? eye.title='Hide Password' :
      eye.title='Show Password';

    }
  
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
