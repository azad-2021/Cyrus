<script type = "text/javascript" >  
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  
</script> 




<?php 
//$UID = $_GET['eid'];
//$name = $_GET['name'];
include 'session.php';
$name=$_SESSION['user'];
$UID=$_SESSION['empid'];
$Password=$_SESSION['pass'];
//echo $password;
include 'sheet.php';

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$DateQ = date('Y-m-d',strtotime($timestamp));
$con = new mysqli("192.168.1.1:9916","Ashok","cyrus@123","cyrusbackend");
$con2 = new mysqli("192.168.1.1:9916","Ashok","cyrus@123","cyrusbilling");


// Billing Target 
$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook where EmployeeCode=$UID and Cancelled=0 and month(BillDate)=month(current_date()) and year(BillDate)=year(current_date())";
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$resultsB = $con->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount=$rowB["sum(TotalBilledValue)"];



$sqlE ="SELECT * FROM employees where EmployeeCode=$UID";
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$resultsE = $con->query($sqlE);
$rowE=mysqli_fetch_array($resultsE,MYSQLI_ASSOC);
$Target=$rowE["TargetAmounts"];


$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook where EmployeeCode=$UID and Cancelled=0 and month(BillDate)=(month(current_date())-1) and year(BillDate)=year(current_date())";
$resultsB = $con->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount1=$rowB["sum(TotalBilledValue)"];

$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook where EmployeeCode=$UID and Cancelled=0 and month(BillDate)=(month(current_date())-2) and year(BillDate)=year(current_date())";
$resultsB = $con->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount2=$rowB["sum(TotalBilledValue)"];

$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook where EmployeeCode=$UID and Cancelled=0 and month(BillDate)=(month(current_date())-3) and year(BillDate)=year(current_date())";
$resultsB = $con->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount3=$rowB["sum(TotalBilledValue)"];

if ($Target>0) {

    $PendingTarget=$Target-$BilledAmount;
    $PendingTarget1=$Target-$BilledAmount1;
    $PendingTarget2=$Target-$BilledAmount2;
    $PendingTarget3=$Target-$BilledAmount3;
    if ($PendingTarget<0) {
        $PendingTarget=0;
    }

    if ($PendingTarget1<0) {
        $PendingTarget1=0;
    }

    if ($PendingTarget2<0) {
        $PendingTarget2=0;
    }

    if ($PendingTarget3<0) {
        $PendingTarget3=0;
    }
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $name; ?></title>
    <!-- Bootstrap core CSS -->
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
    <style type="text/css">
    .border {
        border:5px solid Black;
        padding:5px;
    }
    table, th, td {
      border:1px solid black;
  }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<script src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
      <div class="container-fluid" align="center">
        <a class="navbar-brand" href=""><img src="cyrus logo.png" alt="cyrus.com" width="50" height="60">Cyrus Electronics</a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown" align="center">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>

          <?php 
          if ($Password !='cyrus@123'){
            print '<li class="nav-item"><a class="nav-link" aria-current="page" href=';
            echo $sheet ;
            print ' > Expences </a></li>';
        }
        ?>
        <?php 
        if ($Target>0){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="targethistory.php">Target History</a>  
            </li>   
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="changepass.php">Change Password</a>  
        </li>      
        <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </li>
    </li>
</ul>
</div>
</div>
</nav>
<br>
<div class="container" style="resize: both;">
    <h4 align="center">Billing Target Report</h4>
    <div class="row">
        <div class="col-lg-12">
            <h5 align="center"><?php echo date('M',strtotime($timestamp));;?></h5>
            <div id="piechart" align="center"></div>
        </div>
    </div>

    <table class="table-hover table-sm table-bordered border-primary" id="example" class="display nowrap">
        <br>
        <h4 class="font-weight-bold text-center text-xl-center"<?php $sheet ?> >Total pending work report for <?php  print $name; ?> </h4>
        <!--<a href = <?php echo $sheet ?>> <h5 >View Expences</h5></a>-->
        <thead> 
            <tr> 
                <th>Bank</th> 
                <th>Zone</th> 
                <th>Branch</th> 
                <th>District</th> 
                <th>AMC</th>
                <th>Order</th>
                <th>Complaint</th>
                <th>Balance Amount</th>
            </tr>                     
        </thead>                 
        <tbody> 
            <?php
            

            $sql ="SELECT * FROM `pendingwork` where EmployeeCode=".$UID ." AND (`pending Order` is not null OR `Pending Complaints` is not null OR `pending AMC` is not null) ORDER by BranchName";
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }


            $results = $con->query($sql); 

            while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){
                $BranchCode=$row["BranchCode"];

                $sql2 ="SELECT SUM(TotalBilledValue), Sum(ReceivedAmount) FROM cyrusbilling.billbook 
                WHERE billbook.Cancelled !=1 and billbook.Cancelled !=-1 
                and billbook.BranchCode=$BranchCode group by billbook.BranchCode";
                $results2 = $con2->query($sql2); 
                $TotalGST=0;
                $ReceivedGST=0;
                if($results2->num_rows>0){
                    $row2=mysqli_fetch_array($results2,MYSQLI_ASSOC);

                    $ReceivedGST=$row2['Sum(ReceivedAmount)'];
                    $TotalGST=$row2['SUM(TotalBilledValue)'];
                }
                if ($TotalGST-$ReceivedGST<1) {
                 $BalanceGST=0;
             }else{
                $BalanceGST=sprintf('%0.2f', ($TotalGST-$ReceivedGST));
            }
            print "<tr>";
            print "<td>".$row["BankName"]."</td>";
            print "<td>".$row["ZoneRegionName"]."</td>";
            print "<td>".$row["BranchName"]."</td>";
            print "<td>".$row["Address3"]."</td>";
            print "<td>".$row["pending AMC"]."</td>";
            print "<td>".$row["pending Order"]."</td>";
            print "<td>".$row["Pending Complaints"]."</td>";
            print "<td>&#x20B9 ".$BalanceGST."</td>";  
            print "</tr>";


        }
        ?>
    </tbody>                 
