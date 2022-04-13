
<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));
?>


<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title><?php echo $_SESSION['user']; ?></title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

  <style type="text/css">
  .link {
    background-color: #955CEB;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    min-width: 250px;
    border-radius: 10px;
  }

  .link:hover, .link:active {
    background-color: #C5B8E0;
  }
</style>
</head>  
<body> 

  <?php 
  include 'navbar.php';
  include 'modals.php';
  ?>
  <div class="container">
    <center>
    <div class="row" style="margin:20px">

      <div class="col-sm-4" style="margin-bottom:20px">
        <a class="link"  href="PendingMaterial.php" target="blank_">Pending Material Confirmation</a>
      </div>
      <div class="col-sm-4" style="margin-bottom:20px">
        <a class="link"  href="inventorydata.php" target="blank_">Pending Material at Inventory</a>
      </div>
      <div class="col-sm-4" style="margin-bottom:20px">
        <a class="link"  href="UnassignedWork.php" target="blank_">Unassigned Work</a>
      </div>
    </div> 


    <div class="row" style="margin:20px">

      <div class="col-sm-4" style="margin-bottom:20px">
        <a class="link" target="blank_" href="PendingWork.php">Pending Work</a>
      </div>
      <div class="col-sm-4" style="margin-bottom:20px">
        <a class="link" target="blank_" href="PendingPayment.php">Pending Payment</a>
      </div>
      <div class="col-sm-4" style="margin-bottom:20px">
        <a class="link" target="blank_" href="multiorders.php">Multi-Orders Comfirmation</a>
      </div>
    </div>
    </center>
  </div>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
  <script src="ajax.js"></script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>
