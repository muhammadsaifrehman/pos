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
        <li><a href="invoice_record"><i class="fa fa-product-hunt"></i> Invoice</a></li>
        <li class="active"><i class="fa fa-product-hunt"></i> Purchase Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
         
          
          <div class="box">
            
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

