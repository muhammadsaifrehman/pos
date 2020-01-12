<?php include "../includes/header.php"; 
$id=$_GET["id"];
$sql = "SELECT si.*,c.name from sale_invoice as si INNER JOIN customers as c ON c.id = si.customer_id where si.sale_id = '$id' ";
$result = mysqli_query($con,$sql);
$row1 = mysqli_fetch_assoc($result);
$invoice_details="SELECT * FROM sale_invoice_product_details WHERE sale_id = '$id'";
$result_detail = mysqli_query($con,$invoice_details);
$product_item = mysqli_query($con,"SELECT DISTINCT(product_id) FROM sale_invoice_product_details where sale_id = $id");
$count_product_item = mysqli_num_rows($product_item); 
$time = new DateTime($row1["created_at"]);
$time = $time->format('H:i' );
$time=  date('h:i:s a', strtotime($time));
?>
<style type="text/css" media="print">
  footer{
    display: none;
  }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-xs-12">
         
         

          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <h3  style="text-align: center;">
            <b>Point Of Sale</b>
          </h3>
          <p style="text-align: center;">
            <b>Created By: Muhammad Saif Ur Rehman</b><br>Chak No 145/P Adam Sahaba Rahim yar Khan<br>Contact #: +92 (308) 31 52 045<br>
          </p>
          <h3 style="text-align: center;background-color: lightgray !important;padding:10px;">Credit Cash Memo</h3>
          
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered">
                
                <thead>
                  <tr>
                    <th style="vertical-align: top;">Name:</th>
                    
                    <td style="text-align: center;"><?php echo $row1["name"]; ?></td>
                    <th>Date</th>
                    
                    <td style="text-align: center;"><?php echo $row1["invoice_date"] ?></td>
                  </tr>
                  <tr>
                    <th><b>INV #</b></th>
                    
                    <td style="text-align: center;"><?php echo $id; ?></td>
                    <th>Time</th>
                    
                    <td style="text-align: center;"> <?php echo $time; ?></td>
                  </tr>
                </thead>
                
              </table>
            </div>
          </div>
          <table class="table">
            <thead style="background-color: #3C8DBC !important;color:white;">
              <tr>
                <th>Sr #</th>
                <th>Product Name</th>
                <th>IMEI</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i = 1;
              $discount_per_item = 0;
              while ($row_detail = mysqli_fetch_assoc($result_detail)) {
                  $product_id = $row_detail["product_id"];
                $product_name = mysqli_query($con,"SELECT product_name FROM products WHERE id = '$product_id'");
                $products_row = mysqli_fetch_assoc($product_name);
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $products_row["product_name"]; ?></td>
                <?php $discount_per_item=$discount_per_item+ $row_detail["discount_per_item"]; ?>
                  
                  <td style="text-align: center;"><?php echo $row_detail["imei"]; ?></td>
                  <td style="text-align: center;"><?php echo $row_detail["sale_price"]; ?></td>
              </tr>
             <?php 
             $total_amount =$total_amount+ $row_detail["sale_price"];
             $i++;
           } 
            $i=$i-1;
           ?>
                          </tbody>
          </table>
                  </div>
        <div class="col-sm-6 col-md-offset-3">
          <table class="table table-bordered" >
            <thead>
              <tr>
                <th style="text-align: center;background-color: lightgray;">Total Item: </th>
                <th style="background-color: white;text-align: center;"><?php echo $count_product_item; ?></th>
                <th style="text-align: center;background-color: lightgray;">Total Qty: </th>
                <th style="background-color:white;text-align: center;"><?php echo $i; ?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          
        </div>
        <div class="col-sm-6">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="background-color:white;color:black;">Total Amount</th>
                <th style="text-align: center;"><?php echo $total_amount; ?></th>
              </tr>
              <tr>
                <th style="background-color:white;color:black;">Invoice Discount</th>
                <th style="text-align: center;"><?php echo $row1["discount"]; ?></th>
              </tr>
              <tr>
                <th style="background-color:white;color:black;">Product Discount</th>
                <th style="text-align: center;"><?php echo $discount_per_item; ?></th>
              </tr>
              <tr>
                <th style="background-color:white;color:black;">Net Bill</th>
                <th style="text-align: center;"><?php echo $row1["net_total"]; ?></th>
              </tr>
              <tr>
                <th style="background-color:white;color:black;">Paid</th>
                <th style="text-align: center;"><?php echo $row1["amount_paid"]; ?></th>
              </tr>
              <tr>
                <th style="background-color:white;color:black;">Remaining</th>
                <th style="text-align: center;"><?php echo $row1["remaining"]; ?></th>
              </tr>
              <tr>
                <?php 
                    if ($row1["status"]=='Unpaid') {
                      $background_color='red  !important';

                    }
                    elseif($row1["status"]=='Partially'){
                         $background_color='#FAB61C !important';
                         $row1["status"]='Partially Paid';
                    }
                    elseif($row1["status"]=='Paid'){
                      $background_color='green  !important';
                    }
                ?>
                <th style="background-color:white;color:black;">Status</th>
                <th style="text-align: center;background-color:<?php echo $background_color;?>;color: white !important;"><?php echo $row1["status"]; ?></th>
              </tr>
              <tr style="border:none;" class="footer">
                <td colspan="2" style="border:0px !important;" class="footer">
                      <h4 style="text-align: center;background-color: #3C8DBC !important;padding:10px;color: white !important"><i>Thanks For Visting us!</i></h4>
                      <p style="text-align: center;">
                        <i>IT Consultancy Provoided By:</i>&nbsp;<b>Saif Ur Rehman</b><br>Contact #: +92 (308) 315 2045<br><b>Email: </b><i>saifrehman.6987@gmail.com</i>
                      </p>
                </td>
              </tr>
            </thead>
          </table>
        </div>
      </div>
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
  

  <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <div class="control-sidebar-bg"></div>
</div>

