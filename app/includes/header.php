<!DOCTYPE html>
<?php 
  include("../includes/connection.php");
  include("../includes/session.php");

  $query_show = "SELECT * FROM users WHERE  id='$user' ";
  $result     = mysqli_query($con,$query_show);
   $row = mysqli_fetch_array($result);
   $user_id= $row["created_by"];
   $query_user = "SELECT username FROM users WHERE  id='$user_id' ";
  $result1     = mysqli_query($con,$query_user);
   $row1 = mysqli_fetch_array($result1);
              
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="../../https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="../../https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="../../https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>POS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Point Of Sale</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="../../#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
            
          <!-- Notifications: style can be found in dropdown.less -->
         
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="../../#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../admin/<?php echo $row['image']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $row["username"]; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../admin/<?php echo $row['image']; ?>" class="img-circle" alt="User Image">

                <p>
                 <?php echo $row["username"]; ?>
                  
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default"> Profile</button>
                </div>
                <div class="pull-right">
                  <a href="../index/logout" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../admin/<?php echo $row['image']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $row["username"]; ?></p>
          <a href="../../#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      
        
       
	       <li class="treeview">
	          <a href="#">
	            <i class="fa fa-user"></i> <span>Manage Admin</span>
	            <span class="pull-right-container">
	              <i class="fa fa-angle-left pull-right"></i>
	            </span>
	          </a>
	          <ul class="treeview-menu">
	            <li><a href="../admin/admin_record"><i class="fa fa-users"></i> Admin</a></li>
	            
	          </ul>
	        </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Customer</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="../customer/customer_record"><i class="fa fa-users"></i> Customers</a></li>
              
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Distributer</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="../distributer/distributer_record"><i class="fa fa-users"></i> Distributer</a></li>
              
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Products</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="../products/product_record"><i class="fa fa-users"></i> Purchase Invoice</a></li>
              
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Purchase Invoice</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="../products/product_record"><i class="fa fa-users"></i> Purchase Invoice</a></li>
              
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Products</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="../products/product_record"><i class="fa fa-users"></i> Product</a></li>
              
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Products</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="../products/product_record"><i class="fa fa-users"></i> Product</a></li>
              
            </ul>
          </li>
        
        
        
        <li class="treeview">
          <a href="../../#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="../../#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="../../#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="../../#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="../../#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="../../#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="../../https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">User Information</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3">
              
            </div>
            <div class="col-md-6">
              <img src="../admin/<?php echo $row['image']; ?>" alt="" class="img-circle" width="100%">
            </div>
          </div>
          <table class="table  table-bordered">
            </thead>
            <tbody>
              <tr>
                <th>User Name</th>
                <td><?php echo $row['username']; ?></td>
              </tr>
              <tr>
                <th>Email Address</th>
                <td><?php echo $row['email']; ?></td>
              </tr>
              <tr>
                <th>Address</th>
                <td><?php echo $row['address']; ?></td>
              </tr>
              <tr>
                <th>Created By</th>
                <td><?php echo $row1['username']; ?></td>
              </tr>
              <tr>
                <th>Created at</th>
                <td><?php echo $row['created_at']; ?></td>
              </tr>
              
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
