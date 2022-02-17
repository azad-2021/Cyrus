<?php 
include 'connection.php';
include 'session.php';
$username=$_SESSION['user'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$orgDate = date('Y-m-d',strtotime($timestamp));
$Date = date('Y-m-d', strtotime($orgDate. ' -1 days'));


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
  <title>Reminders</title>
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

  <style type="text/css">
  label{
    margin: 5px;
  }
</style>

</head>  
<body> 
  <?php 
  include 'navbar.php';
  include 'modals.php';

  ?>


  <div class="container">

    <div class="col-lg-12 table-responsive" style="margin: 12px;">
      <table class="table table-hover table-bordered border-primary  display">
        <h5 align="center">Welcome <?php echo $username ?></h5>
        <br>        
        <h5 align="center">Reminders Per Day</h5>
        <thead> 
          <tr> 
            <th style="min-width:160px">Name</th>
            <th style="min-width:80px">Date</th>           
            <th style="min-width:150px">No. of Branches</th>           
          </tr>                     
        </thead>                 
        <tbody>
          <?php 
          $query="SELECT COUNT(SUBQUERY.BranchCode) as CountBranchCode, SUBQUERY.user, SUBQUERY.ReminderOn from
          (
          SELECT cyrusbackend.pass.UserName As user, cyrusbilling.reminders.BranchCode, count(cyrusbilling.reminders.ID) AS CountOfID, date(cyrusbilling.reminders.ReminderDate) as ReminderOn FROM cyrusbackend.pass
          inner join cyrusbilling.reminders on cyrusbackend.pass.ID=cyrusbilling.reminders.UserID 
          Group By cyrusbackend.pass.UserName, cyrusbilling.reminders.BranchCode, date(cyrusbilling.reminders.ReminderDate)
        ) AS SUBQUERY group by SUBQUERY.user, SUBQUERY.ReminderOn";

        $result=mysqli_query($con2,$query);
        while($row = mysqli_fetch_array($result)){

          print "<tr>";
          print "<td>".$row['user']."</td>";             
          print "<td>".$row['ReminderOn']."</td>";
          print "<td>".$row['CountBranchCode']."</td>"; 
          print "</tr>";

        }

        ?>
      </tbody>
    </table>

  </div>

  <div class="col-lg-12 table-responsive" style="margin: 12px;">
    <table class="table table-hover table-bordered border-primary  display"> 
      <h5 align="center">Reminders Per Month</h5>
      <thead> 
        <tr> 
          <th style="min-width:160px">Name</th>
          <th style="min-width:80px">Month</th>           
          <th style="min-width:150px">No. of Branches</th>           
        </tr>                     
      </thead>                 
      <tbody>
        <?php 
        $query="SELECT COUNT(SUBQUERY.BranchCode) as CountBranchCode, SUBQUERY.user, SUBQUERY.ReminderOn as month  from
        (
        SELECT cyrusbackend.pass.UserName As user, cyrusbilling.reminders.BranchCode, count(cyrusbilling.reminders.ID) AS CountOfID, date(cyrusbilling.reminders.ReminderDate) as ReminderOn FROM cyrusbackend.pass
        inner join cyrusbilling.reminders on cyrusbackend.pass.ID=cyrusbilling.reminders.UserID 
        Group By cyrusbackend.pass.UserName, cyrusbilling.reminders.BranchCode, date(cyrusbilling.reminders.ReminderDate)
      ) AS SUBQUERY group by SUBQUERY.user, month(SUBQUERY.ReminderOn)";

      $result=mysqli_query($con2,$query);
      while($row = mysqli_fetch_array($result)){

        print "<tr>";
        print "<td>".$row['user']."</td>";             
        print "<td>".date("M-Y", strtotime($row['month']))."</td>";
        print "<td>".$row['CountBranchCode']."</td>"; 
        print "</tr>";

      }

      ?>
    </tbody>
  </table>

</div>


<div class="col-lg-12" style="margin: 12px;">
  <table class="table table-hover table-bordered border-primary table-responsive display"> 
    <h5 align="center">Monthly Payment Realization</h5>
    <thead> 
      <tr> 
        <th style="min-width:160px">Month</th>
        <th style="min-width:80px">Amount</th>           

      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      $query="SELECT GenDate, sum(Amount) As `SumOfAmount` FROM cyrusbilling.`reminder lock`
      group by MONTH(GenDate), year(GenDate) order by year(GenDate)";

      $result=mysqli_query($con2,$query);
      while($row = mysqli_fetch_array($result)){

        print "<tr>";
        print "<td>".date("M-Y", strtotime($row['GenDate']))."</td>";             
        print "<td>&#x20B9 ".$row['SumOfAmount']."</td>";
        print "</tr>";

      }

      ?>
    </tbody>
  </table>

</div>

</div>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="ajax-script.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: false
    } );
  } );
</script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>