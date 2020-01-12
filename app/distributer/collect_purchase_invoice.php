<?php include "../includes/header.php"; 
$id = $_GET["id"];
$sql_result =mysqli_query($con,"SELECT * FROM purchase_invoice WHERE id = '$id'");
 $row=mysqli_fetch_assoc($sql_result);
$distributer_id = $row['distributer_id'];

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-xs-12">
      <div class="row">
          <div class="col-md-2">
            
          </div>
          <div class="col-md-8">
            <div class="box" style="border-top:4px solid #3C8DBC">
              <div class="box-header">
                <h2 style="text-align: center"><b><i>Pay Purchase Invoice</i></b></h2>
                <hr style="border: 1px dashed">
                <br>

              </div>
                <!-- /.box-header -->
            <div class="box-body">
              <?php
                if(isset($_POST["update"])) {
                    $invoice_date = $_POST["transection_date"];
                    $paid_amount_now = $_POST["paid_amount_now"];
                    $paid_amount = $_POST["total_paid_amount"];
                    $remaining = $_POST["remaining"];
                    $status = $_POST["status"];
                    $created_at = date("y-m-d h:i:s");
                    $transection = mysqli_query($con,"INSERT INTO transection_details(type,invoice_id,transection_date,paid_amount,status,created_by,created_at) VALUES('purchase','$id','$invoice_date','$paid_amount_now','$status','$user','$created_at')");
                    $sql_update="UPDATE purchase_invoice SET amount_paid = '$paid_amount' , remaining = '$remaining' ,status = '$status' where id = '$id'";
                    $sql_update_result = mysqli_query($con,$sql_update);
                    if ($sql_update_result) {
                       $_SESSION["message"]="The Anount is Collected";
                      echo "<script> window.location='purchase_invoice_view-$distributer_id'</script>";
                    }
                }
              ?>    
              <form method="post">
                  <div class="row">
                  <div class="col-md-6 form-group">
                      <label>Transection Date</label>
                      <input type="date" name="transection_date" value="<?php echo date('Y-m-d'); ?>" placeholder="" class='form-control' >          
                    </div>    
                    <div class="col-md-6 form-group">
                      <label>Total Amount</label>
                      <input type="text" name="total_amount" value="<?php echo $row['total_amount']; ?>" placeholder="" class='form-control' readonly id='tp'>          
                    </div>                    
                  </div>       
                  <div class="row">
                  <div class="col-md-6 form-group">
                      <label>Discount</label>
                      
                      <input type="text" name="" value="<?php echo $row['discount']; ?>" placeholder="" class='form-control' onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 65 || event.charCode == 46) ? null : event.charCode >= 48 && event.charCode <= 57" id='disc' oninput="discountFun()" readonly>          
                    </div>
                    <div class="col-md-6 form-group">
                      <label>Net Total</label>
                      <input type="text" name="net_total" value="<?php echo $row['net_total']; ?>" placeholder="" class='form-control' readonly id='nt'>          
                    </div>                    
                  </div>  
                  <div class="row">
                  <div class="col-md-6 form-group">
                      <label>Paid Previous Amount</label>
                      
                      <input type="text" name="paid_amount" value="<?php echo $row['amount_paid']; ?>" placeholder="" class='form-control' onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 65 || event.charCode == 46) ? null : event.charCode >= 48 && event.charCode <= 57" id='paid' required readonly>         
                    </div>    
                    <div class="col-md-6">
                      <label>Paid Now</label>
                      <input type="text" name="paid_amount_now"  placeholder="" class='form-control' onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 65 || event.charCode == 46) ? null : event.charCode >= 48 && event.charCode <= 57" id='paid_now'  required autofocus>           
                    </div>              
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label>Total Paid Amount</label>
                      <input type="text" id="tpa" class="form-control" name="total_paid_amount" readonly>
                    </div>
                    <div class="col-md-6">
                      <label>Remaining</label>
                        <input type="" name="remaining" id="remaining" class="form-control" readonly="" value="<?php echo $row['remaining']; ?>">
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Status</label>
                    <input type="text" name="status" value="<?php echo $row['status']; ?>" id="status" placeholder="" class="form-control" readonly style="text-align:center;">
                      
                    
                    <br>
                    <div class="alert-danger glyphicon glyphicon-ban-circle" style="display: none; padding: 10px;text-align: center" id="alert">
                </div>
                    </div>
                  </div> 
                  <br>
                <div class="row">
                  <div class="col-md-6">
                    <a href="sale_invoice-<?php echo $row['customer_id']; ?>" class="btn btn-danger btn-block btn-flat"> <i class="fa fa-backward"></i> Back</a>
                  </div>
                  <div class="col-md-6">
                    <button class="btn btn-success btn-block btn-flat" id="insert" name="update" type="submit">
                    <i class="fa fa-money" ></i> Collect</button>

                  </div>
                </div>
                <div class=" col-md-2">
                  
                </div>
              </form>
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
  

  
  <div class="control-sidebar-bg"></div>
</div>
<script>
  $("#insert").attr("disabled", true);
  $('#paid_now').on('input',function(){
    $("#insert").attr("disabled", false);
    var paid_now = $('#paid_now').val()
    if(paid_now==null || paid_now==""){
      paid_now=0;
    }
   paid_now = parseInt(paid_now);
   var nt = parseInt($('#nt').val());
   var paid = parseInt($('#paid').val());
   var total_paid_amount = paid_now + paid;
   $('#tpa').val(total_paid_amount);
   var remaining = nt-total_paid_amount;
   $('#remaining').val(remaining);
   if (paid_now>nt) {
    $("#insert").attr("disabled", true);
    $('#alert').css("display","block");
    $('#alert').html("&ensp;Paid Amount can not be greater than Total Amount");
   }
   else{
    $("#insert").attr("disabled", false);
    $('#alert').css("display","none");
   }
   if(paid_now<nt){
    $('#status').val('Partially');
   }
   var remaining = parseInt($('#remaining').val());
    if(remaining==0){
    $('#status').val('Paid');
   }

  });

  
</script>
