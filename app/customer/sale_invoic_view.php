<?php include "../includes/header.php"; ?>

<?php 
	$id=$_GET["id"]; 
	$sql= "SELECT * FROM customers WHERE id='$id'";
	$result= mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);

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
      <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6" style="margin-top:0px">
              <p style="color:#3C8DBC;font-size:1.3em;"><label style="color: #000000;">Customer:&ensp;</label><b><i><?php echo $row["name"]; ?></i></b></p>
            </div>
            <div class="col-md-2" style="margin-top: 10px">
              <label style="float: right;">Date:</label>
            </div>  
            <div class="col-md-4" style="margin-top: 10px">
                <input type="date" name="invoice_date"  class="form-control" id="invoice_date" value="2019-10-30" style="margin-top: -6px;">      
            </div>
          </div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#invoice" data-toggle="tab">New Invoice</a>
              </li>
              
              <li><a href="#paidd" data-toggle="tab">Paid Invoices <span class="badge">4</span></a></li>
              <li><a href="#credit" data-toggle="tab">Credit <span class="badge">4</span></a></li>
              <li><a href="#customer" data-toggle="tab">Customer Profile</a></li>
              <li><a href="#customer_vehicles" data-toggle="tab">Customer Vehicles</a></li>
              <!-- <li><a href="#details" data-toggle="tab">Account Details</a></li> -->
            </ul>
            <div class="tab-content" style="background-color: #efefef;">
              <div class="active tab-pane" id="invoice">
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="container-fluid" style="margin-bottom:8px;">
                     <div class="row">
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
              	<div class="col-md-12">
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
                        <h3 class="text-danger" style="vertical-align: middle; margin-bottom: 20px !important;background-color: white;padding: 6px;border-radius: 3px;">Total Credit: 29120</h3>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        	
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
		<div class="col-md-3" id="bill_form" >
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

          <input type="hidden" id="name" >
          <input type="hidden" id="vehicle_name" >
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
	let total_amount,net_total;
	function discountValue(value,index){
    alert($('#discount_amount[1]').val());
		value = Number(value);
		var row_index=index.parentNode.parentNode.rowIndex;
    array_index=imeiArr.length-row_index;
    if (value>salepriceArr[array_index]) {
      alert("Please Enter the valid amount");
      $('#discount_amount[row_index]').val();
    }
    var net_total = Number(document.getElementById('tp').value);
    net_total = net_total-value;
    $('#tp').val(net_total);
    //alert(discountArr);
    discountArr[array_index] = value;
    // alert(discountArr);
		
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
      //alert(net_total);
      net_total = net_total - salepriceArr[a] +discountArr[a];
			//alert(net_total);
      $('#tp').val(net_total);
      productIdArr.splice(a,1);
      salepriceArr.splice(a,1);
      imeiArr.splice(a,1);
      discountArr.splice(a,1);
      //alert(imeiArr);

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
        		var product_name = data["product_name"];
        		var product_id = data["product_id"];
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
		          
		          //insert the coulmn against the row
		          row.insertCell(0).innerHTML= rowCount;
		          row.insertCell(1).innerHTML= product_name;
		          row.insertCell(2).innerHTML= exp_start_date;
		          row.insertCell(3).innerHTML= exp_end_date;
		          row.insertCell(4).innerHTML=sale_price;  
					row.insertCell(5).innerHTML= "<input type='text' class='form-control' oninput='discountValue(this.value,this);' value='0' id='discount_amount[]'> "; ;
					row.insertCell(6).innerHTML= imei;
					row.insertCell(7).innerHTML="<button class='btn btn-danger' onclick='deleteRecord(this)'>Delete</button>";
					//alert(discountArr);
					net_total =Number($('#tp').val());
					sale_price = Number(sale_price);
					net_total = net_total + sale_price;
					$('#tp').val(net_total);
          $('#barcode').val("");
          $('#barcode').focus();


		        }         
		    });


		})
	})
</script>