</table>
<br>
<table class="table-hover table-sm table-bordered border-primary" id="userTable2" class="display nowrap">
    <h4 class="font-weight-bold text-center text-xl-center">Total pending AMC </h4>
    <thead> 
        <tr> 
            <th>Bank</th> 
            <th>Zone</th> 
            <th>Branch</th> 
            <th>District</th> 
            <th>AMCID</th>
            <th>Discription</th>
            <th>Posted On</th>
            <th>Assigned On</th>
        </tr>                     
    </thead>                 
    <tbody> 
        <?php
        date_default_timezone_set('Asia/Kolkata');
        $timestamp =date('y-m-d H:i:s');
        $newtimestamp = date('Y-m-d',strtotime($timestamp));
                    //echo $newtimestamp;
        
        $sql ="SELECT * FROM `vpendingamc`
        join gadget on vpendingamc.GadgetID=gadget.GadgetID
        where `EmployeeCode`=".$UID." and Attended=0 and `AssignDate` is not null
        Order by BranchName";
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }  
        $results = $con->query($sql); 
        while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){
            $orgDate = $row["AssignDate"];  
            $date = str_replace('-"', '/', $orgDate);  
            $AssignDate = date("d/m/y", strtotime($date));  
            $Bankname=$row["BankName"];
            $PDate = $row["DateOfInformation"];  
            $date = str_replace('-"', '/', $PDate);  
            $PostedDate = date("d/m/y", strtotime($date));
                        //echo "New date format is: ".$newDate. " (YYYY/MM/DD)";  

            $dedline = date('Y-m-d', strtotime($orgDate. ' + 90 days'));

            $datetime1 = date_create($newtimestamp);
            $datetime2 = date_create($dedline);

            $interval = date_diff($datetime1, $datetime2);
            $d= $interval->format('%R%a');
                       // echo $d;
            $int = (int)$d;
                        //echo $int.'..';
            if ($int<0) {
                            // code...
                $Bankname= '<span style="color: red;">'.$Bankname.'</span>';
            }
            if ($int<=59) {
                            // code...
                $Bankname= '<span style="color: blue;">'.$Bankname.'</span>';
            }
            $ZoneCode=$row["ZoneRegionCode"];
            $Gadget=$row["Gadget"];
            $sql ="SELECT datediff(EndDate, StartDate) as days, visits, StartDate, EndDate FROM cyrusbackend.amcs WHERE ZoneRegionCode=$ZoneCode and Device='$Gadget' and datediff(EndDate, current_date())>=0";
            $resultAMC=mysqli_query($con,$sql);
            $row2=mysqli_fetch_array($resultAMC,MYSQLI_ASSOC);
            $D=0;
            $Q1='';
            if (!empty($row2["StartDate"])) {

             $D= round($row2["days"]/$row2["visits"]);
             $SDate=date('d-m-Y',strtotime($row2["StartDate"]));
             $Q=date('d-m-Y', strtotime($SDate. ' + '.$D.' days'));

             for ($i=0; $i < $row2["visits"]; $i++) { 

               if (date_create($Q)>=date_create($DateQ)) {
                   
                   $duration=$SDate.' to '.$Q;
                   break;
               }else{
                $SDate=$Q;
                $Q=date('d-m-Y', strtotime($SDate. ' + '.$D.' days'));
               }  
           }

       }


       print "<tr>";
       print "<td >".$Bankname."</td>";
       print "<td>".$row["ZoneRegionName"]."</td>";
       print "<td>".$row["BranchName"]."</td>";
       print "<td>".$row["Address3"]."</td>";
                    //print "<td>".$row["OrderID"]."</td>";
       print "<td><a href=\"card.php?oid=&amcid=" . $row['OrderID'] . "&cid=&eid=".$UID ."&brcode=".$row["BranchCode"]."&zcode=".$row["ZoneRegionCode"]."&gid=".$row["GadgetID"]."&PostedDate=".$row["DateOfInformation"]."\">".$row["OrderID"]."</a></td>";
       print "<td>".$row["Discription"]. ' Duration '.$duration."</td>";
       print "<td>".$PostedDate."</td>";
       print "<td>".$AssignDate."</td>";
       print "</tr>";

   }
   ?>
