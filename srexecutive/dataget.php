<?php
include ('connection.php');
include ('session.php');
//$UserID=19;
$UserID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$Date =date('y-m-d H:i:s');
$date =date('y-m-d');
$BankCode=!empty($_POST['BankCode'])?$_POST['BankCode']:'';
if (!empty($BankCode))
{
    $BankData="SELECT ZoneRegionCode,ZoneRegionName from zoneregions WHERE BankCode=$BankCode order by ZoneRegionName";
    $result = mysqli_query($con,$BankData);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Zone</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['ZoneRegionCode']."'>".$arr['ZoneRegionName']."</option><br>";
        }
    }
    
}
$ZoneCode=!empty($_POST['ZoneCode'])?$_POST['ZoneCode']:'';
if (!empty($ZoneCode))
{
    $ZoneData="SELECT BranchCode,BranchName from branchs WHERE ZoneRegionCode=$ZoneCode order by BranchName";
    $result=mysqli_query($con,$ZoneData);
    if (mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Branch</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['BranchCode']."'>".$arr['BranchName']."</option><br>";
        }
    }
}


$RegionCode=!empty($_POST['RegionCode'])?$_POST['RegionCode']:'';
if (!empty($RegionCode))
{
    $Data="SELECT District from districts WHERE RegionCode=$RegionCode order by District";
    $result=mysqli_query($con,$Data);
    if (mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select District</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['District']."'>".$arr['District']."</option><br>";
        }
    }else{
        echo "<option value=''>No District</option>";
    }
}

$Data=!empty($_POST['Data'])?$_POST['Data']:'';
if (!empty($Data))
{


    $myfile = fopen("data.json", "w") or die("Unable to open file!");
    fwrite($myfile, $Data);
    fclose($myfile);

    $obj = json_decode($Data);

    $BranchCode= $obj->BranchCode;
    $BillID= $obj->BillID;
    $Description = $obj->Description;
    $NextReminderDate= $obj->NextReminderDate;
    $Action = $obj->Action;

    $sql = "INSERT INTO reminders (BranchCode, BillID, UserID, Description, ReminderDate, NextReminderDate, ActionRequired)
    VALUES ('$BranchCode', '$BillID', '$UserID', '$Description', '$Date', '$NextReminderDate', '$Action')";

    if ($con2->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $con2->error;
  }
}

$Bank1=!empty($_POST['Bank1'])?$_POST['Bank1']:'';
if (!empty($Bank1))
{
    $ini=!empty($_POST['ini'])?$_POST['ini']:'';


    $sql = "INSERT INTO  cyrusbackend.bank (BankName, BankInitial)
    VALUES ('$Bank1', '$ini')";

    if ($con->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}


$con->close();
$con2->close();


