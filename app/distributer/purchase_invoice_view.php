<?php include "../includes/header.php"; ?>

<?php 
	$id=$_GET["id"];
  // Fetching the data of the customer 
	$sql= "SELECT * FROM distributer WHERE id='$id'";
	$result= mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);

	  $sql_paid_invoice = "SELECT * FROM purchase_invoice WHERE distributer_id = '$id' AND status = 'Paid'";
  $result_paid_invoice = mysqli_query($con,$sql_paid_invoice);
  $count_paid_invice = mysqli_num_rows($result_paid_invoice);
  // Fetch data of the debit and unpaid invoice
  $sql_debit_invoice = "SELECT * FROM purchase_invoice WHERE distributer_id='$id' AND (status = 'Unpaid' OR status = 'Partially')";
  $result_debit_invoice = mysqli_query($con,$sql_debit_invoice);
  $count_debit_invice = mysqli_num_rows($result_debit_invoice);
  $debit_Sum=0;

$query_money="SELECT remaining FROM purchase_invoice WHERE status = 'Unpaid' AND distributer_id= '$id' OR status = 'Partially' AND distributer_id= '$id'";
$result_debit_money = mysqli_query($con,$query_money);
 while($row_debit = mysqli_fetch_assoc($result_debit_money)){
$debit_Sum  = $debit_Sum + $row_debit["remaining"];
 }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Distributer Invoice Record</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Distributer Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-9">
      <div class="box box-success">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6" style="margin-top:0px">
              <p style="color:#3C8DBC;font-size:1.3em;"><label style="color: #000000;">Distributer:&ensp;</label><b><i><?php echo $row["name"]; ?></i></b></p>
            </div>
            <div class="col-md-2" style="margin-top: 10px">
              <label style="float: right;">Date:</label>
            </div>  
            <div class="col-md-4" style="margin-top: 10px">
                <input type="date" name="invoice_date"  class="form-control" id="invoice_date" value="<?php echo date('Y-m-d'); ?>" style="margin-top: -6px;"> 
               <!--  <?php echo $debit_Sum; ?> -->     
            </div>
          </div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#invoice" data-toggle="tab">New Invoice</a>
              </li>
              
              <li><a href="#paidd" data-toggle="tab">Paid Invoices <span class="badge"><?php echo $count_paid_invice ?></span></a></li>
              <li><a href="#debit" data-toggle="tab">debit <span class="badge"><?php echo $count_debit_invice; ?></span></a></li>
              
              <!-- <li><a href="#details" data-toggle="tab">Account Details</a></li> -->
            </ul>
            <div class="tab-content" style="background-color: #efefef;">
              <div class="active tab-pane" id="invoice">
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="container-fluid" style="margin-bottom:8px;">
                    	<div class="row">
		                  <?php session_message(); ?>
		              <?php error_message(); ?>
		                  <div class="col-md-3">
		                    
		                  </div>
		                  <div class="col-md-6">
		                    <div class="alert-success fa fa-check" style="display: none;padding: 10px;text-align: center" id="alert_success">

		                </div>
		                  </div>
		                </div>
                   
              	<div id="barcode_div">
              		
              	
                <div class="row">
                  <?php session_message(); ?>
              	  
                 <div class="col-md-4">
                 	<label>Product Name</label>
                 	<select class="form-control" name="product_name" placeholder="Product Name" required="" id="product_name">
                  <option value="">Select Product</option>
                  <?php 
                  $result     = mysqli_query($con,"SELECT * FROM products");
                  while ($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['product_name']; ?></option>
                  <?php }?>
                </select>
                <input type="hidden"  id="fetch_product_name">
                 </div>
                 <div class="col-md-4">
                 	<label>Expiry Start</label>
                 	<input type="date" name="expiry_start_date"  class="form-control" id="expiry_start_date">
                 </div>
                 <div class="col-md-4">
                 	<label>Expiry End</label>
                 	<input type="date" name="expiry_end_date"  class="form-control" id="expiry_end_date">
                 </div>
                 
                 
            </div>
            <div class="row">
            	<div class="col-md-4">
                 	<label> Original Price</label>
                 	 <input type="text" name=""   class="form-control" id="original_price" placeholder="Original Price of the product" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                 </div>
            	<div class="col-md-4">
                  <label> Discount </label> 
                  <input type="text" id="discount" class="form-control"  value="0">
                </div>
            	<div class="col-md-4">
            		<label>Purchase Price</label>
            		 <input type="text" id="purchase_price" class="form-control" readonly="">
            	</div>
            	
            	
            </div>
            <div class="row">
            	<div class="col-md-4">
            		
                  <label> Sale Price </label>
                    <input type="text" id="sale_price" class="form-control" placeholder="Sale Price of the product" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
            	</div>
            	<div class="col-md-4">
            		
                  <label>Status</label>
                    <select name="" class="form-control" id="statuss">
                    <option value="available">Available</option>
                   
                  </select>
            	</div>
            	<div class="col-md-4">

 					<label> IMEI NO: </label>
                	<input type="text" id="imei" class="form-control" placeholder="IMEI No" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                </div>
            </div>
            </div>  
              <div class="row" id="mydata" style="display: none" >
              	<div class="col-md-12" >
                  <div class="table-responsive">
              		<table class="table table-responsive table-hover table-bordered" id="myTableData">
              			
                      <thead>
                      <tr>
                        <th>Sr #</th>
                        <th>Product Name</th>
                        <th>Exp Start</th>
                        <th> Exp End</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>BarCode</th>
                        <th>Delete </th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                   
              		</table>
                   </div>
              	</div>
              </div>
            
                      
                    </div>
                  </div>
                </div> 			
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="paidd">
                  <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-info" style="vertical-align: middle; margin-bottom: 25px !important;">Paid Invoices Details</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">                      
                        <table class="table table-bordered table-striped">
                            <thead style="background-color: #367FA9;color:white;">
                                <tr>
                                    <th class="t-cen" style="vertical-align:middle;">Sr #</th>
                                    <!-- <th class="t-cen" style="vertical-align:middle; width: 100px;">Invoice #</th> -->
                                    <th class="t-cen" style="vertical-align:middle;">Transection Date</th>
                                    <th class="t-cen" style="vertical-align:middle;">Amount</th>
                                    <th class="text-center" style="vertical-align:middle;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $i = 1;
                                while ($paid_invoice_data = mysqli_fetch_assoc($result_paid_invoice)) {?>
                                    <tr>
                                      <td><?php echo $i ?></td>
                                      <td><?php echo $paid_invoice_data['invoice_date'] ?></td>
                                      <td><?php echo $paid_invoice_data['total_amount'] ?></td>
                                      <td style="text-align: center">
                                        <a href="purchase_invoice_details-<?php echo $paid_invoice_data['id']; ?>" class="btn btn-warning btn-xs"> <i class="fa fa-eye"></i> view</a>
                                        
                                        <a href="transection_details-<?php echo $paid_invoice_data['id']; ?>" class="btn btn-success btn-xs"> <i class="fa fa-money"></i> Transection Detail</a>
                                        <a href="product_per_purchase_invoice-<?php echo $paid_invoice_data['id']; ?>" class="btn btn-primary btn-xs"> <i class="fa fa-eye"></i>View Product</a>
                                      </td>
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
              </div>
              <div class="tab-pane" id="debit">
                  <div class="row">
                    <div class="col-md-8">
                        <h3 class="text-info" style="vertical-align: middle;">Partially & Unpaid Invoices Details</h3>
                    </div>
                      <div class="col-md-4">
                        <h3 class="text-danger" style="vertical-align: middle; margin-bottom: 20px !important;background-color: white;padding: 6px;border-radius: 3px;">Total Debits: <?php echo $debit_Sum; ?></h3>
                    </div>
                </div>
                <div class="row">
                      
                       
                <div class="col-md-12">
                        <div class="table-responsive">                      
                        <table class="table table-bordered table-striped">
                            <thead style="background-color: #367FA9;color:white;">
                                <tr>
                                    <th class="t-cen" style="vertical-align:middle;">Sr #</th>
                                    <!-- <th class="t-cen" style="vertical-align:middle; width: 100px;">Invoice #</th> -->
                                    <th class="t-cen" style="vertical-align:middle;">Transection Date</th>
                                    <th class="t-cen" style="vertical-align:middle;">Total Amount</th>
                                    <th class="t-cen" style="vertical-align:middle;">Discount</th>
                                    <th class="t-cen" style="vertical-align:middle;">Paid Amount</th>
                                    <th class="t-cen" style="vertical-align:middle;">Remaining</th>
                                    <th class="t-cen" style="vertical-align:middle;">Status</th>
                                    <th class="text-center" style="vertical-align:middle;">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $j = 1;
                                while ($debit_invoice_data = mysqli_fetch_assoc($result_debit_invoice)) {
                                  if ($debit_invoice_data['status'] =='Unpaid') {
                                   $label = 'label label-danger';
                                  }
                                  elseif($debit_invoice_data['status'] =='Partially'){
                                   $label = 'label label-warning'; 
                                  }
                               
                                  ?>
                                    <tr>
                                      <td><?php echo $j; ?></td>
                                      <td><?php echo $debit_invoice_data['invoice_date'] ?></td>
                                      <td><?php echo $debit_invoice_data['total_amount']; ?></td>
                                      <td><?php echo $debit_invoice_data['discount']; ?></td>
                                      <td><?php echo $debit_invoice_data['amount_paid']; ?></td>
                                      <td><?php echo $debit_invoice_data['remaining'];?></td>
                                      <td><span class="<?php echo $label; ?>"><?php echo $debit_invoice_data['status'] ?></span></td>
                                      <td style="text-align: center">
                                        <a href="purchase_invoice_details-<?php echo $debit_invoice_data['id']; ?>" class="btn btn-warning btn-xs" title="View"> <i class="fa fa-eye"></i></a>
                                        
                                        <a href="collect_purchase_invoice-<?php echo $debit_invoice_data['id']; ?>" class="btn btn-success btn-xs" title="Collect"> <i class="fa fa-money"></i></a>
                                      </td>
                                    </tr>
                                <?php
                                $j++;
                              }

                              ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                  </div>
              </div>
              
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
      </div>
    </div>
		<div class="col-md-3" id="bill_form" style="display: none;">
      <div class="box box-primary">
        <div class="box-body">
          <div class="container-fluid" style="margin-bottom:8px;">
            <div class="row">
              <div class="col-md-12" style="padding:10px;text-align: center;font-weight: bolder;font-size:20px;background-color: #3C8DBC;color:white;">
                Bill
              </div>
            </div>
          </div>
          <div class="row" >
            <div class="col-md-12">
         
                <div class="form-group">
                  <label>Total Amount</label>
                  <input type="text" name="total_amount" class="form-control" readonly="" id="tp" value="0">
                </div>
                <div class="form-group">
          <label>Discount</label>

            <input type="radio" name="discountType" id="amount" checked onclick="abc()"> Amount
            <input type="radio" name="discountType" id="percentage" onclick="abc()"> Percent
          <input type="text" name="discount" class="form-control" id="disc" value="0" oninput="discountFun()" onkeypress="check_only_number()">

        </div>
                <div class="form-group">
                  <label>Net Total</label>
                  <input type="text" name="net_total" class="form-control" id="nt"readonly="">
                </div>
                <div class="form-group">
                  <label>Paid</label>
                  <input type="text" name="paid" class="form-control"  id="paid" value="0" oninput="cal_remaining()">
                </div>
                <div class="form-group">
                  <label>Remaining</label>
                  <input type="text" name="remain" class="form-control" readonly="" id="remaining"> 
                </div>
                <div class="form-group">
                  <label>status</label>
                  <input type="text" name="status" class="form-control" readonly="" id="status">
                </div>
                <div class="alert-danger glyphicon glyphicon-ban-circle" style="display: none; padding: 10px;" id="alert">
                </div>
                <hr>
                <button class="btn btn-success btn-block btn-flat" id="insert" >
                  <i class="glyphicon glyphicon-plus" ></i> Add Bill</button>
              
            </div>
          </div>
        </div>
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
  <div class="control-sidebar-bg"></div>
</div>
<script>
	 function abc(){
    $('#disc').val("");
    $('#disc').focus();
    var total = $('#tp').val();
    $('#nt').val(total);
    $('#remaining').val(total);
    $('#paid').val("");
     
  }
   function check_only_number(){
  return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 65 || event.charCode == 46) ? null : event.charCode >= 48 && event.charCode <= 57;
  }
	let productIdArr = new Array();
    let productNameArr = new Array();
    let expStartingArr = new Array();
    let expEndingArr = new Array();
    let originalPriceArr = new Array();
    let discountArr = new Array();
    let purchasePriceArr = new Array();
    let salePriceArr = new Array();
    let statusArr = new Array();
    let imeiArr = new Array();
    let distributer_id = <?php echo $id; ?>;
    function deleteRecord(index){
    
    var row_index =index.parentNode.parentNode.rowIndex;
    confirmation=confirm("Are you sure to delete this record");
    if (confirmation==true) {
          a=imeiArr.length-row_index;
          document.getElementById("myTableData").deleteRow(row_index);
          alert(imeiArr);
          var total_amount = Number($('#tp').val());
          var purchase_value =Number(purchasePriceArr[a]);
          var net = total_amount - purchase_value;
          $('#tp').val(net);
          $('#nt').val(net);
          $('#remaining').val(net);
          productIdArr.splice(a,1);
      productNameArr.splice(a,1);
      expStartingArr.splice(a,1);
      expEndingArr.splice(a,1);
      originalPriceArr.splice(a,1);
      discountArr.splice(a,1);
      purchasePriceArr.splice(a,1);
      salePriceArr.splice(a,1);
      statusArr.splice(a,1);
      imeiArr.splice(a,1);
      if (discountArr.length==0) {
            $('#bill_form').hide();
            $('#mydata').hide();
            $('#product_name').val("");
        $('#expiry_start_date').val("");
        $('#expiry_end_date').val("");
        $('#original_price').val("");
        $('#purchase_price').val("");
        $('#sale_price').val("");
        $('#statuss').val("");
        $('#imei').val("");
        }
    }
    
  }
    $('#original_price').on('input',function(){
    	$('#purchase_price').val($('#original_price').val());
	});	
	$('#discount').on('input',function(){
		    var purchase = parseInt($('#original_price').val());
		    var discount = $('#discount').val();
		    if (discount=="" || discount==null) {
		      discount=0;
		    }
		    var discount = parseInt(discount);

		    if (discount>purchase) {
		      alert('The discount can not be greater than the original price');
		      $('#discount').val('');
		      $('#discount').css("border","1px solid red");
		      $('#purchase_price').val(purchase);
		    }
		    else{
		      var sale_price = purchase-discount;
		      //alert(sale_price);
		      $('#purchase_price').val(sale_price);
		    }
		});
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
              $('#remaining').val(originalPrice);
              $('#paid').val("");
          }else{      
        
          if(document.getElementById('percentage').checked)
              {
                
            discount = parseInt(document.getElementById("disc").value);
            
            discountReceived = parseInt((originalPrice*discount)/100);
            
            purchasePrice = originalPrice-discountReceived;
            $('#nt').val(purchasePrice);
            if($('#paid').val()!="" || $('#paid').val()!=null){
              remaining = purchasePrice-$('#paid').val();
              $('#remaining').val(remaining);
            }

              
            }
            else if(document.getElementById('amount').checked)
            {
              
            discount = parseInt(document.getElementById("disc").value);


            purchasePrice = originalPrice - discount;
            //alert(purchasePrice);
              //discountReceived = discount;
             $('#nt').val(purchasePrice);
             
             if($('#paid').val()!="" || $('#paid').val()!=null){
              remaining = purchasePrice-$('#paid').val();
              $('#remaining').val(remaining);
            }
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
            $('#paid').val(""); 
            $('#remaining').val(purchasePrice);
      }
      }
    $(document).ready(function(){
      	// function On chage of the Product Name  
      	$('#product_name').change(function(){
      		var productId = $('#product_name').val();
      		$.ajax({
		        type:'post',
        		data:{productId:productId},
        		url: "fetch_product_name.php",
				success: function(result){
        			data=$.parseJSON(result);
        			var fee = data["product_name"];
					$('#fetch_product_name').val(fee);
        		}         
    		});
        });
        
        $('#imei').change(function(){
        	var product_name = $('#product_name').val();
	        var exp_start_date = $('#expiry_start_date').val();
	        var exp_end_date = $('#expiry_end_date').val();
	        var original_price = $('#original_price').val();
	        var purchase_price = $('#purchase_price').val();
	        var discount = original_price-purchase_price;
	        
	        var sale_price = $('#sale_price').val();
	        var statuss = $('#statuss').val();
	        var imei = $('#imei').val();
	        var  fetch_product_name= $('#fetch_product_name').val();  
	         if (product_name==null || product_name=='') {
	          alert("Please Select the product");
	        }
	        else if (exp_start_date==null || exp_start_date=='') {
	          alert("The Expiry Starting Date is required");
	        }
	        else if (exp_end_date==null || exp_end_date=='') {
	          alert("The Expiry Ending Date is required");
	        }
	        else if (original_price==null || original_price=='') {
	          alert("The Original Price is required");
	        }
	        else if (sale_price==null || sale_price=='') {
	          alert("The Sale Price is required");
	        }
	        else if (imei==null || imei=='') {
	          alert("The IMEI no is required");
	        }
	        else{
	        	productIdArr.push(product_name);

	            expStartingArr.push(exp_start_date);
    	        expEndingArr.push(exp_end_date);
        	    originalPriceArr.push(original_price);
            	discountArr.push(discount);
        	    purchasePriceArr.push(purchase_price);
            	salePriceArr.push(sale_price);
            	statusArr.push(statuss);
            	imeiArr.push(imei);
          
      // Show the inserted data in the table
	           $("#mydata").show();
	           let table = document.getElementById("myTableData");
          
          //count the table row
          		let rowCount = table.rows.length;
          
          //insert the new row
          		let row = table.insertRow(1);
          
          //insert the coulmn against the row
		        row.insertCell(0).innerHTML= rowCount;
		        row.insertCell(1).innerHTML= fetch_product_name;
		        row.insertCell(2).innerHTML= exp_start_date;
		        row.insertCell(3).innerHTML= exp_end_date;
		        row.insertCell(4).innerHTML= purchase_price;
		        row.insertCell(5).innerHTML= sale_price;     
		        row.insertCell(6).innerHTML= imei;
		        row.insertCell(7).innerHTML="<button class='btn btn-danger' onclick='deleteRecord(this)'><i class='fa fa-trash'></i> Delete</button>";
		        $("#imei").val('');
		        $("#imei").focus();
		        $('#mydata').show();
		        $('#bill_form').show();
		        net_total =Number($('#tp').val());
		        purchase_price = Number(purchase_price);
		        net_total = net_total + purchase_price;
		        $('#tp').val(net_total);
		        $('#nt').val(net_total);
		        $('#remaining').val(net_total);
		        $('#status').val('Unpaid');
		    }
	        
        });

    });
    $(document).ready(function(){
    	$('#insert').click(function(){
      var total_amount = $('#tp').val();
      var net_total = $('#nt').val();
      var paid = $('#paid').val();
      var remaining = $('#remaining').val();
      var invoice_status = $('#status').val();
      var invoice_date = $('#invoice_date').val();
      
         $.ajax({
        type:'post',
        data:{
              distributer_id:distributer_id,
              total_amount:total_amount,
              net_total:net_total,
              invoice_date:invoice_date,
              paid:paid,
              remaining:remaining,
              invoice_status:invoice_status,
                productIdArr:productIdArr,
                expStartingArr:expStartingArr,
                expEndingArr:expEndingArr,
                originalPriceArr:originalPriceArr,
                discountArr:discountArr,
                purchasePriceArr:purchasePriceArr,
                salePriceArr:salePriceArr,
                statusArr:statusArr,
                imeiArr:imeiArr
            },
        url: "fetch_product_name.php",

        success: function(result){
        data=$.parseJSON(result);	
        if (data== true) {
              $('#barcode_div').hide();
              $('#mydata').hide();
              $('#bill_form').hide();
              
              $('#alert_success').css("display","block");
              $('#alert_success').html("&ensp;The invoice is generated");
               $('#alert_success').fadeIn(function(){
               $('#alert_success').delay(3000).fadeOut(); 
                
            });
               $('#alert_success').fadeOut(function(){
                window.location='purchase_invoice_view-'+distributer_id;
               })
              
            }
        }         
    });

    });
    });
		

</script>