</tbody>                 
</table>
<br>
<table class="table-bordered border-primary table-hover table-sm" id="userTable3" class="display nowrap">
    <h4 class="font-weight-bold text-center text-xl-center">Total pending Orders </h4>
    <thead> 
        <tr> 
            <th>Bank</th> 
            <th>Zone</th> 
            <th>Branch</th> 
            <th>District</th> 
            <th>OrderID</th>
            <th>Discription</th>
            <th>Posted On</th>
            <th>Assigned On</th>
        </tr>                     
    </thead>                 
    <tbody> 
        <?php
        
        $sql ="SELECT * FROM `vpendingorders` where `EmployeeCode`=".$UID." and Attended=0 and `AssignDate` is not null Order by BranchName";
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        } 
                    //$org = ''; 
        $results = $con->query($sql); 
        while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){
            $orgDate = $row["AssignDate"];  
            $date = str_replace('-"', '/', $orgDate);  
            $AssignDate = date("d/m/y", strtotime($date));  
            $Bank=$row["BankName"];
            $PDate = $row["DateOfInformation"];  
            $date = str_replace('-"', '/', $PDate);  
            $PostedDate = date("d/m/y", strtotime($date));

            $Zone = $row["ZoneRegionName"];
            $ZoneCode = $row["ZoneRegionCode"];
                        //echo $Zone;
            $sql3 ="SELECT * FROM zoneregions where ZoneRegionCode='$ZoneCode'";
            $results3 = $con->query($sql3); 
            $row3=mysqli_fetch_assoc($results3);
            $ZoneCode=$row3["ZoneRegionCode"];

            $dedline = date('Y-m-d', strtotime($orgDate. ' + 7 days'));

            $datetime1 = date_create($newtimestamp);
            $datetime2 = date_create($dedline);

            $interval = date_diff($datetime1, $datetime2);
            $d= $interval->format('%R%a');
                        //echo $dedline;
            $int = (int)$d;
                       //echo $int.'...';
            if ($int<0) {
                            // code...
                $Bank= '<span style="color: red;">'.$Bank.'</span>';
            }
            if ($int<1) {
                            // code...
                $Bank= '<span style="color: blue;">'.$Bank.'</span>';
            }

            print "<tr>";
            print "<td>".$Bank."</td>";
            print "<td>".$row["ZoneRegionName"]."</td>";
            print "<td>".$row["BranchName"]."</td>";
            print "<td>".$row["Address3"]."</td>";
                    //print "<td>".$row["OrderID"]."</td>";
            print "<td><a href=\"card.php?amcid=&oid=" . $row['OrderID'] . "&cid=&eid=".$UID ."&brcode=".$row["BranchCode"]."&zcode=".$ZoneCode."&gid=".$row["GadgetID"]."&PostedDate=".$row["DateOfInformation"]."\">".$row["OrderID"]."</a></td>";
            print "<td>".$row["Discription"]."</td>";
            print "<td>".$PostedDate."</td>";
            print "<td>".$AssignDate."</td>";
            print "</tr>";

        }
        ?>
    </tbody>                 
