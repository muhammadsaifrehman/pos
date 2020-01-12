<?php include "../includes/header.php"; 
$id = $_GET["id"];
$sql_result =mysqli_query($con,"SELECT * FROM sale_invoice WHERE sale_id = '$id'");
 $row=mysqli_fetch_assoc($sql_result);
$customer_id = $row['customer_id'];
$time = $row["created_at"];
$transection_record = "SELECT * FROM transection_details  where invoice_id= '$id' AND type='sale' AND created_at= '$time'";
$result_transection = mysqli_query($con,$transection_record);
$transection_row = mysqli_fetch_assoc($result_transection);
$transection_id =$transection_row["id"];


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
	              <h2 style="text-align: center">Update Sale Invoice</h2>
	              <hr style="border: 1px dashed ">
	              <br>

	            </div>
		            <!-- /.box-header -->
            <div class="box-body">
             
              <?php
                if (isset($_POST["update"])) {
                    $invoice_date = $_POST["invoice_date"];
                    $total_amount = $_POST["total_amount"];
                    $net_total = $_POST["net_total"];
                    $discount = $total_amount - $net_total;
                    $paid_amount = $_POST["paid_amount"];
                    $remaining = $_POST["remaining"];
                    $status = $_POST["status"];
                    $sql_update_transection = mysqli_query($con,"UPDATE transection_details SET transection_date='$invoice_date', paid_amount = '$paid_amount',status ='$status' WHERE id = '$transection_id'");
                    $sql_update="UPDATE sale_invoice SET invoice_date='$invoice_date', discount = '$discount', net_total = '$net_total',amount_paid = '$paid_amount' , remaining = '$remaining' ,status = '$status' where sale_id = '$id'";
                    $sql_update_result = mysqli_query($con,$sql_update);
                    if ($sql_update_result) {
                       $_SESSION["message"]="The Invoice is updated";
                      echo "<script> window.location='sale_invoice-$customer_id'</script>";
                    }
                }
              ?>    
              <form method="post">
              		<div class="row">
             			<div class="col-md-6 form-group">
   		 		           	<label>Invoice Date</label>
          		   			<input type="date" name="invoice_date" value="<?php echo $row['invoice_date']; ?>" placeholder="" class='form-control' onchange="disabledfalse()">  				
               			</div> 		
               			<div class="col-md-6 form-group">
   		 		           	<label>Total Amount</label>
          		   			<input type="text" name="total_amount" value="<?php echo $row['total_amount']; ?>" placeholder="" class='form-control' readonly id='tp'>  				
               			</div>              			
               		</div>       
               		<div class="row">
             			<div class="col-md-6 form-group">
   		 		           	<label>Discount</label>
   		 		           	<input type="radio" name="discount_check" id="amount" checked="" onclick="abc()">Amount
   		 		           	<input type="radio" name="discount_check" id="percentage" onclick="abc()">Percentage
          		   			<input type="text" name="" value="<?php echo $row['discount']; ?>" placeholder="" class='form-control' onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 65 || event.charCode == 46) ? null : event.charCode >= 48 && event.charCode <= 57" id='disc' oninput="discountFun()">  				
               			</div> 		
               			<div class="col-md-6 form-group">
   		 		           	<label>Net Total</label>
          		   			<input type="text" name="net_total" value="<?php echo $row['net_total']; ?>" placeholder="" class='form-control' readonly id='nt'>  				
               			</div>              			
               		</div>  
               		<div class="row">
             			<div class="col-md-6 form-group">
   		 		           	<label>Paid amount</label>
   		 		           	
          		   			<input type="text" name="paid_amount" value="<?php echo $row['amount_paid']; ?>" placeholder="" class='form-control' onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 65 || event.charCode == 46) ? null : event.charCode >= 48 && event.charCode <= 57" id='paid' oninput='cal_remaining()' required>  				
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
                    <i class="fa fa-edit" ></i> Update</button>

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
	function abc(){
		 $('#disc').val("");
    $('#disc').focus();
    var total = parseInt($('#tp').val());

    $('#nt').val(total);
    $('#remaining').val(total);
    var paid = $('#paid').val();
    if(paid==null || paid==""){
      paid=0;
    } 
    paid = parseInt(paid);
    //alert(net_total);
    remaining = total-paid;
    $('#remaining').val(remaining);

			
	} 
  function cal_remaining(){
        var paid = $('#paid').val();
        var nt = $('#nt').val();
        var remaining = nt - paid;
        $('#remaining').val(remaining); 
        if (remaining == 0) {
          $('#status').val('Paid');
        }

        else if (remaining == nt && paid <= 0) {
          $('#status').val('Unpaid');
        }        
        else if (paid > 0) {
          $('#status').val('Partially');
        }

        //$('#insert').show();
        //$("#insert").removeAttr("disabled");
        if (remaining < 0) {
          //$('#insert').hide();
          $("#insert").attr("disabled", true);
          $('#alert').css("display","block");
          $('#alert').html("&ensp;Paid Amount Cannot Be Greater Than Net Total");
        }else{
          $('#alert').css("display","none");
          $("#insert").removeAttr("disabled");
        }

      }
 function discountFun(){
        // Getting the value from the original price
       originalPrice = parseInt(document.getElementById("tp").value);

       disco = document.getElementById("disc").value;
       if (disco =="" || disco == null) {
              $('#nt').val(originalPrice);
              
              
          }else{      
        
          if(document.getElementById('percentage').checked)
              {
                
            discount = parseInt(document.getElementById("disc").value);
            
            discountReceived = parseInt((originalPrice*discount)/100);
            
            purchasePrice = originalPrice-discountReceived;
            $('#nt').val(purchasePrice);
            remaining=originalPrice-discountReceived-$('#paid').val();
            $('#remaining').val(remaining);
            // if($('#paid').val()!="" || $('#paid').val()!=null){
            //   remaining = purchasePrice-$('#paid').val();
            //   $('#remaining').val(remaining);
            // }

              
            }
            else if(document.getElementById('amount').checked)
            {
              
            discount = parseInt(document.getElementById("disc").value);


            purchasePrice = originalPrice - discount;
            //alert(purchasePrice);
              //discountReceived = discount;
             $('#nt').val(purchasePrice);
             remaining = purchasePrice-$('#paid').val();
             $('#remaining').val(remaining);
             
            //  if($('#paid').val()!="" || $('#paid').val()!=null){
            //   remaining = purchasePrice-$('#paid').val();
            //   $('#remaining').val(remaining);
            // }
            }
            //$('#insert').show(); 
            //$("#insert").removeAttr("disabled");
            if (purchasePrice < 0) {
              //$('#insert').hide();
              $("#insert").attr("disabled", true);
              $('#alert').css("display","block");
              $('#alert').html("&ensp;Discount Cannot Be Greater Than Total Amount");
            }else{
              $('#alert').css("display","none");
              $("#insert").removeAttr("disabled");
            }
            // $('#paid').val(""); 
            //$('#remaining').val(purchasePrice);
      }
      }
      function disabledfalse(){
         $("#insert").removeAttr("disabled");
      }
  

  
</script>
