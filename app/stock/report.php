<?php include "../includes/header.php"; ?>
<style type="text/css" media="print">
  form,footer{
    display: none;
  }
</style>
<style type="text/css" media="screen">
  th,td{
    text-align: center;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i><b>Create Report</b></i></h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Report </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-xs-4 col-md-4 col-lg-4">
          <form method="post">
            <label>Report For</label>
            <select name="report" class="form-control">
              <option value="purchase">Purchase</option>
              <option value="sale">Sale</option> 
            </select>
            <label>Start Date</label>
            <input type="date" class="form-control" id="start_date" placeholder="Enter Start Date" name="start_date" required>
            <label>Last Date</label>
            <input type="date" class="form-control" id="end_date" placeholder="Enter Last Date" name="end_date" required="">
            <br>
            <button type="submit" class="btn btn-success btn-flat" id="insert" name="submit"><i class="fa fa-file"></i> View Report</button>
          </form>
        </div>
      
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
           
          
      <?php 
        if(isset($_POST["submit"])){
          $report=$_POST["report"];
          $start_date=$_POST["start_date"];
          $end_date=$_POST["end_date"];

           
          $i=1;
          if($report=='purchase'){
            $result=mysqli_query($con,"SELECT * FROM purchase_invoice WHERE invoice_date BETWEEN '$start_date' AND '$end_date'");
            $row=mysqli_num_rows($result);
              $start_date = date("d-M-Y", strtotime($start_date));
          $end_date = date("d-M-Y", strtotime($end_date)); 
            ?>
            <h2 style="text-align: center"><i><b>Purchase Report From <u><?php echo $start_date; ?></u> to <u><?php echo $end_date; ?></u></b></i></h2>
              <table class="table table-responsive table-striped table-hover">
                
                <thead>
                   <tr>
                    <th>Sr #</th>
                    <th>Product Name</th>
                    <th>Purchase Date</th>
                    <th>Expiry Start</th>
                    <th>Expiry End</th>
                    <th>Original price</th>
                    <th>Purchase Price</th>
                    <th>IMEI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    while ($fetch = mysqli_fetch_assoc($result)) {
                      $invoice_id = $fetch["id"];
                      $fetch_result= mysqli_query($con,"SELECT pppi.*,p.product_name FROM products_per_purchase_invoice AS pppi INNER JOIN products AS p ON p.id = pppi.product_id WHERE purchase_invoice_id = '$invoice_id'");
                      while ($fetch_product = mysqli_fetch_assoc($fetch_result)) {
                          $invoice_date = $fetch["invoice_date"];
                        $invoice_date = date("d-M-Y", strtotime($invoice_date));
                        $expiry_starting_date = $fetch_product["expiry_starting_date"];
                        $expiry_starting_date = date("d-M-Y", strtotime($expiry_starting_date));
                        $expiry_ending_date = $fetch_product["expiry_ending_date"];
                        $expiry_ending_date = date("d-M-Y", strtotime($expiry_ending_date));
                        ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        
                        <td><?php echo $fetch_product["product_name"]; ?></td>
                        <td><?php echo $invoice_date; ?></td>
                        <td><?php echo $expiry_starting_date; ?></td>
                        <td><?php echo $expiry_ending_date; ?></td>
                        <td><?php echo $fetch_product["original_price"]; ?></td>
                        <td><?php echo $fetch_product["purchase_price"]; ?></td>
                        <td><?php echo $fetch_product["imei"]; ?></td>
                  </tr>
                     <?php
                     $i++;
                      }
                      
                    }
                    if ($i==1) {?>
                        <tr><td colspan="8"><p class="alert alert-danger">
                          <i>No transection is done from <b><?php echo $start_date; ?></b> to <b><?php echo $end_date; ?></b></i>
                        </p></td></tr>
                     <?php }
                  ?>
                </tbody>
              </table>

        <?php }
            else if($report=='sale'){
            $result1=mysqli_query($con,"SELECT * FROM sale_invoice WHERE invoice_date BETWEEN '$start_date' AND '$end_date'");
            $row=mysqli_num_rows($result1);
              $start_date = date("d-M-Y", strtotime($start_date));
          $end_date = date("d-M-Y", strtotime($end_date)); 
            ?>
            <h2 style="text-align: center"><i><b>Sale Report From <u><?php echo $start_date; ?></u> to <u><?php echo $end_date; ?></u></b></i></h2>
              <table class="table table-responsive table-striped table-hover">
                
                <thead>
                   <tr>
                    <th>Sr #</th>
                    <th>Product Name</th>
                    <th>Sale Date</th>
                    <th>Sale Price</th>
                    <th>Discount</th>
                    <th>IMEI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                 
                   while ($fetch_sale_invoice = mysqli_fetch_assoc($result1)) {
                     $sale_id = $fetch_sale_invoice["sale_id"];
                     $sale_details = mysqli_query($con,"SELECT sipd.*,p.product_name FROM sale_invoice_product_details AS sipd INNER JOIN products AS p ON sipd.product_id = p.id 
                       WHERE sale_id = '$sale_id'");
                     while ($fetch_sale_product = mysqli_fetch_assoc($sale_details)) {
                        $invoice_date = $fetch_sale_invoice["invoice_date"];
                        $invoice_date = date("d-M-Y", strtotime($invoice_date));
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $fetch_sale_product["product_name"] ; ?></td>
                        <td><?php echo $invoice_date ?> </td>
                        <td><?php echo $fetch_sale_product["sale_price"]; ?></td>
                        <td><?php echo $fetch_sale_product["discount_per_item"]; ?></td>
                        
                        <td><?php echo $fetch_sale_product["imei"]; ?></td>
                      </tr>
                    <?php 
                      $i++;
                  } 
                   }
                   if ($i==1) {?>
                        <tr><td></td><td colspan="4"><p class="alert alert-danger" style="text-align:center;color: white !important">
                          <i>No transection is done from <b><?php echo $start_date; ?></b> to <b><?php echo $end_date; ?></b></i>
                        </p></td><td></td></tr>
                     <?php }
                  
                  ?>
                </tbody>
              </table>

        <?php }

         }
      ?>
            </div>
          </div>
        </div>
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
<script>
  let a=1;

  $(document).ready(function(){
    $('#end_date').change(function(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    if (start_date > end_date) {
      alert('Enter Valid date');
      $('#start_date').val("");
      $('#end_date').val("");
      $('#start_date').focus();
      $("#insert").attr("disabled", true);
    }
    else{
      $("#insert").removeAttr("disabled");
    }
    });
  $('#start_date').change(function(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    if (end_date=="" || end_date==null) 
    {

    }
    else{
      if (start_date > end_date) {
        alert('Enter Valid date');
        $('#start_date').val("");
        $('#end_date').val("");
        $('#start_date').focus();
        $("#insert").attr("disabled", true);
      }
      else{
          $("#insert").attr("disabled", false);
        }
      }
    });
  });
</script>