
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

            <!-- Recent Comlaints Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Multi-Orders Confirmation</h6>
                    </div>
                    <div class="modal fade" data-bs-backdrop="static" id="AddMulti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Materials</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table" id="myTable">
                              <thead>
                                <tr class="w3-blue">
                                  <th nowrap>Sl.No</th>      
                                  <th nowrap>Rate ID</th>      
                                  <th nowrap>Quantity</th>
                                  <th nowrap>Action</th>
                              </tr>
                          </thead>
                          <tbody >
                          </tbody>
                      </table>
                      <br>
                      <form id="f1">
                          <div class="row text-centered">
                            <div class="col-lg-5">
                              <center>
                                <label >Select Items</label>
                            </center>
                            <select id="MaterialView" class="form-control my-select3" name="Items" required>
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
                    <button type="button" class="btn btn-primary btn-lg" id="save">Add</button>
                </div>
                <div class="col-lg-3 d-none">
                  <input type="number" name="" id="orderid" class="form-control">
              </div>
              <div class="col-lg-3 d-none">
                  <input type="number" name="" id="ZoneCode" class="form-control">
              </div>
          </div>
      </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
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
          <select id="BankM" class="form-control my-select3" name="Bank" required>
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
  <select id="ZoneM" class="form-control my-select3" name="Zone" required>
    <option value="">Zone</option>
</select>
</div>
<div class="col-sm-4">
              <!--
              <select id="MaterialView" class="form-control my-select3" name="" required>
                <option value="">select</option>
              </select>
          -->
          <button type="button" style="margin-top: 10px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddMulti">Select Material</button>
      </div>
  </div>
</form>
</div>
</div>
<br><br>
<div id="viewResult"></div>
<table class="table table-hover table-bordered border-primary display">
    <thead>
      <tr>
        <th>Branch</th>
        <th>Order ID</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
</thead>
<tbody id="MultiOrders">

</tbody>
</table>
<center>
    <button class="btn btn-primary S" style="margin: 20px;" id="button">Submit</button>
</center>
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

    var qty = [];
    var rateid = [];
    var ItemID=[];
    var BankCode=0;
    $(document).on('change','#BankM', function(){
      BankCode = $(this).val();
      if(BankCode){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BankCode':BankCode},
          success:function(result){
            $('#ZoneM').html(result);

        }
    }); 
    }else{
        $('#ZoneM').html('<option value="">Zone</option>');
    }
});

    $(document).on('change','#ZoneM', function(){
      var ZoneCode = $(this).val();
      console.log(BankCode);
      if(ZoneCode){
        $.ajax({
          type:'POST',
          url:'multiordersdata.php',
          data:{'ZoneCode':ZoneCode, 'BankCode':BankCode},
          success:function(result){
            $('#MultiOrders').html(result);

        }
    }); 
    }
});



    Array.prototype.contains = function(obj) {
      var i = this.length;
      while (i--) {
        if (this[i] == obj) {
          return true;
      }
  }
  return false;
}


$('#save').on('click', function() {
      //console.log($('#MaterialView').val());
      const obj = JSON.parse($('#MaterialView').val());
      console.log(rateid[0]);
      if (obj.ItemID==1654) {
        swal("error", "Item is in undecided category. Please contact to store","error");
    }else if(rateid.contains(obj.RateID)==true){
        swal("error", "Item already exist", "error");
    }else{
        var RateID=obj.RateID;
        var Qty=$('#qty').val();
        var count = $('#myTable tr').length;
        if(RateID!="" && Qty !=""){
          qty.push(Qty);
          rateid.push(RateID);
          ItemID.push(obj.ItemID);
          //console.log(qty);
          //console.log(rateid);
          $('#myTable tbody').append('<tr class="child"><td>'+count+'</td><td>'+obj.Name+'</td><td>'+Qty+'</td><td><a href="javascript:void(0);" class="remCF1 btn btn-small btn-danger" id="'+obj.ItemID+'">Remove</a></td></tr>');
      }
  }
  document.getElementById("f1").reset();

});
$(document).on('click','.remCF1',function(){
  var delItem = $(this).attr("id");
  console.log(ItemID);
  const index = ItemID.indexOf(delItem);
  if (index > -1) {
    ItemID.splice(index, 1);
    rateid.splice(index, 1);
    qty.splice(index, 1);
}
console.log(ItemID);
$(this).parent().parent().remove();
$('#myTable tbody tr').each(function(i){            
 $($(this).find('td')[0]).html(i+1);          
});
});



$(document).on('change','#ZoneM', function(){
  var ZoneCode = $(this).val();
  console.log('>> '+ rateid.length);
  ItemID.splice(0,ItemID.length);
  rateid.splice(0,rateid.length);
  qty.splice(0,qty.length);
  console.log('>>> '+ rateid.length);

  console.log(BankCode);
  if(ZoneCode){
    $.ajax({
      type:'POST',
      url:'multiordersdata.php',
      data:{'ZoneCodeM':ZoneCode},
      success:function(result){
        $('#MaterialView').html(result);

    }
}); 
}else{
    $('#MaterialView').html('<option value="">material</option>'); 
}
});

function limit(element)
{
  var max_chars = 5;

  if(element.value.length > max_chars) {
    element.value = element.value.substr(0, max_chars);
}
}




var array = [];
$('#button').on('click', function() {

  $("input:checkbox[name=select]:checked").each(function() {
        //
        array.push($(this).val());
    });
  console.log(array);
  const Data= JSON.stringify(array);
  console.log(Data);
  if (array[0]=='' || rateid[0]=='') {
    swal("error", "Item or Order field is empty", "error");
}else{
    $.ajax({
      type:'POST',
      url:'addmultiorders.php',
      data:{OrderID:Data, RateID: JSON.stringify(rateid), ItemID: JSON.stringify(ItemID), Qty: JSON.stringify(qty)},
      success:function(result){
        $('#viewResult').html(result);

    }
}); 
}
});


$(document).on('click', '.S', function(){
  var flag=0;
  flag = array[0];
  flag2 = rateid[0];
  console.log('f:'+flag);
  if (!flag) {
    swal("error", "Please select OrderID", "error");
}else if (!flag2) {
    swal("error", "Please select Items", "error");
}else{
    var delayInMilliseconds = 2000; 
    console.log(array);
    setTimeout(function() {
      location.reload();
  }, delayInMilliseconds);

}
});
</script>
</body>

</html>