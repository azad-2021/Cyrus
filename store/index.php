<?php 
include 'connection.php';
//include 'session.php';
//$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));



?>

<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title>Delivery Orders</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="sweetalert.min.js"></script>
</head>  
<body> 
  <?php 
  include 'navbar.php';

  ?>
  <div class="container">
  <?php 
  include 'modals.php';

  ?>
  <div class="row g-3">
    <div class="col-md-12">
      <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
      <form class="needs-validation form-control novalidate my-select4" method="POST" style="margin-bottom: 5px;" id="f1">
        <div class="row g-3">

          <div class="col-sm-4">
            <label>States</label>
            <select id="states" class="form-control my-select3" required>
              <option value="">Select</option>
              <?php
            //$Data="Select EmployeeCode, `Employee Name` from employees order by `Employee Name`";
              $Data="Select * from states order by `State Name`";
              $result=mysqli_query($con2,$Data);
              if (mysqli_num_rows($result)>0)
              {
                while ($arr=mysqli_fetch_assoc($result))
                {
                  ?>
                  <option value="<?php echo $arr['StateCode']; ?>"><?php echo $arr['State Name']; ?></option>
                  <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="col-sm-4">
            <label>Employee</label>
            <select id="Employee" class="form-control my-select3" required>
              <option value="">select</option>
            </select>
          </div>
          <div class="col-sm-2 d-none">
            <label>State Code</label>
            <input type="number" id="statecode" class="form-control my-select3" disabled>
          </div>
          <div class="col-sm-4">
            <label>Select orders</label>
            <select id="orders" class="form-control my-select3" required>
              <option value="">select</option>
            </select>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered border-primary display"  id="myTable">
      <center><input type="text" class="form-control my-select4" style="max-width: 300px; margin-top: 10px;" id="address" placeholder="Address"><center>
        <br>
        <thead>
          <tr>
            <th style="min-width:80px">Sr. No.</th>
            <th style="min-width:300px">Description</th>
            <th style="min-width:150px">Bar Code</th>
            <th style="min-width:120px">Rate</th>
            <th style="min-width:200px">Select Category</th>
          </tr>
        </thead>
        <tbody id="material">

        </tbody>
      </table>
    </div>
    <center>
      <button type="button" style="margin-top:25px" class="btn btn-primary save" >Submit</button>
    </center>

    <div id="indata"></div>
    <!--<div id="inid2"></div>-->
  </div>



  <script type="text/javascript">


    var hsncode = [];
    var gstrates = [];
    var rows=0;


    function limit(element)
    {
      var max_chars = 5;

      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }

    $(document).on('change','#states', function(){
      var StateCode = $(this).val();
      document.getElementById("statecode").value = StateCode;
      if(StateCode){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'StateCode':StateCode},
          success:function(result){
            $('#Employee').html(result);

          }
        }); 
      }else{
        $('#Employee').html('<option value="">Employee</option>');
      }
    });


    $(document).on('change','#Employee', function(){

     EmployeeCode= document.getElementById("Employee").value;

     if(EmployeeCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'EmployeeCode':EmployeeCode},
        success:function(result){
          $('#orders').html(result);

        }
      }); 
    }else{
      $('#orders').html('<option value="">select</option>');
    }

  });

    $(document).on('change','#orders', function(){

     OrderID= document.getElementById("orders").value;

     if(OrderID){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'OrderID':OrderID},
        success:function(result){
          var element = document.getElementById("material");
          element.classList.remove("d-none");
          $('#material').html(result);

        }
      }); 
    }
  });


    $(document).on('click', '.save', function () {
      var Desc = [];
      var BarCode = [];
      var HSN=[];
      var GST=[];
      var rate=[];
      var amount=[];

      var i2=2000
      var i3=3000
      var i4=4000
      var rows=document.getElementById("count").value;
      console.log(rows);
      for (let i = 1; i <=rows; i++) {
        var EmployeeCode=document.getElementById("Employee").value;
        var StateCode=document.getElementById("states").value;
        var Address=document.getElementById("address").value;
        var OrderID=document.getElementById("orders").value;
        var desc=document.getElementById(i).value;
        var barcode=document.getElementById(i2).value;
        var Rate=document.getElementById(i3).value;
        var data=document.getElementById(i4).value;
        var error=0;
        console.log(desc);
        console.log(barcode);
        console.log(Rate);
        console.log(data);
        console.log(i2);
        console.log(i3);
        console.log(i4);

        if (desc!='' && barcode!='' && Rate!='' && data!='' && Address!='') {

          const obj = JSON.parse(data);
          hsn = obj.HSN;
          gst=obj.GST;
          Desc.push(desc);
          BarCode.push(barcode);
          HSN.push(hsn);
          GST.push(gst);
          rate.push(Rate);


          i2++;
          i3++;
          i4++;
        }


      }

      console.log(Desc);
      console.log(BarCode);
      console.log(HSN);
      console.log(GST);
      console.log(rate);

      if(Desc[0]>0){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'ItemID':Desc, 'BarCode2':BarCode, 'HSN2':HSN, 'GST2':GST, 'rate':rate, 'OrderID2':OrderID, 'EmployeeCode2':EmployeeCode, 'Statecode':StateCode, 'Address':Address},
          success:function(results){
            $('#inid2').html(results);
            var InsertedID=(results);
            console.log(InsertedID);
            swal("success","Material Confirmed","success");
            var element = document.getElementById("material");
            element.classList.add("d-none");
            document.getElementById("f1").reset();
            document.getElementById("address").value='';
              //location.reload();
              //window.open("challan.php?id="+InsertedID, "_blank");

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