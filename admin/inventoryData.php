
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
    <title>Pending at Inventory</title>
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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

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


            <div class="modal fade" data-bs-backdrop="static" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Materials</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div id="material">

                      </div>
                      <br>
                      <form id="f1">
                        <div class="col-lg-3">
                          <input type="number" name="" id="order_id" class="d-none form-control">
                      </div>
                      <div class="col-lg-3">
                          <input type="number" name="" id="zone_code" class="d-none form-control">
                      </div>
                      <div class="row text-centered">
                          <div class="col-lg-5">
                            <center>
                              <label >Select Items</label>
                          </center>
                          <select id="ItemID" class="form-control my-select3" name="Items" required>
                              <option value="">Select</option>
                          </select>
                      </div>
                      <div class="col-lg-5">
                        <center>
                          <label>Enter Quantity</label>
                      </center>
                      <input type="number" name="" id="qty" class="form-control my-select3" onkeydown="limit(this);" onkeyup="limit(this);">
                  </div>
                  <div class="col-lg-2">
                    <center>
                      <label></label>
                      <br>
                  </center>
                  <button type="button" class="btn btn-primary btn-lg addUpdateItems">Add</button>
              </div>

          </div>
      </form>
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary confirmUpdate cl">Confirm</button>
  </div>
</div>
</div>
</div>

<!-- Recent Orders Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">

            <h6 class="mb-0">Pending Material Confirmation at Inventory</h6>

        </div>
        <div class="table-responsive">
            <table class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" style="min-width:100px">Order ID</th>
                        <th scope="col" style="min-width:200px">Bank</th>
                        <th scope="col" style="min-width:200px">Zone</th>
                        <th scope="col" style="min-width:200px">Branch</th>                       
                        <th scope="col" style="min-width:300px">Description</th>
                    </tr>
                </thead>
                <tbody>
                 <?php 

                 $query2="SELECT * FROM demandbase 
                 join orders on demandbase.OrderID=orders.OrderID
                 join branchdetails on orders.BranchCode=branchdetails.BranchCode 
                 join districts on branchdetails.Address3=districts.district
                 join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                 where demandbase.StatusID=2 and ControlerID=$EXEID Order By demandbase.OrderID desc";
                 $result2=mysqli_query($con,$query2);

                 if (mysqli_num_rows($result2)>0)
                 {
                    $Sn=1;

                    while($row = mysqli_fetch_array($result2)){
                      echo '<input class="d-none" type="text" id="'.$row['OrderID'].'" value="'.$row["ZoneRegionCode"].'" name="">';
                      ?>

                      <tr>
                        <td style="color: blue;" class="inventory" id="<?php echo $row['OrderID']; ?>" data-bs-toggle="modal" data-bs-target="#InventoryPending" ><?php echo $row['OrderID']; ?></td>
                        <td ><?php echo $row['BankName']; ?></td>
                        <td ><?php echo $row['ZoneRegionName']; ?></td>
                        <td ><?php echo $row['BranchName']; ?></td>
                        <td><?php echo $row['Discription']; ?></td>

                    </tr>
                    <?php
                    $Sn++;
                }

                $con->close();
                $con2->close();
            }
            ?>
        </tbody>
    </table>
</div>
</div>
<!-- Recent Orders End -->
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
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
    $(document).ready(function() {
      $('table.display').DataTable( {
        responsive: true,
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal( {
              header: function ( row ) {
                var data = row.data();
                return 'Details for '+data[0]+' '+data[1];
            }
        } ),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
              tableClass: 'table'
          } )
        }
    },
    stateSave: true,
} );
  } );

  var exampleModal = document.getElementById('editQty')
  exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var ItemID = button.getAttribute('data-bs-ItemID')
  console.log(ItemID);
  document.getElementById("ItemIDUpdate").value = ItemID;

})

  var exampleModal = document.getElementById('add')
  exampleModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var ID = button.getAttribute('data-bs-orderid')
    var ZoneCode=button.getAttribute('data-bs-zonecode')
      //console.log(recipient);
      //document.getElementById("orderid").value = ID;
      //document.getElementById("ZoneCode").value = ZoneCode;
    })


  $(document).on('click', '.cl', function(){

    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      location.reload();
    }, delayInMilliseconds);


  });

  function limit(element)
  {
    var max_chars = 5;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }
</script>
</body>

</html>