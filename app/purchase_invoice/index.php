<?php include "../includes/header.php"; ?>
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
      <h1>Manage Purchase Invoice</h1>
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
                $query_show = "SELECT * FROM purchase_invoice";
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
          <h4 class="modal-title">Add New Invoice</h4>
        </div>
        <div class="modal-body" >
          <form  method="post" class="form-horizontal">
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10"> 
                <div class="form-group">
                  <label> Distributer Name</label>  
                  <select name="distributer_id" class="form-control" required="" id="name">
                  <option value="">--Select the Distributer--</option>
                  <?php 
                    $query=mysqli_query($con,"SELECT * FROM distributer");
                    if ($_num_row=mysqli_num_rows($query)>0) {
                      while ($row=mysqli_fetch_assoc($query)) {?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                      <?php 
                      }
                    }
                  ?>
                </select>
                </div>
                
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
      $distributer_id = $_POST["distributer_id"];
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
          echo "<script type='text/javascript'>window.location='invoice_record'</script>";
        } 
      }
  ?>
  

