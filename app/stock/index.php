<?php include "../includes/header.php"; ?>
<style type="text/css" media="screen">
  pre{
    border:none;
    background-color: white;
    font-weight: bold;
    font-family: verdana;
  }
  td{
    text-align: center;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Stock</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer Record</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Available </a></li>
              <li><a href="#timeline" data-toggle="tab">Sold</a></li>
              
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
              <div class="box">
            <div class="box-header">
              <h3>Available Stock</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>

                  <th><pre>Sr # No</pre></th>
                  <th><pre>Product Name</pre></th>
                  <th><pre>Expiry Starting Date</pre> </th>
                  <th><pre>Expiry Ending Date</pre></th>
                  <th><pre>Selling Price</pre></th>
                  <th><pre>BarCode</pre></th>
                  
                </tr>
                </thead>
                <tbody>
                <?php
                $query_show = "SELECT pppi.*,products.product_name FROM products_per_purchase_invoice AS pppi INNER JOIN products ON products.id= pppi.product_id WHERE pppi.status='available'";
                $i=1;
                $result     = mysqli_query($con,$query_show);
                while ($row = mysqli_fetch_assoc($result)) { 
                  
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php  echo $row['expiry_starting_date'] ;?></td>
                    <td><?php  echo $row['expiry_ending_date'] ;?></td>
                    <td><?php echo $row["sale_price"]; ?></td>
                    <td><?php echo $row["imei"]; ?></td> 
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
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
             
            <div class="box">
              <div class="box-header">
                <h3>Sold Stock</h3>
              </div>
              <div class="box-body">
              <div class="table-responsive">
              <table id="example2" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>

                  <th><pre>Sr # No</pre></th>
                  <th><pre>Product Name</pre></th>
                  <th><pre>Expiry Starting Date</pre> </th>
                  <th><pre>Expiry Ending Date</pre></th>
                  <th><pre>Selling Price</pre></th>
                  <th><pre>BarCode</pre></th>
                  
                </tr>
                </thead>
                <tbody>
                <?php
                $query_show = "SELECT pppi.*,products.product_name FROM products_per_purchase_invoice AS pppi INNER JOIN products ON products.id= pppi.product_id WHERE pppi.status='sold'";
                $i=1;
                $result     = mysqli_query($con,$query_show);
                while ($row = mysqli_fetch_assoc($result)) { 
                  
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php  echo $row['expiry_starting_date'] ;?></td>
                    <td><?php  echo $row['expiry_ending_date'] ;?></td>
                    <td><?php echo $row["sale_price"]; ?></td>
                    <td><?php echo $row["imei"]; ?></td> 
                    </tr>
                  <?php
                  $i++;
                }
                ?>
                </tbody>
               
              </table>
              </div>
            </div>
            </div>
            
            <!-- /.box-body -->
        
              <!-- /.tab-pane -->

           
              <!-- /.tab-pane -->
          
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
     
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include"../includes/footer.php" ?>
  

 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
