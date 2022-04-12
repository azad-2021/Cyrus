
<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');
//echo $_SESSION['user'];


if ( $Hour >= 1 && $Hour <= 11 ) {
    $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
    $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
    $wish= "Good Evening ".$_SESSION['user'];
}


$query="SELECT count(orders.OrderID) as PendingMaterials
FROM cyrusbackend.orders join demandbase on orders.OrderID=demandbase.OrderID
join branchdetails on orders.BranchCode=branchdetails.BranchCode
join districts on branchdetails.Address3=districts.district
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE demandbase.StatusID=1 and ControlerID=$EXEID order by DateOfInformation";

$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$PendingMaterials=$row["PendingMaterials"];


$query="SELECT  sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
join cyrusbackend.districts on billbook.EmployeeCode=districts.`Assign To`
join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and ControlerID=$EXEID and BankName!='Cyrus'";

$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$PendingPayment=$row["TotalAmount"]-$row["ReceiveAMOUNT"];



$sql ="SELECT sum(`Pending Order`) as PendingOrders, sum(`Pending Complaints`) as PendingComplaints, sum(`Pending AMC`) as PendingAMC, `Employee Name` FROM cyrusbackend.pendingwork
join districts on pendingwork.Address3=districts.District
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE ControlerID=$EXEID group by EmployeeCode;";

$result = mysqli_query($con,$sql);
$TotalPendingWork=0;
while ($row = mysqli_fetch_array($result)) { 

    $PendingWork  = $row['PendingOrders']+$row['PendingComplaints']+$row['PendingAMC'];
    $Employee = $row['Employee Name'];
    $data[]=array("Work"=>$PendingWork, "Employee"=>$Employee);

    $TotalPendingWork=$TotalPendingWork+$PendingWork;
}
rsort($data);



$query="SELECT `Employee Name`, employees.EmployeeCode FROM cyrusbackend.employees
join districts on employees.EmployeeCode=districts.`Assign To`
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
where ControlerID=$EXEID
group by employees.EmployeeCode
order by `Employee Name`;";

$resultTech=mysqli_query($con,$query);
while($rowE=mysqli_fetch_assoc($resultTech)){
    $Employee=$rowE["Employee Name"];
    $EmployeeID=$rowE["EmployeeCode"];
    $query="SELECT count(ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.vallcomplaintsd WHERE AssignDate is null and Attended=0 and EmployeeCode=$EmployeeID";
    $result=mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);

    $query2="SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE vallordersd.AssignDate is null and vallordersd.Discription like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
    $result2=mysqli_query($con,$query2);
    $row2 = mysqli_fetch_array($result2);

    $query3 = "SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE AssignDate is null and Discription not like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
    $result3 = mysqli_query($con, $query3);
    $row3 = mysqli_fetch_array($result3);



    $PendingWorkE= $row3["count(vallordersd.OrderID)"] + $row["count(ComplaintID)"] + $row2["count(vallordersd.OrderID)"];            
    $data2[]=array("Unassigned"=>$PendingWorkE, "Employee"=>$Employee);
}
rsort($data2);
//print_r($data2);

$sql ="SELECT BankName, ZoneRegionName, EmployeeCode,  BranchName, BookNo, BankCode, ZoneRegionCode, BillDate, sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
join cyrusbackend.districts on billbook.EmployeeCode=districts.`Assign To`
join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and ControlerID=$EXEID and BankName!='Cyrus'
group by BankCode, ZoneRegionCode
ORDER BY BankName";

