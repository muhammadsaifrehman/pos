<?php include "../includes/header.php"; ?>
<?php  
  $id=$_GET["id"];
  
  $query_show = "SELECT * FROM purchase_invoice WHERE id='$id'";
          
  $result     = mysqli_query($con,$query_show);
  $row1 = mysqli_fetch_array($result); 
  $did=$row1["distributer_id"];
  $distributer_data = "SELECT name FROM distributer WHERE id='$did'";
          
  $result_distributer = mysqli_query($con,$distributer_data);
  $distributer_row=mysqli_fetch_assoc($result_distributer);
  $name=$distributer_row["name"];

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Invoice</h1>
      <ol class="breadcrumb">
        <li><a href="../index/admin_view"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="invoice_record"><i class="fa fa-user"></i> Invoice Record</a></li>
        <li class="active">Edit purchase invoice</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary well" style="border-top:3px solid skyblue ">
        <?php
       if(isset($_POST["submit"]))
    {
      $distributer_id = $_POST["distributer_id"];
      $date           = $_POST["date"];
      $comment        = $_POST["comment"];  
      $query_update = "UPDATE purchase_invoice SET distributer_id='$distributer_id',`date`='$date',comment='$comment' WHERE id = $id";
      
     
      $result   = mysqli_query($con,$query_update);
      

      if($result)
        {
          $_SESSION["message"]="The invoice is updated ";
          echo "<script type='text/javascript'>window.location='invoice_record'</script>";
        } 
      }

  ?>
      <form  method="post" >
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label> Distributer Name</label>  
                <select name="distributer_id" class="form-control" required="">
                <option value="<?php echo $did; ?>"> <?php  echo $name;?></option>
                <?php 
                  $query=mysqli_query($con,"SELECT * FROM distributer where id!=$did");  
                  while ($row=mysqli_fetch_assoc($query)) {?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                  <?php 
                  }  
                  ?>
                </select>
              </div>
            </div>
          
          
          <div class="col-md-6">
            
            <div class="form-group">
                <label>Date:</label>
                
                <a href="product_per_purchase_invoice.php?id=<?php echo $id;?>#timeline" >email me</a>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control " name="date" value="<?php echo $row1['date']; ?>">
                </div>
                <!-- /.input group -->
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                  <label>Comment </label>
                <textarea name="comment" class="form-control" placeholder="comment" rows="4"> <?php echo $row1['comment']; ?></textarea>
                
                </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-edit"></i> Update</button>
            <a href="invoice_record" title="" class="btn btn-danger"> <i class="fa fa-times" ></i> Cancel</a>
          </div>
        </div>
      </div>
    </form>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include"../includes/footer.php" ?>
  
