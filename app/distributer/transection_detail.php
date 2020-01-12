<?php include"../includes/header.php"; ?>
<?php 
	$id = $_GET["id"];
	$sql_fetch = "SELECT pi.distributer_id,d.name,td.* FROM purchase_invoice AS pi INNER JOIN transection_details AS td ON pi.id = td.invoice_id INNER JOIN distributer AS d ON pi.distributer_id = d.id WHERE td.invoice_id = $id";
	$sql_fetch_result = mysqli_query($con,$sql_fetch);
	
	$i=1;
	

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-xs-12">
         
         

          <div class="box">
            <div class="box-header">
            
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                
              
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>Sr No #</th>
                  <th>Distributer Name</th>
                  <th>Transection Date</th>
                  <th>Amount</th>
                  
                  <th>Status</th>
                  
                </tr>
                </thead>
                <tbody>
               <?php
               $i=1;
                while ($row=mysqli_fetch_assoc($sql_fetch_result)) {

              
               ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td> <?php echo $row["name"]; ?> </td>
                    <td><?php echo $row["transection_date"] ?></td>
                    <td><?php  echo $row['paid_amount'] ;?></td>
                    <td><?php  echo $row['status'] ;?></td>
                    
                     
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
  <?php include '../includes/footer.php' ?>