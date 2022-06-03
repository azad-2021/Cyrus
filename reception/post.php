
<?php

include 'connection.php';
include 'session.php';
$ID=$_SESSION['userid'];
if(isset($_POST["Data"]))
{

  $obj = json_decode($_POST["Data"]);
  $BranchCode = $obj->BranchCode;
  $Type = $obj->Type;
  $GadgetID = $obj->Device;
  $ReceivedBy = $obj->ReceivedBy;
  $MadeBy = $obj->MadeBy;
  $InfoDate = $obj->InfoDate;
  $ExpDate = $obj->Expected;
  $Discription = $obj->Discription;



  if ($Type=='AMC') {
    $Type='Order';
    $S=1;
  }else{
    $S=0;
  }


  if (strpos($Discription, "'") !== FALSE){

    $Discription= str_replace("'","\'",$Discription);

  }



  if ($Type=='Complaint') {
    $sql = "INSERT INTO complaints (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBY, MadeBy, GadgetID)
    VALUES ('$BranchCode', '$Discription', '$InfoDate', '$ExpDate', '$ReceivedBy', '$MadeBy', '$GadgetID')";
    $msg='<script>alert("Complaint added")</script>';
  }elseif ($Type=='Order') {
    $sql2 = "INSERT INTO orders (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBy, OrderedBy, GadgetID)
    VALUES ('$BranchCode', '$Discription', '$InfoDate', '$ExpDate', '$ReceivedBy', '$MadeBy', '$GadgetID')";
    $msg='<script>alert("Order added")</script>';
    if ($con->query($sql2) === TRUE) {
      if(strpos($Discription, 'AMC') !== false){
        $Status=5;   
        

      }else{
        $Status=1;

      }
      $OrderID=$con->insert_id;
      $sql = "INSERT INTO demandbase (StatusID, OrderID, GeneratedByID, DemandGenDate)
      VALUES ('$Status', '$OrderID', '$ID', '$InfoDate')";
      $msg='<script>alert("order added")</script>';
    }else {
      echo "Error: " . $sql2 . "<br>" . $con->error;

    }
    
    $OrderID = $con->insert_id;

  }


  if ($con->query($sql) === TRUE) {

    if ($S==0) {

      $Device="SELECT UserName FROM cyrusbackend.branchs
      join districts on branchs.Address3=districts.District
      join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
      join pass on `cyrus regions`.ControlerID=pass.ID
      WHERE BranchCode=$BranchCode";

      $result=mysqli_query($con,$Device);
      if (mysqli_num_rows($result)>0)
      {
        $arr=mysqli_fetch_assoc($result);

        $Executive=$arr['UserName'];


        $sqlSaaS = "INSERT INTO orders (BranchCode, Executive, RefID)
        VALUES ($BranchCode, '$Executive', $OrderID)";


        if ($con3->query($sqlSaaS) === TRUE) {

        }else {
          $myfile = fopen("errorSaaS.txt", "w") or die("Unable to open file!");
          fwrite($myfile, $con3->error);
          fclose($myfile);
        }
      }
    }

  }else {
    echo "Error: " . $sql . "<br>" . $con->error;
    $myfile = fopen("error.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $con->error);
    fclose($myfile);
  }

}
?>
