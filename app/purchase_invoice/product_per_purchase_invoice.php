<?php include "../includes/header.php"; ?>
<?php 
// Getting the id of the incoice
$id=$_GET["id"];
?>
<style type="text/css" media="screen">
  .tab {
    overflow: hidden;
   // border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border-top: none;
}
  
  pre{
    border:none;
    background-color: white;
    font-weight: bold;
    font-family: verdana;
  }
  td{
    text-align: center;
  }
  label
  {
    
    float: right;
  }
  .mag{
    margin-top: 10px;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Item Against the invoice</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'products_per_purchase_invoice')">Add Products Per Invoice</button>
            <button class="tablinks" onclick="openTab(event, 'accounts_detail')">Accounts Detail</button>
          </div>
          <div id="products_per_purchase_invoice" class="tabcontent">
          
          <div class="box">
            <div class="box-header">
              <button class="btn btn-success" type="button" class="btn btn-default" data-toggle="modal" data-target="#invoice-product" title="Add new invoice"><i class="fa fa-plus"></i> Add Product</button>
              
              <?php session_message(); ?>
              <?php error_message(); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th><pre>Sr # No</pre></th>
                  <th><pre>Product Name </pre></th>
                  <th><pre>Expiry starting date</pre> </th>
                  <th><pre>Expiry ending date</pre></th>
                  <th><pre>Original Price</pre></th>
                  <th><pre>Discount on item</pre></th>
                  <th><pre>Purchase Price</pre></th>
                  <th><pre>Sale Price</pre></th>
                  <th><pre>Status</pre></th>
                  <th><pre>Imei No</pre></th>
                  <th><pre>Action</pre></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query_show = "SELECT pppi.*,products.product_name FROM products_per_purchase_invoice AS pppi INNER JOIN products ON products.id= pppi.product_id WHERE pppi.purchase_invoice_id=$id";
                $i=1;
                $result     = mysqli_query($con,$query_show);
                while ($row = mysqli_fetch_array($result)) { 
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['product_name'] ;?></td>
                    <td><?php echo $row['expiry_starting_date'] ;?></td>
                    <td><?php echo $row["expiry_ending_date"]; ?></td>
                    <td><?php echo $row['original_price'] ;?></td>
                    <td><?php echo $row['discount_per_item'] ;?></td>
                    <td><?php echo $row["purchase_price"]; ?></td>
                    <td><?php echo $row['sale_price'] ;?></td>
                    <td><?php echo $row['status'] ;?></td>
                    <td><?php echo $row["imei"]; ?></td>
                    <td> 
                      <a href="edit_invoice-<?php echo $row['id']; ?>" title="Edit this item"><i class="fa fa-pencil" style="color:skyblue;font-size: 15px;margin:5px;"></i></a>
                      <a href="view-<?php echo $row['id']; ?>" title="Delete the product from the invoice"><i class="fa fa-trash" style="color:red;font-size: 15px;margin:5px;"></i></a>
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
              </div>
        </div>
      </div> 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include"../includes/footer.php" ?>
  

<!--  <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script> -->
 
  <div class="control-sidebar-bg"></div>
</div>

<div class="modal fade" id="invoice-product">
    <div class="modal-dialog model-lg" style="width: 75%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" align="center">Add Product</h4>
        </div>
        <div class="modal-body" >
          <form  method="post" class="form-horizontal">
            <div class="row mag">
              <div class="col-md-1"></div>
              <div class="col-md-2">
                <label> Product Name <span style="color: red;margin-left: 5px;font-size: 18px"><b>*</b></span></label>
              </div>
              <div class="col-md-8">
                <select class="form-control" name="product_name" placeholder="Product Name" required="" id="product_name">
                  <?php 
                  $result     = mysqli_query($con,"SELECT * FROM products");
                  while ($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['product_name']; ?></option>
                  <?php }?>
                </select>
              </div>
              </div>
              
              <div class="row mag">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                  <label> Expiry Start Date <span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                </div>
                <div class="col-md-8">
                  <input type="date" name="expiry_start_date"  class="form-control" id="expiry_start_date">
                </div>
              </div>
              <div class="row mag">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                  <label> Expiry End Date <span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                </div>
                <div class="col-md-8">
                  <input type="date" name="" class="form-control" id="expiry_end_date">
                </div>
              </div>
              
              <div class="row mag">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                  <label> Original Price <span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                </div>
                <div class="col-md-8">
                  <input type="text" name=""   class="form-control" id="original_price">
                </div>
              </div>
              
              <div class="row mag">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                  <label> Discount <span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                </div>
                <div class="col-md-8">
                  <input type="radio" id="percentage" checked="" name="discount"> Percentage
                  <input type="radio" id="amount" name="discount"> Amount
                  <input type="text" id="discount" class="form-control"  value="0">
                </div>
              </div>
              
              <div class="row mag">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                  <label> Purchase Price <span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                </div>
                <div class="col-md-8">
                  <input type="text" id="purchase_price" class="form-control" readonly="">
                </div>
              </div>  
              
              <div class="row mag">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                  <label> Sale Price <span><b style="color:red;margin-top: 40px;font-size: 18px">*</b></span></label>
                </div>
                <div class="col-md-8">
                  <input type="text" id="sale_price" class="form-control" onfocus="getProductsPerPurchasePrice();readOnlyPurchasePrice()">
                </div>
              </div>
              
              <div class="row mag">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                  <label> Status <span><b style="color:red;margin-top: 40px;font-size: 18px">*</b></span></label>
                </div>
                <div class="col-md-8">
                  <select name="" class="form-control" id="status">
                    <option value="available">Available</option>
                    <option value="sold">Sold</option>
                  </select>
                </div>
              </div>
              
              <div class=" row mag">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                  <label> Barcode No: <span><b style="color:red;margin-top: 40px;font-size: 18px">*</b></span></label>
                </div>
                <div class="col-md-8">
                  <input type="text" id="imei" class="form-control" onchange="imeiFunction()">
                </div>
              </div>  
                <div class=" row mag">
                  
                  <div class="col-md-3"></div>
                  <div class="col-md-6 form-group">
                    <button  id="table_heading" class="btn btn-success btn-md" onclick="insert();" type="button"> Display </button>
              <input type="button" name="submit" class="btn btn-success btn-md" id="submit"  value="Submit" onclick="objVariables();"/>
                </div>
              
          </form>
          <div id="mydata">
      <table  id="myTableData" class="table table-striped table-bordered dt-responsive nowrap" align ="center" width="70%">
        <tr>
          <th> Index No              </th>
          <th> Product Name          </th>
          <th> Expiry Starting       </th>
          <th> Expiry Ending         </th>
          <th> Original Price        </th>
          <th> Discount              </th>
          <th> Purchase Price        </th>
          <th> Selling Price         </th>
          <th> Status                </th>
          <th> IMEI                  </th>
        </tr>
      </table>
      <br/>
    </div>
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
  <script type="text/javascript">

  function openTab(evt, value) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(value).style.display = "block";
      evt.currentTarget.className += " active";
      }
     
       $("#mydata").hide();
    
      $("#imei").change(function(){
        $("#mydata").show();
      });

      let val;
      let purchaseInvoiceId;
      
      purchaseInvoiceId = <?php echo $id ;?>
             
      //product_per_invoice code
      //Arrays are declare
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
      
      //this method print the table heading
     
      $("#table_heading").click(function(){
        $("#mydata").show();
      });
        let productName, expStarting, expEnding,originalPrice,discount, purchasePrice, salePrice,status, imei, discountReceived=0;
        
      
      function getProductsPerPurchasePrice(){
        // Getting the value from the original price
        originalPrice = parseInt(document.getElementById("original_price").value);
        
      //discountType  = parseInt(document.getElementById("discountType").value);
        
          if(document.getElementById('percentage').checked)
              {
            discount = parseInt(document.getElementById("discount").value);
            
            discountReceived = parseInt((originalPrice*discount)/100);
            
            purchasePrice = originalPrice-discountReceived;
              }
            else if(document.getElementById('amount').checked)
            {
            discount = parseInt(document.getElementById("discount").value);
                  
            purchasePrice = originalPrice - discount;
              discountReceived = discount;
            } 
      }
      function readOnlyPurchasePrice()
        {
          let purchaseValue = document.getElementById('purchase_price');
            purchaseValue.value=purchasePrice;  
        }
        function getImeiValue()
      {    
        let imeiValue = document.getElementById("imei").value;
        return imeiValue;
      }
      function imeiFunction()
      {  
          val = getImeiValue();
          imeiArr.push(imei);  
          document.getElementById("imei").value = ""; 
      }
      function insert()
      {
        var product_name = $('#product_name').val();
        var exp_start_date = $('#expiry_start_date').val();
        var exp_end_date = $('#expiry_end_date').val();
        var original_price = $('#original_price').val();
        var discount = $('#discount').val();
        var purchase_price = $('#purchase_price').val();
        var sale_price = $('#sale_price').val();
        var status = $('#status').val();
        var imei = $('#imei').val();  
        //alert(product_name+' '+exp_start_date+' '+exp_end_date+' '+original_price+''+discount+''+purchase_price+''+sale_price+''+status+''+imei);
        // Pushing the data in th array 
        productIdArr.push(product_name);
      // let productNameArr = new Array();
        expStartingArr.push(exp_start_date);
        expEndingArr.push(exp_end_date);
        originalPriceArr.push(original_price);
        discountArr.push(discount);
        purchasePriceArr.push(purchase_price);
        salePriceArr.push(sale_price);
        statusArr.push(status);
        imeiArr.push(imei);
          
      // Show the inserted data in the table
           
           let table = document.getElementById("myTableData");
          
          //count the table row
          let rowCount = table.rows.length;
          
          //insert the new row
          let row = table.insertRow(1);
          
          //insert the coulmn against the row
          row.insertCell(0).innerHTML= rowCount;
          row.insertCell(1).innerHTML= product_name;
          row.insertCell(2).innerHTML= exp_start_date;
          row.insertCell(3).innerHTML= exp_end_date;
          row.insertCell(4).innerHTML= original_price;
          row.insertCell(5).innerHTML= discount;
          row.insertCell(6).innerHTML= purchase_price;  
          row.insertCell(7).innerHTML= sale_price;  
          row.insertCell(8).innerHTML= status;   
          row.insertCell(9).innerHTML= imei;
          $("#imei").val('');
      }
      
      let product,expS, expE,originalP,discountP, pPrice, sPrice,imeiNo,productStatus;
      function objVariables(){
                  product     = productIdArr;
            expS        = expStartingArr;
            expE        = expEndingArr;
            originalP   = originalPriceArr;
            discountP   = discountArr;
            pPrice      = purchasePriceArr;
            sPrice      = salePriceArr;
            productStatus = statusArr;
            imeiNo      = imeiArr;  
      }     
        
        $(document).ready(function(){
          $('#submit').click(function(){
                  $.ajax({
              url:"products_ajax_request.php",
              method: "POST",
              data:{purchase_invoice_id:purchaseInvoiceId, product_id:product ,exp_starting:expS, exp_ending:expE, original_price:originalP,discount_per_item:discountP, purchase_price:pPrice,sale_price:sPrice,
              status:productStatus,imei_no:imeiNo},
                            
              success:function(message)
              {
                //alert(message);
                $(".x_content").html(message);
              }
              });             
                }); // click event
        });// ready 
        
        //variables declaration of accounts detail
        let netTotalOfProducts=0, discountPerProducts=0,netTotalOfInvoice=0, discountValue, discountPerInvoice=0, discountReceivedOnInvoice=0,
            amountPaid,amountPayable,valueOfAmountPayable, netDiscount,valueOfNetDiscount,valueOfNetTotal; 
        //function for whole discount per invoice including products discount
        function discountOnInvoice()
            {
              netTotalOfProducts = parseInt(document.getElementById("net_total_of_products").value);
              discountPerProducts  = parseInt(document.getElementById("products_discount").value);
              
                  
                if(document.getElementById('percentage_of_invoice').checked)
                  {
                    //discountValue get from text box that we received on invoice
                    discountValue = parseInt(document.getElementById("discount_of_invoice").value);
                    
                    discountReceivedOnInvoice = parseInt((netTotalOfProducts*discountValue)/100);
                    
                    netTotalOfInvoice = netTotalOfProducts-discountReceivedOnInvoice;
                  }
                
                else if(document.getElementById('amount_of_invoice').checked)
                  {
                    discountValue = parseInt(document.getElementById("discount_of_invoice").value);
  
                    discountReceivedOnInvoice  = discountValue;
                    
                    netTotalOfInvoice = netTotalOfProducts-discountReceivedOnInvoice;
                  } 
                
                else{
                      netTotalOfInvoice = netTotalOfProducts;
                }   
            }
        
        function readOnlyNetDiscount()
        {
            valueOfNetDiscount = document.getElementById('net_discount_of_invoice');
          
              netDiscount = discountPerProducts + discountReceivedOnInvoice;
            
            valueOfNetDiscount.value=netDiscount;
          
            valueOfNetTotal = document.getElementById('net_total');
          valueOfNetTotal.value=netTotalOfInvoice;
            
        }
        function readOnlyAmountPayable(){
          
            amountPaid = parseInt(document.getElementById('amount_paid').value);
            amountPayable = netTotalOfInvoice-amountPaid;
              
            valueOfAmountPayable = document.getElementById('amount_payable');
                valueOfAmountPayable.value=amountPayable;
        }
        //ajax code for insert accounts detail against invoice
        $(document).ready(function(){
          $('#insert').click(function(){
                  $.ajax({
              url:"ajax_request_accounts.php",
              method: "POST",
              data:{purchase_invoice_id:purchaseInvoiceId, net_total_of_products:netTotalOfProducts, discount_per_products:discountPerProducts, discount_received_on_invoice:discountReceivedOnInvoice, net_discount:netDiscount, net_total_of_invoice:netTotalOfInvoice, amount_paid:amountPaid,amount_payable:amountPayable},
              success:function(message)
              {
                //alert(message);
                $("#accounts_detail").html(message);
              }
              });             
                }); // click event 
        });// ready 



</script>