</table>
<br>
<table class="table-bordered border-primary table-hover table-sm" id="userTable4" class="display nowrap">
    <h4 class="font-weight-bold text-center text-xl-center">Total pending Complaints </h4>
    <thead> 
        <tr> 
            <th>Bank</th> 
            <th>Zone</th> 
            <th>Branch</th> 
            <th>District</th> 
            <th>ComplaintID</th>
            <th>Discription</th>
            <th>Posted On</th>
            <th>Assigned On</th>
        </tr>                     
    </thead>                 
    <tbody> 
        <?php
        
        $sql ="SELECT * FROM `vpendingcomplaints` where `EmployeeCode`=".$UID." and Attended=0 and `AssignDate` is not null Order by BranchName";
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }  
        $results = $con->query($sql); 
        while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){

            $org = $row["AssignDate"];
                        //echo $row["AssignDate"].' .... ';
            $date = str_replace('-"', '/', $org);  
            $AssignDate = date("d/m/Y", strtotime($date));  

            $PDate = $row["DateOfInformation"];  
            $date = str_replace('-"', '/', $PDate);  
            $PostedDate = date("d/m/y", strtotime($date));

            $BankName=$row["BankName"];
            $Zone = $row["ZoneRegionName"];
            $BranchCode = $row["BranchCode"];
                      //echo $orgDate;

            $sql2 ="SELECT * FROM branchs where BranchCode='$BranchCode'";
            $results2 = $con->query($sql2); 
            $row2=mysqli_fetch_assoc($results2);
            $ZoneCode=$row2["ZoneRegionCode"];
                     // echo "; ";
                      //echo $ZoneCode;

            $ded = date('Y-m-d', strtotime($org. ' + 2 days'));

            $datetime1 = date_create($newtimestamp);
            $datetime2 = date_create($ded);
                        //echo $datetime1.'..';
                        //echo $datetime2.'....';

            $interva = date_diff($datetime1, $datetime2);
            $de= $interva->format('%R%a');
                        //echo $de;
            $int = (int)$de;
                        //echo $ded.'... ';
                        //echo $int.'... ';
            if ($int<0) {
                            // code...
                $BankName= '<span style="color: red;">'.$BankName.'</span>';
            }
            if ($int<1) {
                            // code...
                $BankName= '<span style="color: blue;">'.$BankName.'</span>';
            }

            print "<tr>";
            print "<td>".$BankName."</td>";
            print "<td>".$row["ZoneRegionName"]."</td>";
            print "<td>".$row["BranchName"]."</td>";
            print "<td>".$row["Address3"]."</td>";
                    //print "<td>".$row["ComplaintID"]."</td>";
            print "<td><a href=\"card.php?amcid=&cid=" . $row['ComplaintID'] . "&oid=&eid=".$UID ."&brcode=".$row["BranchCode"]."&zcode=".$ZoneCode."&gid=".$row["GadgetID"]."&PostedDate=".$row["DateOfInformation"]."\">".$row["ComplaintID"]."</a></td>";
            print "<td>".$row["Discription"]."</td>";
            print "<td>".$PostedDate."</td>";
            print "<td>".$AssignDate."</td>";
            print "</tr>";
            $org='';}
            ?>
        </tbody>                 
    </table>


    <br>
    <table class="table-bordered border-primary table-hover table-sm" id="userTable5" class="display nowrap">
        <h4 class="font-weight-bold text-center text-xl-center">Total Rejected Orders</h4>
        <thead> 
            <tr> 
                <th>Bank</th> 
                <th>Zone</th> 
                <th>Branch</th> 
                <th>District</th> 
                <th>ComplaintID</th>
                <th>Discription</th>
                <th>Posted On</th>
                <th>Assigned On</th>
            </tr>                     
        </thead>                 
        <tbody> 
            <?php
            
            $sql ="SELECT * FROM cyrusbackend.approval
            left join orders on approval.OrderID=orders.OrderID
            join branchdetails on orders.BranchCode=branchdetails.BranchCode
            WHERE Vremark='REJECTED' and Attended=0 and EmployeeCode=$UID group by approval.OrderID";
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }  
            $results = $con->query($sql); 
            while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){

                $org = $row["AssignDate"];
                        //echo $row["AssignDate"].' .... ';
                $date = str_replace('-"', '/', $org);  
                $AssignDate = date("d/m/Y", strtotime($date));  

                $PDate = $row["DateOfInformation"];  
                $date = str_replace('-"', '/', $PDate);  
                $PostedDate = date("d/m/y", strtotime($date));

                $BankName=$row["BankName"];
                $Zone = $row["ZoneRegionName"];
                $BranchCode = $row["BranchCode"];
                      //echo $orgDate;

                $sql2 ="SELECT * FROM branchs where BranchCode='$BranchCode'";
                $results2 = $con->query($sql2); 
                $row2=mysqli_fetch_assoc($results2);
                $ZoneCode=$row2["ZoneRegionCode"];
                     // echo "; ";
                      //echo $ZoneCode;

                $ded = date('Y-m-d', strtotime($org. ' + 2 days'));

                $datetime1 = date_create($newtimestamp);
                $datetime2 = date_create($ded);
                        //echo $datetime1.'..';
                        //echo $datetime2.'....';

                $interva = date_diff($datetime1, $datetime2);
                $de= $interva->format('%R%a');
                        //echo $de;
                $int = (int)$de;
                        //echo $ded.'... ';
                        //echo $int.'... ';
                if ($int<0) {
                            // code...
                    $BankName= '<span style="color: red;">'.$BankName.'</span>';
                }
                if ($int<1) {
                            // code...
                    $BankName= '<span style="color: blue;">'.$BankName.'</span>';
                }

                print "<tr>";
                print "<td>".$BankName."</td>";
                print "<td>".$row["ZoneRegionName"]."</td>";
                print "<td>".$row["BranchName"]."</td>";
                print "<td>".$row["Address3"]."</td>";
                    //print "<td>".$row["ComplaintID"]."</td>";
                print "<td><a href=\"card.php?amcid=&oid=" . $row['OrderID'] . "&cid=&eid=".$UID ."&brcode=".$row["BranchCode"]."&zcode=".$ZoneCode."&gid=".$row["GadgetID"]."&PostedDate=".$row["DateOfInformation"]."\">".$row["OrderID"]."</a></td>";
                print "<td>".$row["Discription"]."</td>";
                print "<td>".$PostedDate."</td>";
                print "<td>".$AssignDate."</td>";
                print "</tr>";
                $org='';}
                ?>
            </tbody>                 
        </table>



        <table class="table-bordered border-primary table-hover table-sm" id="userTable6" class="display nowrap">
            <h4 class="font-weight-bold text-center text-xl-center">Total Rejected Complaints </h4>
            <thead> 
                <tr> 
                    <th>Bank</th> 
                    <th>Zone</th> 
                    <th>Branch</th> 
                    <th>District</th> 
                    <th>ComplaintID</th>
                    <th>Discription</th>
                    <th>Posted On</th>
                    <th>Assigned On</th>
                </tr>                     
            </thead>                 
            <tbody> 
                <?php
                
                $sql ="SELECT * FROM cyrusbackend.approval
                left join complaints on approval.ComplaintID=complaints.ComplaintID
                join branchdetails on complaints.BranchCode=branchdetails.BranchCode
                WHERE Vremark='REJECTED' and Attended=0 and EmployeeCode=$UID group by approval.ComplaintID";
                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }  
                $results = $con->query($sql); 
                while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){

                    $org = $row["AssignDate"];
                        //echo $row["AssignDate"].' .... ';
                    $date = str_replace('-"', '/', $org);  
                    $AssignDate = date("d/m/Y", strtotime($date));  

                    $PDate = $row["DateOfInformation"];  
                    $date = str_replace('-"', '/', $PDate);  
                    $PostedDate = date("d/m/y", strtotime($date));

                    $BankName=$row["BankName"];
                    $Zone = $row["ZoneRegionName"];
                    $BranchCode = $row["BranchCode"];
                      //echo $orgDate;

                    $sql2 ="SELECT * FROM branchs where BranchCode='$BranchCode'";
                    $results2 = $con->query($sql2); 
                    $row2=mysqli_fetch_assoc($results2);
                    $ZoneCode=$row2["ZoneRegionCode"];
                     // echo "; ";
                      //echo $ZoneCode;

                    $ded = date('Y-m-d', strtotime($org. ' + 2 days'));

                    $datetime1 = date_create($newtimestamp);
                    $datetime2 = date_create($ded);
                        //echo $datetime1.'..';
                        //echo $datetime2.'....';

                    $interva = date_diff($datetime1, $datetime2);
                    $de= $interva->format('%R%a');
                        //echo $de;
                    $int = (int)$de;
                        //echo $ded.'... ';
                        //echo $int.'... ';
                    if ($int<0) {
                            // code...
                        $BankName= '<span style="color: red;">'.$BankName.'</span>';
                    }
                    if ($int<1) {
                            // code...
                        $BankName= '<span style="color: blue;">'.$BankName.'</span>';
                    }

                    print "<tr>";
                    print "<td>".$BankName."</td>";
                    print "<td>".$row["ZoneRegionName"]."</td>";
                    print "<td>".$row["BranchName"]."</td>";
                    print "<td>".$row["Address3"]."</td>";
                    //print "<td>".$row["ComplaintID"]."</td>";
                    print "<td><a href=\"card.php?amcid=&cid=" . $row['ComplaintID'] . "&oid=&eid=".$UID ."&brcode=".$row["BranchCode"]."&zcode=".$ZoneCode."&gid=".$row["GadgetID"]."&PostedDate=".$row["DateOfInformation"]."\">".$row["ComplaintID"]."</a></td>";
                    print "<td>".$row["Discription"]."</td>";
                    print "<td>".$PostedDate."</td>";
                    print "<td>".$AssignDate."</td>";
                    print "</tr>";
                    $org='';}
                    ?>
                </tbody>                 
            </table>

        </div>


        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
        "></script>

        <script>

            $(document).ready(function() {
                var table = $('#example').DataTable( {
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
                } );
            } );

            $(document).ready(function() {
               var table = $('#userTable2').DataTable( {
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            } );
           } );

            $(document).ready(function() {
                var table = $('#userTable3').DataTable( {
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
                } );
            } );

            $(document).ready(function() {
                var table = $('#userTable4').DataTable( {
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
                } );
            } );

            $(document).ready(function() {
                var table = $('#userTable5').DataTable( {
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
                } );
            } );
            $(document).ready(function() {
                var table = $('#userTable6').DataTable( {
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
                } );
            } );
        </script>

        <script type="text/javascript">

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            google.charts.setOnLoadCallback(drawChart2);
            google.charts.setOnLoadCallback(drawChart3);
            google.charts.setOnLoadCallback(drawChart4);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                  ['Pending', 'Achieved'],
                  ['Pending : '+ <?php echo $PendingTarget?>, <?php echo $PendingTarget?>],
                  ['Billed : '+<?php echo $BilledAmount?>, <?php echo $BilledAmount?>]
                  ]);


              var options = {
                'title':'Billing Target : ' + <?php echo $Target?>,
                colors: ['red', 'green', ],
                fontSize: 15,
                chartArea: {
                    left: "10%",
                    top: "20%",
                    bottom: "10%",
                    height: "90%",
                    width: "90%",

                }

            };


            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }

    </script>
</body>
</html>

<?php 
$con->close();
$con2->close();
?>