$result = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($result)) { 

    $PendingBill  = $row['TotalAmount']-$row['ReceiveAMOUNT'];
    $Bankarr = $row['BankName'].' '.$row['ZoneRegionName'];
    $data3[]=array("Payment"=>$PendingBill, "Bank"=>$Bankarr);
}
rsort($data3);





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <?php 
        include"modals.php";
        ?>
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        <?php 
        include"sidebar.php";
        ?>
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include"nav.php" ?>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2" style="font-size: 13.6px;">Total Pending Material Confirmation</p>
                                <h6 class="mb-0"><?php echo $PendingMaterials; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Pending Payment</p>
                                <h6 class="mb-0">&#x20B9 <?php echo $PendingPayment; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-industry fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Pending Work</p>
                                <h6 class="mb-0"><?php echo $TotalPendingWork; ?></h6>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                -->
            </div>
        </div>
        <!-- Sale & Revenue End -->


        <!-- Sales Chart Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Pending Work</h6>
                            <a href="PendingWork.php" target="_blank">Show All</a>
                        </div>
                        <canvas id="PendingWork"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Unassigned Work</h6>
                            <a href="UnassignedWork.php" target="_blank">Show All</a>
                        </div>
                        <canvas id="unassigned"></canvas>
                    </div>
                </div>
            </div>
            <br>
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Pending Payment</h6>
                            <a href="PendingPayment.php" target="_blank">Show All</a>
                        </div>
                        <canvas id="PendingPayment"></canvas>
                    </div>
                </div>
                    <!--
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Salse & Revenue</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="salse-revenue"></canvas>
                        </div>
                    </div>
                -->
            </div>

        </div>
        <!-- Sales Chart End -->


        <!-- Recent Orders Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Recent Placed Orders</h6>
                    <a href="">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col" style="min-width:200px">Bank</th>
                                <th scope="col" style="min-width:200px">Zone</th>
                                <th scope="col" style="min-width:200px">Branch</th>
                                <th scope="col" style="min-width:100px">Order ID</th>
                                <th scope="col" style="min-width:300px">Description</th>
                                <th scope="col" style="min-width:150px">Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql ="SELECT BankName, ZoneRegionName, BranchName, OrderID, Discription, DateOfInformation FROM cyrusbackend.orders
                            join branchdetails on orders.BranchCode=branchdetails.BranchCode
                            join districts on branchdetails.Address3=districts.District
                            join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                            WHERE ControlerID=$EXEID and AssignDate is null
                            Order by DateOfInformation desc limit 10";

                            $result = mysqli_query($con,$sql);
                            while ($row = mysqli_fetch_array($result)) { 
                             ?>
                             <tr>

                                <td><?php echo $row["BankName"]; ?></td>
                                <td><?php echo $row["ZoneRegionName"]; ?></td>
                                <td><?php echo $row["BranchName"]; ?></td>
                                <td><?php echo $row["OrderID"]; ?></td>
                                <td><?php echo $row["Discription"]; ?></td>
                                <td><?php echo $row["DateOfInformation"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Orders End -->

    <!-- Recent Comlaints Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Placed Complaints</h6>
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col" style="min-width:200px">Bank</th>
                            <th scope="col" style="min-width:200px">Zone</th>
                            <th scope="col" style="min-width:200px">Branch</th>
                            <th scope="col" style="min-width:120px">Complaint ID</th>
                            <th scope="col" style="min-width:300px">Description</th>
                            <th scope="col" style="min-width:150px">Complaint Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql ="SELECT BankName, ZoneRegionName, BranchName, ComplaintID, Discription, DateOfInformation FROM cyrusbackend.complaints
                        join branchdetails on complaints.BranchCode=branchdetails.BranchCode
                        join districts on branchdetails.Address3=districts.District
                        join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                        WHERE ControlerID=$EXEID and AssignDate is null
                        Order by DateOfInformation desc limit 10";

                        $result = mysqli_query($con,$sql);
                        while ($row = mysqli_fetch_array($result)) { 
                         ?>
                         <tr>

                            <td><?php echo $row["BankName"]; ?></td>
                            <td><?php echo $row["ZoneRegionName"]; ?></td>
                            <td><?php echo $row["BranchName"]; ?></td>
                            <td><?php echo $row["ComplaintID"]; ?></td>
                            <td><?php echo $row["Discription"]; ?></td>
                            <td><?php echo $row["DateOfInformation"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Widgets Start -->
        <!--
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0">Messages</h6>
                            <a href="">Show All</a>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-3">
                            <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">Jhon Doe</h6>
                                    <small>15 minutes ago</small>
                                </div>
                                <span>Short message goes here...</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-3">
                            <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">Jhon Doe</h6>
                                    <small>15 minutes ago</small>
                                </div>
                                <span>Short message goes here...</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-3">
                            <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">Jhon Doe</h6>
                                    <small>15 minutes ago</small>
                                </div>
                                <span>Short message goes here...</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center pt-3">
                            <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">Jhon Doe</h6>
                                    <small>15 minutes ago</small>
                                </div>
                                <span>Short message goes here...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Calender</h6>
                            <a href="">Show All</a>
                        </div>
                        <div id="calender"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">To Do List</h6>
                            <a href="">Show All</a>
                        </div>
                        <div class="d-flex mb-2">
                            <input class="form-control bg-transparent" type="text" placeholder="Enter task">
                            <button type="button" class="btn btn-primary ms-2">Add</button>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <input class="form-check-input m-0" type="checkbox">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <input class="form-check-input m-0" type="checkbox">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <input class="form-check-input m-0" type="checkbox" checked>
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span><del>Short task goes here...</del></span>
                                    <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <input class="form-check-input m-0" type="checkbox">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center pt-2">
                            <input class="form-check-input m-0" type="checkbox">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    -->
    <!-- Widgets End -->


    <!-- Footer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-12 text-center text-sm-start">
                    <center>
                        &copy; <a href="">Cyrus</a>, All Right Reserved. 
                    </center>
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script type="text/javascript">

    var barColors = ["#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff"];
    var hoverBackground='rgba(200, 200, 200, 1)';
    var hoverBorder='rgba(200, 200, 200, 1)';

        // Pending Work

        var data= <?php print_r(json_encode($data)); ?>;

        var Employee = [];
        var PendingWork = [];

        for(var i = 0; i < 10; i++) {
            Employee.push(data[i].Employee);
            PendingWork.push(data[i].Work);
        }

        var xValuesP = Employee;
        var ctx1 = $("#PendingWork").get(0).getContext("2d");
        var myChart1 = new Chart(ctx1, {
            type: "bar",
            data: {
                labels: xValuesP,
                datasets: [{
                    label: "Pending Work",
                    data: PendingWork,
                    backgroundColor: barColors
                }
                ]
            },
            options: {
                responsive: true
            }
        });


        var data2= <?php print_r(json_encode($data2)); ?>;

        var EmployeeE = [];
        var unassigned = [];

        for(var i = 0; i < 10; i++) {
            EmployeeE.push(data2[i].EmployeeE);
            unassigned.push(data2[i].Unassigned);
        }

        var xValuesP = Employee;
        var ctx2 = $("#unassigned").get(0).getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "bar",
            data: {
                labels: xValuesP,
                datasets: [{
                    label: "Unassigned Work",
                    data: unassigned,
                    backgroundColor: barColors
                }
                ]
            },
            options: {
                responsive: true
            }
        });
        

/*

        var ctx2 = $("#salse-revenue").get(0).getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
                datasets: [{
                    label: "Salse",
                    data: [15, 30, 55, 45, 70, 65, 85],
                    backgroundColor: "rgba(0, 156, 255, .5)",
                    fill: true
                },
                {
                    label: "Revenue",
                    data: [99, 135, 170, 130, 190, 180, 270],
                    backgroundColor: "rgba(0, 156, 255, .3)",
                    fill: true
                }
                ]
            },
            options: {
                responsive: true
            }
        });

        */

    // Single Bar Chart

    var data3= <?php print_r(json_encode($data3)); ?>;
    
    var Bankarr = [];
    var PendingBills = [];

    for(var i = 0; i < 10; i++) {
        Bankarr.push(data3[i].Bank);
        PendingBills.push(data3[i].Payment);
    }

    var xValues = Bankarr;

    var ctx4 = $("#PendingPayment").get(0).getContext("2d");
    var myChart4 = new Chart(ctx4, {
        type: "bar",
        data: {

            labels: xValues,
            datasets: [{
                label: "Pending Payments in your area Group By Bank & Zone",
                backgroundColor: barColors,
                data: PendingBills
            }]
        },
        options: {
            responsive: true
        }
    });


    // Pie Chart
    var ctx5 = $("#pie-chart").get(0).getContext("2d");
    var myChart5 = new Chart(ctx5, {
        type: "pie",
        data: {
            labels: ["Italy", "France", "Spain", "USA", "Argentina"],
            datasets: [{
                backgroundColor: [
                "rgba(0, 156, 255, .7)",
                "rgba(0, 156, 255, .6)",
                "rgba(0, 156, 255, .5)",
                "rgba(0, 156, 255, .4)",
                "rgba(0, 156, 255, .3)"
                ],
                data: [55, 49, 44, 24, 15]
            }]
        },
        options: {
            responsive: true
        }
    });


    // Doughnut Chart
    var ctx6 = $("#doughnut-chart").get(0).getContext("2d");
    var myChart6 = new Chart(ctx6, {
        type: "doughnut",
        data: {
            labels: ["Italy", "France", "Spain", "USA", "Argentina"],
            datasets: [{
                backgroundColor: [
                "rgba(0, 156, 255, .7)",
                "rgba(0, 156, 255, .6)",
                "rgba(0, 156, 255, .5)",
                "rgba(0, 156, 255, .4)",
                "rgba(0, 156, 255, .3)"
                ],
                data: [55, 49, 44, 24, 15]
            }]
        },
        options: {
            responsive: true
        }
    });

    


</script>
</body>

</html>