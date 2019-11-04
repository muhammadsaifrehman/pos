<?php include "../includes/header.php"; ?>
<?php $distributer_id=$_GET["distributer_id"];
// Query to fetch the distributer name of against the id of the distriber Id
  $query_distributer = "SELECT * FROM distributer WHERE id=$distributer_id";
  $result1    = mysqli_query($con,$query_distributer);
  $row1 = mysqli_fetch_array($result1);

  $new_generated = "SELECT * FROM purchase_invoice WHERE amount_payable = 0 AND amount_paid = 0 AND discount_of_invoice=0 AND   net_total_of_discount = 0 AND product_discount=0  AND distributer_id ='$distributer_id'";


  $result_new_inovice     = mysqli_query($con,$new_generated);

  $count_new_invoice = mysqli_num_rows($result_new_inovice);
// Query for the paid invoice 

  $paid_invoice = "SELECT * FROM purchase_invoice WHERE amount_payable = 0 AND amount_paid != 0 AND distributer_id ='$distributer_id'";

  $paid_invoice_result = mysqli_query($con,$paid_invoice);
  $count_paid_invice= mysqli_num_rows($paid_invoice_result);



  ?>

<style type="text/css" media="screen">
  pre{
    border:none;
    background-color: white;
    font-weight: bold;
    font-family: verdana;
  }
  td{
    text-align: center;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><b>Mr <?php echo $row1["name"]; ?></b></h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <button class="btn btn-success" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-invoice" title="Add new invoice"><i class="fa fa-plus"></i></button>
              <br>
              <?php session_message(); ?>
              <?php error_message(); ?>
            </div>
            <!-- /.box-header -->
           

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">New Invoices <span class="badge badge-info"> <?php  echo $count_new_invoice; ?> </span></a></li>
              <li><a href="#tab_2" data-toggle="tab">Paid Invoices <span class="badge badge-info"> <?php echo $count_paid_invice; ?> </span></a></li>
              <li><a href="#tab_3" data-toggle="tab">Credit Invoices</a></li>
              
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                 <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>

                  <th><pre>Sr # No</pre></th>
                  <th><pre>Invoice No</pre></th>
           
                  <th><pre>Date</pre></th>
                  <th><pre>Comment</pre></th>
                  
                  <th><pre>Action</pre></th>
                </tr>
                </thead>
                <tbody>

               <?php $i=1;
                while ($row_new = mysqli_fetch_array($result_new_inovice)) { 
                  $did=$row_new["distributer_id"];

                  $query_distributer = "SELECT * FROM distributer WHERE id=$did ";
                  $result1    = mysqli_query($con,$query_distributer);
                  $row1 = mysqli_fetch_array($result1);
                  ?> 
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><b><a href="product_per_purchase_invoice-<?php  echo $row_new['id'] ;?>" title="">Invoice:<b><?php  echo $row_new['id'] ;?></a></b></td>
                
                    <td><?php  echo $row_new['date'] ;?></td>
                    <td><?php echo $row_new["comment"]; ?></td>
                      
                    
                  
                  
                    <td> 
                      <a href="view-<?php echo $row_paid_invoice['id']; ?>" title="View detail of the invoice"><i class="fa fa-eye" style="color:orange;font-size: 15px;margin:5px;"></i></a> 
                      <a href="edit_invoice-<?php echo $row['id']; ?>" title="Edit Invoice"><i class="fa fa-pencil" style="color:skyblue;font-size: 15px;margin:5px;"></i></a>
                      <!-- <a href="collect_invoice-<?php echo $row['id']; ?>" title="Collect Invoice"><i class="fa fa-file" style="color:skyblue;font-size: 15px;margin:5px;"></i></a> -->
                      
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
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>

                  <th><pre>Sr # No</pre></th>
                  <th><pre>Invoice No</pre></th>
                 
                  <th><pre>Date</pre></th>
                  <th><pre>Comment</pre></th>
                  
                  <th><pre>Action</pre></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $j=1;
                while ($row_paid_invoice = mysqli_fetch_array($paid_invoice_result)) { 
                 
                  ?>
                  <tr>
                    <td><?php echo $j; ?></td>
                    <td><b><a>invoice:<?php  echo $row_paid_invoice['id'] ;?></a></b></td>
                   
                    <td><?php  echo $row_paid_invoice['date'] ;?></td>
                    <td><?php echo $row_paid_invoice["comment"]; ?></td>
                      
                    
                  
                  
                    <td> 
                      <a href="view-<?php echo $row['id']; ?>" title="View detail of the invoice"><i class="fa fa-eye" style="color:orange;font-size: 15px;margin:5px;"></i></a> 
                      <a href="edit_invoice-<?php echo $row['id']; ?>" title="Edit Invoice"><i class="fa fa-pencil" style="color:skyblue;font-size: 15px;margin:5px;"></i></a>
                      <a href="collect_invoice-<?php echo $row['id']; ?>" title="Collect Invoice"><i class="fa fa-file" style="color:skyblue;font-size: 15px;margin:5px;"></i></a>
                      
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
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>

                  <th><pre>Sr # No</pre></th>
                  <th><pre>Invoice No</pre></th>
                  <th><pre>Distributer Name</pre> </th>
                  <th><pre>Date</pre></th>
                  <th><pre>Comment</pre></th>
                  
                  <th><pre>Action</pre></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query_show = "SELECT * FROM purchase_invoice WHERE amount_payable != 0 AND  amount_paid != 0 AND distributer_id = '$distributer_id'";
                $i=1;
                $result     = mysqli_query($con,$query_show);
                while ($row = mysqli_fetch_array($result)) { 
                  $did=$row["distributer_id"];
                  $query_distributer = "SELECT * FROM distributer WHERE id=$did ";
                  $result1    = mysqli_query($con,$query_distributer);
                  $row1 = mysqli_fetch_array($result1);
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><b><a href="product_per_purchase_invoice-<?php  echo $row['id'] ;?>" title="">Invoice:<b><?php  echo $row['id'] ;?></a></b></td>
                    <td><?php  echo $row1['name'] ;?></td>
                    <td><?php  echo $row['date'] ;?></td>
                    <td><?php echo $row["comment"]; ?></td>
                      
                    
                  
                  
                    <td> 
                      <a href="view-<?php echo $row['id']; ?>" title="View detail of the invoice"><i class="fa fa-eye" style="color:orange;font-size: 15px;margin:5px;"></i></a> 
                      <a href="edit_invoice-<?php echo $row['id']; ?>" title="Edit Invoice"><i class="fa fa-pencil" style="color:skyblue;font-size: 15px;margin:5px;"></i></a>
                      <a href="collect_invoice-<?php echo $row['id']; ?>" title="Collect Invoice"><i class="fa fa-file" style="color:skyblue;font-size: 15px;margin:5px;"></i></a>
                      
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
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->

        
        <!-- /.col -->
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
  

 
<!-- bootstrap datepicker -->
  <script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
 
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<div class="modal fade" id="modal-invoice">
    <div class="modal-dialog model-xs">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Invoice of the <b>Mr <?php  echo $row1["name"]; ?></b></h4>
        </div>
        <div class="modal-body" >
          <form  method="post" class="form-horizontal">
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10"> 
                
                
                <div class="form-group">
                <label>Date:</label>
                
                  <input type="date" class="form-control"  name="date">
                
                <!-- /.input group -->
              </div>
                <div class="form-group">
                  <label>Comment </label>
                <textarea name="comment" class="form-control" placeholder="comment" rows="4"></textarea>
                
                </div>
                <div class="row">
                  <br>
                  <div class="col-md-3"></div>
                  <div class="col-md-6 form-group">
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    <button data-dismiss="modal" class="btn btn-info">Cancel</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <?php
    if(isset($_POST["submit"]))
    {
      
      $date           = $_POST["date"];
      $comment        = $_POST["comment"];  
      $created_at=date("y-m-d h:i:s");
      $query_insert = "INSERT INTO purchase_invoice(distributer_id,`date`,comment,created_by,created_at,product_discount,net_total_of_discount,discount_of_invoice, amount_paid,amount_payable) VALUES ('$distributer_id','$date','$comment','$user','$created_at','0','0','0','0','0')";
      echo $query_insert;
     
      $result   = mysqli_query($con,$query_insert);
      var_dump($result);

      if($result)
        {
          $_SESSION["message"]="The invoice is generated ";
          echo "<script type='text/javascript'>window.location='invoice_record-$distributer_id'</script>";
        } 
      }
  ?>
  

