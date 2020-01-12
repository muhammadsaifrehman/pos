<?php include "../includes/header.php"; ?>

<?php 
	$id=$_GET["id"];
  // Fetching the data of the customer 
	$sql= "SELECT * FROM customers WHERE id='$id'";
	$result= mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
  // Fetching data of the customer paid invoices
  $sql_paid_invoice = "SELECT * FROM sale_invoice WHERE customer_id = '$id' AND status = 'Paid'";
  $result_paid_invoice = mysqli_query($con,$sql_paid_invoice);
  $count_paid_invice = mysqli_num_rows($result_paid_invoice);
  // Fetch data of the Credit and unpaid invoice
  $sql_credit_invoice = "SELECT * FROM sale_invoice WHERE customer_id = '$id' AND (status = 'Unpaid' OR status = 'Partially')";
  $result_credit_invoice = mysqli_query($con,$sql_credit_invoice);
  $count_credit_invice = mysqli_num_rows($result_credit_invoice);
  $credit_Sum=0;
  $result_credit_money = mysqli_query($con,"SELECT remaining FROM sale_invoice WHERE customer_id = '$id' AND (status = 'Unpaid' OR status = 'Partially')");
 while($row_credit = mysqli_fetch_assoc($result_credit_money)){
$credit_Sum += $row_credit["remaining"];
}
 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Customer Invoice Record</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer Record</li>
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
              <p style="color:#3C8DBC;font-size:1.3em;"><label style="color: #000000;">Customer:&ensp;</label><b><i><?php echo $row["name"]; ?></i></b></p>
            </div>
            <div class="col-md-2" style="margin-top: 10px">
              <label style="float: right;">Date:</label>
            </div>  
            <div class="col-md-4" style="margin-top: 10px">
                <input type="date" name="invoice_date"  class="form-control" id="invoice_date" value="<?php echo date('Y-m-d'); ?>" style="margin-top: -6px;">      
            </div>
          </div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#invoice" data-toggle="tab">New Invoice</a>
              </li>
              
              <li><a href="#paidd" data-toggle="tab">Paid Invoices <span class="badge"><?php echo $count_paid_invice ?></span></a></li>
              <li><a href="#credit" data-toggle="tab">Credit <span class="badge"><?php echo $count_credit_invice; ?></span></a></li>
              
              <!-- <li><a href="#details" data-toggle="tab">Account Details</a></li> -->
            </ul>
            <div class="tab-content" style="background-color: #efefef;">
              <div class="active tab-pane" id="invoice">
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="container-fluid" style="margin-bottom:8px;">
                     <div class="row" id="barcode_div">
              	<div class="col-md-2">
              	
              	</div>
              	<div class="col-md-1" style="margin-top: 7px">
              		<label>BarCode: </label>
              	</div>
              	<div class="col-md-4">
              		<input type="text" class="form-control" id="barcode" autofocus="">
              	</div>
              </div>
              
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
                        <th>Sale Price</th>
                        <th>Discount</th>
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
                                      <td><?php echo $paid_invoice_data['net_total'] ?></td>
                                      <td style="text-align: center">
                                        <a href="sale_invoice_details-<?php echo $paid_invoice_data['sale_id']; ?>" class="btn btn-warning btn-xs"> <i class="fa fa-eye"></i> view</a>
                                       <!--  <a href="update_sale_invoice-<?php echo $paid_invoice_data['sale_id']; ?>" class="btn btn-info btn-xs" style="margin:0px 10px 0px 10px;"> <i class="fa fa-edit"></i> Update</a> -->
                                        <a href="transecrtion_details-<?php echo $paid_invoice_data['sale_id']; ?>" class="btn btn-success btn-xs"> <i class="fa fa-money"></i> Transection Detail</a>
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
              <div class="tab-pane" id="credit">
                  <div class="row">
                    <div class="col-md-8">
                        <h3 class="text-info" style="vertical-align: middle;">Partially & Unpaid Invoices Details</h3>
                    </div>
                      <div class="col-md-4">
                        <h3 class="text-danger" style="vertical-align: middle; margin-bottom: 20px !important;background-color: white;padding: 6px;border-radius: 3px;">Total Credit: <?php echo $credit_Sum; ?></h3>
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
                                while ($credit_invoice_data = mysqli_fetch_assoc($result_credit_invoice)) {
                                  if ($credit_invoice_data['status'] =='Unpaid') {
                                   $label = 'label label-danger';
                                  }
                                  elseif($credit_invoice_data['status'] =='Partially'){
                                   $label = 'label label-warning'; 
                                  }
                                 
                                  ?>
                                    <tr>
                                      <td><?php echo $j; ?></td>
                                      <td><?php echo $credit_invoice_data['invoice_date'] ?></td>
                                      <td><?php echo $credit_invoice_data['total_amount'] ?></td>
                                      <td><?php echo $credit_invoice_data['discount'] ?></td>
                                      <td><?php echo $credit_invoice_data['amount_paid'] ?></td>
                                      <td><?php echo $credit_invoice_data['remaining'] ?></td>
                                      <td><span class="<?php echo $label; ?>"><?php echo $credit_invoice_data['status'] ?></span></td>
                                      <td style="text-align: center">
                                        <a href="sale_invoice_details-<?php echo $credit_invoice_data['sale_id']; ?>" class="btn btn-warning btn-xs" title="View"> <i class="fa fa-eye"></i></a>
                                        <!-- <a href="update_sale_invoice-<?php echo $credit_invoice_data['sale_id']; ?>" class="btn btn-info btn-xs" title="Update"> <i class="fa fa-pencil" ></i></a> -->
                                        <a href="collect_sale_invoice-<?php echo $credit_invoice_data['sale_id']; ?>" class="btn btn-success btn-xs" title="Collect"> <i class="fa fa-money"></i></a>
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
	let productIdArr  	= new Array();
	let imeiArr 		= new Array();
	let discountArr 	= new Array();
	let salepriceArr 	= new Array();
  let discount_per_product = new Array();
	let total_amount,net_total;
  var customer_id = <?php echo $id; ?>;
	function discountValue(value,index){
    var row_index=index.parentNode.parentNode.rowIndex;
    array_index=imeiArr.length-row_index;
    value= Number(value);
    alert
    let net_amount =0;
    let net_discount =0;
    array_value = Number(salepriceArr[array_index]);
   // alert(array_value);
    // alert(value);
    discountArr[array_index] = value;
    for(var i=0;i<salepriceArr.length;i++){
      if(salepriceArr[i]<discountArr[i]){
        var a=1;
      }
     
      
      net_amount = parseInt(net_amount) +parseInt(salepriceArr[i]); 
      
      net_discount = parseInt(discountArr[i])+parseInt(net_discount);
      

    }
    net_total = net_amount-net_discount;
    //alert(net_total);
    $('#nt').val(net_total);
    $('#tp').val(net_total);
    
    if (a==1) {
        $("#insert").attr("disabled", true);
          $('#alert').css("display","block");
          $('#alert').html("&ensp;Discount per item can not be greater than original price");
      }
      else{
        $('#alert').css("display","none");
        $("#insert").attr("disabled", false);
      }
    
	}
	function deleteRecord(index,abc){
		
		var row_index =index.parentNode.parentNode.rowIndex;
		confirmation=confirm("Are you sure to delete this record");
		if (confirmation==true) {			//var  = document.getElementById('myTableData').a.cells[2].innerHTML;
			
      // Getting the index of the array
      a=imeiArr.length-row_index;
      //alert(imeiArr);
			document.getElementById("myTableData").deleteRow(row_index);
      var net_total = Number(document.getElementById('tp').value);
      discount_value = Number(discountArr[a]);
      original_price = Number(salepriceArr[a]);
      net_total = net_total - salepriceArr[a] +discount_value
			//alert(net_total);
      $('#tp').val(net_total);
      productIdArr.splice(a,1);
      salepriceArr.splice(a,1);
      imeiArr.splice(a,1);
      discountArr.splice(a,1);
      if (discountArr.length==0) {
        $('#bill_form').hide();
        $('#mydata').hide();

      }

		}
		
	}
  function check_only_number(){
  return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 65 || event.charCode == 46) ? null : event.charCode >= 48 && event.charCode <= 57;
  }
  function abc(){
    $('#disc').val("");
    $('#disc').focus();
    var total = $('#tp').val();
    $('#nt').val(total);
    $('#remaining').val(total);
    $('#paid').val("");
     
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
		$('#barcode').change(function(){
			var barcode = $('#barcode').val();
			$.ajax({
		        type:'post',
		        data:{barcode:barcode},
		        url: "fetch_product_data.php",

		        success: function(result){
		        data=$.parseJSON(result);
            if(data==null){
              alert("The Product against this barcode does not exist");
              $('#barcode').val("");
              $('#barcode').focus();
            }
            else if(data['status']=='sold'){
              alert("The Product of this barcode is sold");
              $('#barcode').val("");
              $('#barcode').focus();
            }
            else{
              var product_name = data["product_name"];

              var product_id = data["id"];
              var exp_start_date = data["expiry_starting_date"];
              var exp_end_date  = data["expiry_ending_date"];
              var sale_price =data["sale_price"];
              var imei = data["imei"];
              let table = document.getElementById("myTableData");
                
              // Pushing the data in the array
              productIdArr.push(product_id);
              salepriceArr.push(sale_price);
              imeiArr.push(imei);
                discountArr.push(0);
              //count the table row
              let rowCount = table.rows.length;
              
              //insert the new row
              let row = table.insertRow(1);
              
              //insert the column against the row
              row.insertCell(0).innerHTML= rowCount;
              row.insertCell(1).innerHTML= product_name;
              row.insertCell(2).innerHTML= exp_start_date;
              row.insertCell(3).innerHTML= exp_end_date;
              row.insertCell(4).innerHTML=sale_price;  
          row.insertCell(5).innerHTML= "<input type='text' class='form-control' oninput='discountValue(this.value,this);' value='0' > "; ;
          row.insertCell(6).innerHTML= imei;
          row.insertCell(7).innerHTML="<button class='btn btn-danger' onclick='deleteRecord(this)'>Delete</button>";
          //alert(discountArr);
          net_total =Number($('#tp').val());
          sale_price = Number(sale_price);
          net_total = net_total + sale_price;
          $('#tp').val(net_total);
          $('#nt').val(net_total);
          $('#remaining').val(net_total);
          $('#paid').val(0);
          $('#status').val('Unpaid');
          $('#barcode').val("");
          $('#barcode').focus();
          $('#bill_form').show();
          $('#mydata').show();


            }

          }         
		    });


		});
    $('#insert').click(function(){
      var confirmation = confirm('Are You sure to generate the bill');
      if(confirmation == true){
      customer_id;
      var total_amount = $('#tp').val();
      var net_total = $('#nt').val();
      var paid_amount = $('#paid').val();
      var remaining = $('#remaining').val();
      var status = $('#status').val();
      var invoice_date  = $('#invoice_date').val();
      productIdArr;
      salepriceArr;
      imeiArr;
      discountArr;
      $.ajax({
            type:'post',
            data:{
              customer_id:customer_id,
              total_amount:total_amount,
              net_total:net_total,
              paid_amount:paid_amount,
              remaining:remaining,
              status:status,
              productIdArr:productIdArr,
              salepriceArr:salepriceArr,
              imeiArr:imeiArr,
              invoice_date:invoice_date,
              discountArr:discountArr
            },
            url: "fetch_product_data.php",

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
                window.location='sale_invoice-'+customer_id;
               })
              
            }
          }
        });
      }

      

    });

	});
</script>