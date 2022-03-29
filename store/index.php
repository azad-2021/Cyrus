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
  <title>Store</title>
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
  //include 'modals.php';

  ?>
  <div class="container">

    <div class="row g-3">
      <div class="col-md-12">
        <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
        <form class="needs-validation form-control novalidate my-select4" method="POST" style="margin-bottom: 5px;">
          <div class="row g-3">

            <div class="col-sm-3">
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
            <div class="col-sm-3">
              <label>Employee</label>
              <select id="Employee" class="form-control my-select3" required>
                <option value="">select</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label>State Code</label>
              <input type="number" id="statecode" class="form-control my-select3" disabled>
            </div>
            <div class="col-sm-2">
              <label>Enter Number of Rows</label>
              <input type="number" id="addrows" class="form-control my-select3" disabled>
            </div>
            <div class="col-sm-2">
              <button type="button" style="margin-top:25px" class="btn btn-primary AddRows" >Add</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <br><br>

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
        document.getElementById("addrows").disabled = false;
      });


      $(document).on('click', '.AddRows', function () {
       rows = document.getElementById("addrows").value;

       if(rows){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'Rows':rows},
          success:function(result){
            $('#material').html(result);

          }
        }); 
      }else{
        swal("error", "Enter Number of rows.", "error");
      }

    });


      $(document).on('click', '.save', function () {
        var Desc = [];
        var BarCode = [];
        var HSN=[];
        var GST=[];
        var rate=[];
        var amount=[];
        var category=[];
        var i2=2000
        var i3=3000
        var i4=4000

        for (let i = 1; i <=rows; i++) {
          var EmployeeCode=document.getElementById("Employee").value;
          var StateCode=document.getElementById("states").value;
          var desc=document.getElementById(i).value;
          var barcode=document.getElementById(i2).value;
          var Rate=document.getElementById(i3).value;
          var data=document.getElementById(i4).value;
          var error=0;
          if (desc=='' || barcode=='' || Rate=='' || data=='') {
            swal("error", "Please enter all fields", "error");
            error=1;
          }else{
            const obj = JSON.parse(data);
            hsn = obj.HSN;
            gst=obj.GST;
            Desc.push(desc);
            BarCode.push(barcode);
            HSN.push(hsn);
            GST.push(gst);
            rate.push(Rate);
            category.push(obj.ItemID);
            i2++;
            i3++;
            i4++;
          }


        }

     //console.log(Desc);
      //console.log(BarCode);
      //console.log(HSN);
      //console.log(GST);
      //console.log(rate);
      //console.log(category);

      if(error==0){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'desc':Desc, 'BarCode':BarCode, 'HSN':HSN, 'GST':GST, 'rate':rate, 'Category':category, 'EmployeeCode':EmployeeCode, 'Statecode':StateCode},
          success:function(result){
            var InsertedID=(result);
            console.log(InsertedID);
            if (InsertedID>0) {
              window.open("challan.php?id="+InsertedID, "_blank");
            }
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