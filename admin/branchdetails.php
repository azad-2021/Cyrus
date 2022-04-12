
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

    <style type="text/css">
    table.scrolldown {
        width: 100%;

        /* border-collapse: collapse; */
        border-spacing: 0;
        border: 2px solid black;
    }

    /* To display the block as level element */
    table.scrolldown tbody, table.scrolldown thead {
        display: block;
    } 

    thead tr th {
        height: 40px; 
        line-height: 40px;
    }

    table.scrolldown tbody {

        /* Set the height of table body */
        height: 150px; 

        /* Set vertical scroll */
        overflow-y: auto;

        /* Hide the horizontal scroll */
        overflow-x: hidden; 
    }
    td,th{
        min-width: 200px;
        font-size: 18px;
    }
</style> 

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
            <div class="container
            ">
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


<div class="modal fade" id="ViewVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">VAT Bill details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" id="VATData">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>


<div class="modal fade" id="ViewGST" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">GST Bill Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" id="GSTData">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>


<div class="col-lg-12 container" >
  <br>
  <h4 align="center" style="margin-bottom: 20px">Branch Details</h4>
  <div class="row lg-12" id="BranchData">
  </div>
</div>


<div class="col-lg-12" style="margin: 12px; overflow: auto;">
  <table class="table table-hover table-bordered border-primary scrolldown table-responsive"> 
    <h5 style="margin: 2px; text-align: center;">Orders</h5>
    <thead> 
      <tr> 
        <th>Order ID</th>
        <th>Information Date</th>

        <th >Attended</th>
        <th >Visit Date</th>

        <th >Gadget</th>                        
        <th >Assign Date</th>                            
        <th >Call Verified</th>   
        <th >Employee</th>
        <th style="min-width:500px">Discription</th> 
        <th style="min-width:500px">Executive Remark</th>

    </tr>                     
</thead>               
<tbody id="Order">

</tbody>
</table>
</div>
<div class="col-lg-12" style="margin: 12px; overflow: auto;">
  <table class="table scrolldown table table-hover table-bordered border-primary"> 
    <h5 style="margin: 5px; text-align: center;">Complaints</h5>
    <thead> 
      <tr> 
        <th >Complaint ID</th>
        <th >Information Date</th>
        <th >Attended</th>
        <th>Date of Visit</th>           
        <th >Gadget</th>            
        <th >Assign Date</th>
        <th >Call Verified</th>             
        <th>Employee</th>
        <th style="min-width: 500px;">Discription</th> 
        <th style="min-width: 500px;">Executive Remark</th>

    </tr>                     
</thead>                 
<tbody id="Complaints" > 

</tbody>
</table> 
</div>
<div class="col-lg-12" style="margin: 12px; overflow: auto;">
  <table class="display table table-hover table-bordered border-primary scrolldown" id="resizeMe3">
    <h5 style="margin: 2px; text-align: center;">Jobcard</h5>
    <thead> 
      <tr> 
        <th>Jobcard Number</th>
        <th>Date of Visit</th>
        <th>Gadget</th>
        <th>Employee</th>
        <th style="min-width: 800px;">Service Done</th>
        <th style="min-width: 800px;">Pending Work</th>   
    </tr>                     
</thead>                 
<tbody id="jobcard"> 

</tbody>
</table>   
</div>

</div>
<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-12 text-center text-sm-start">
                <center>
                    &copy; <a href="">Cyrus</a>, All Right Reserved. 
                </center>
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