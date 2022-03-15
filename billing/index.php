<?php 
include 'connection.php';
//include 'session.php';
//$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));

$exdate=date('Y-m-d', strtotime($Date. ' + 2 days'));
$exdate2=date('Y-m-d', strtotime($Date. ' + 7 days'));
?>

<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title>Billing</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>  
<body> 
  <?php 
  //include 'navbar.php';
  //include 'modals.php';

  ?>
  <div class="container">

   <div class="modal fade" id="ViewOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Materials</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <table class="table table-hover table-bordered border-primary display" id="branchdata">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Description</th>
                <th>Rate</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody id="material">

            </tbody>
          </table>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="row g-3">
    <div class="col-md-12">
      <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
      <form class="needs-validation form-control novalidate my-select4" method="POST" style="margin-bottom: 5px;">
        <div class="row g-3">

          <div class="col-sm-4">
            <select id="Bank" class="form-control my-select3" name="Bank" required>
              <option value="">Bank</option>
              <?php
              $BankData="Select BankCode, BankName from bank order by BankName";
              $result=mysqli_query($con,$BankData);
              if (mysqli_num_rows($result)>0)
              {
                while ($arr=mysqli_fetch_assoc($result))
                {
                  ?>
                  <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                  <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="col-sm-4">
            <select id="Zone" class="form-control my-select3" name="Zone" required>
              <option value="">Zone</option>
            </select>
          </div>
          <div class="col-sm-4">
            <select id="Branch" class="form-control my-select3" name="Branch" required>
              <option value="">Branch</option>
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>
  <br><br>
  <!--<div id="viewResult"></div>-->

  <table class="table table-hover table-bordered border-primary display" id="branchdata">
    <thead>
      <tr>
        <th>Employee</th>
        <th>Order ID</th>
        <th>Complaint ID</th>
        <th>Status</th>
        <th>Job Card Number</th>
      </tr>
    </thead>
    <tbody id="Branchlist">

    </tbody>
  </table>
</div>
</div>

<script src="ajax-script.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">


 $(document).on('change','#Bank', function(){
  var BankCode = $(this).val();
  if(BankCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'BankCode':BankCode},
      success:function(result){
        $('#Zone').html(result);
        
      }
    }); 
  }else{
    $('#Zone').html('<option value="">Zone</option>');
    $('#Branch').html('<option value="">Branch</option>'); 
  }
});
 
 $(document).on('change','#Zone', function(){
  var ZoneCode = $(this).val();
  if(ZoneCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ZoneCode':ZoneCode},
      success:function(result){
        $('#Branch').html(result);
        
      }
    }); 
  }else{

    $('#Branch').html('<option value=""> Branch </option>'); 
  }
});


 $(document).on('change','#Branch', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'BranchCode':BranchCode},
      success:function(result){
        $('#Branchlist').html(result);
        
      }
    }); 
  }
});

 $(document).on('click','.viewMaterial', function(){
  var Apid = $(this).attr("id");
  console.log(Apid);
  if(Apid){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ApprovalID':Apid},
      success:function(result){
        $('#material').html(result);
        $('#ViewOrder').modal('show');
        
      }
    }); 
  }
});

</script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>