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
            <button class="tablinks" onclick="openTab(event, 'products_per_purchase_invoice')" >Add Products Per Invoice</button>
            <button class="tablinks" onclick="openTab(event, 'accounts_detail')">Accounts Detail</button>
          </div>
          <div id="products_per_purchase_invoice" class="tabcontent">
          
          <div class="box">
            <div class="box-header">
              <button class="btn btn-success" type="button" class="btn btn-default" data-toggle="modal" data-target="#invoice-product" title="Add new invoice"><i class="fa fa-plus"></i> Add Product</button>
              
              
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
        <div id="accounts_detail" class="tabcontent">
          <div class="box">
            <div class="box-header">
              <h3>Account Details</h3>
            </div>
            
            <div class="box-body">
              <form  method="post">
                <div class="row mag">
                  <?php 
                  $discount=0;
                  $original_price=0;
                  $sql_fetch=mysqli_query($con,"SELECT original_price,discount_per_item FROM products_per_purchase_invoice where purchase_invoice_id= $id");
                  while($row=mysqli_fetch_assoc($sql_fetch)) {
                    $original_price=$original_price+$row["original_price"];
                    $discount+=$row["discount_per_item"];
                  }
                  ?>
                  
                    <div class="col-md-3"> 
                      <label>Total Amount of the products<span style="color: red;margin-left: 5px;font-size: 18px"><b>*</b></span></label>
  
                    </div>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="net_total_of_products" value="<?php echo $original_price; ?>" placeholder="Total Amount of the products" readonly="" id="net_total_of_products">
                      </div>
                    </div> 
                    <div class="row mag">
                      <div class="col-md-3"> 
                      <label>Discount Per Product<span style="color: red;margin-left: 5px;font-size: 18px"><b>*</b></span></label>
                      </div>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="products_discount" id="products_discount" value="<?php echo $discount;?>" placeholder="" readonly required="required">
                        </div>
                    </div>
                    <div class="row mag">
                      <div class="col-md-3">
                        <label> Discount on Invoice<span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                      </div>
                      <div class="col-md-6">
                        <input type="radio" id="percentage_of_invoice" checked="" name="invoice_discount"> Percentage
                        <input type="radio" id="amount_of_invoice" name="invoice_discount"> Amount
                        <input type="text" name="discount_of_invoice" id="discount_of_invoice" class="form-control"  value="0" required="required">
                      </div>
                    </div>
                     
                    <div class="row mag">
                      <div class="col-md-3"> 
                      <label>Net Discount<span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                      </div>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="net_discount_of_invoice"  placeholder="Net discount" readonly="" id="net_discount_of_invoice" required="required">
                        </div>
                    </div>
                    <div class="row mag">
                      <div class="col-md-3"> 
                      <label>Net Total of the Invoice<span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                      </div>
                      <div class="col-md-6">
                          <input type="text" class="form-control" id="net_total" placeholder="Net total of the invoice" readonly="" required="required" name="net_total">
                        </div>
                    </div>
                    <div class="row mag">
                      <div class="col-md-3"> 
                      <label>Amount Paid <span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                      </div>
                      <div class="col-md-6">
                          <input type="text" class="form-control"  placeholder="Amount Paid" name="amount_paid" id="amount_paid" onfocus="discountOnInvoice();readOnlyNetDiscount();" required="required">
                        </div>
                    </div>
                    <div class="row mag">
                      <div class="col-md-3"> 
                      <label>Amount Payable <span style="color: red;margin: 15px 0px 0px 5px;font-size: 18px"><b>*</b></span></label>
                      </div>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="" value="" placeholder="Remaining Amount" readonly="" id="amount_payable" onfocus="readOnlyAmountPayable()"; required="required">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-4"> 
                      
                      </div>
                      <div class="col-md-4">
                          <button type="button" class="btn btn-success btn-block" id="insert_invoice"> Insert </button>
                        </div>
                    </div>

                  </form>  
            </div>
          </div>
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
                  <option value="">--Select the Product--</option>
                  <?php 
                  $result     = mysqli_query($con,"SELECT * FROM products");
                  while ($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['product_name']; ?></option>
                  <?php }?>
                </select>
              </div>
              </div>
              <input type="hidden" id="fetch_product_name">
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
                  <input type="text" name=""   class="form-control" id="original_price" placeholder="Original Price of the product" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
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
                  <input type="text" id="sale_price" class="form-control" onfocus="getProductsPerPurchasePrice();readOnlyPurchasePrice()"placeholder="Sale Price of the product" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
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
                  <label> IMEI NO: <span><b style="color:red;margin-top: 40px;font-size: 18px">*</b></span></label>
                </div>
                <div class="col-md-8">
                  <input type="text" id="imei" class="form-control" placeholder="IMEI No" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                </div>
              </div>  
                <div class=" row mag">
                  
                  <div class="col-md-3"></div>
                  <div class="col-md-6 form-group">
                    <button  id="table_heading" class="btn btn-success btn-md" onclick="insert();" type="button"> Display </button>
              <input type="submit" name="submit" class="btn btn-success btn-md" id="submit"  value="Submit"  disabled="" />
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
          imeiArr.push(val);  
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
        var  fetch_product_name= $('#fetch_product_name').val();  
        //alert(product_name+' '+exp_start_date+' '+exp_end_date+' '+original_price+''+discount+''+purchase_price+''+sale_price+''+status+''+imei);
        // Pushing the data in th array 
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
           $("#mydata").show();
           document.getElementById("submit").disabled = false;
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
          row.insertCell(4).innerHTML= original_price;
          row.insertCell(5).innerHTML= discount;
          row.insertCell(6).innerHTML= purchase_price;  
          row.insertCell(7).innerHTML= sale_price;  
          row.insertCell(8).innerHTML= status;   
          row.insertCell(9).innerHTML= imei;
          $("#imei").val('');
          }
      }

      
      
      
        //function for whole discount per invoice including products discount
        function discountOnInvoice()
            {
              netTotalOfProducts = parseInt(document.getElementById("net_total_of_products").value);
              discountPerProducts  = parseInt(document.getElementById("products_discount").value);
              //alert(netTotalOfProducts);
                  
                if(document.getElementById('percentage_of_invoice').checked)
                  {

                    //discountValue get from text box that we received on invoice
                    discountValue = parseInt(document.getElementById("discount_of_invoice").value);
                    
                    discountReceivedOnInvoice = parseInt((netTotalOfProducts*discountValue)/100);
                    
                    netTotalOfInvoice = netTotalOfProducts-discountReceivedOnInvoice-discountPerProducts;
                  }
                
                else if(document.getElementById('amount_of_invoice').checked)
                  {
                    // alert("text");
                    discountValue = parseInt(document.getElementById("discount_of_invoice").value);
  
                    discountReceivedOnInvoice  = discountValue;
                    
                    netTotalOfInvoice = netTotalOfProducts-discountReceivedOnInvoice-discountPerProducts;
                    
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
           // click event 
          $("#product_name").change(function(){
            var productId= $("#product_name").val();
            $.ajax({
        type:'post',
        data:{productId:productId},
        url: "fetch_product_name.php",

        success: function(result){
        data=$.parseJSON(result);
        var fee = data["product_name"];
        //alert(fee);

          $('#fetch_product_name').val(fee);
        
        }         
    });
          });
          $("#submit").click(function(){
           $.ajax({
            type:'post',
            data:{
              purchaseInvoiceId:purchaseInvoiceId,
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
        url: "insert_invoice_data.php",
        success: function(result){
        window.location='product_per_purchase_invoice-'+purchaseInvoiceId;
       } 
    });


});// ready 
$(document).ready(function(){
 $("#insert_invoice").click(function(){
      var total_amount=$("#net_total_of_products").val();
      var discount_amount=$("#net_discount_of_invoice").val();
      var net_total=$("#net_total").val();
      var paid_amount=$("#amount_paid").val();
      var payable_amount=$("#amount_payable").val();
      // alert(total_amount);
      // alert(discount_amount);
      // alert(net_total);
      alert(purchaseInvoiceId);
      alert(paid_amount);
      alert(payable_amount);

    })
  });
  })
</script>