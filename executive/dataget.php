<?php 
include 'connection.php';
include "session.php";

date_default_timezone_set('Asia/Kolkata');
$newtimestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($newtimestamp));

if (isset($_SESSION['query'])) {
  $EXEID=$_SESSION['query'];
}else{
  $EXEID=$_SESSION['userid'];
}

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


$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;

if (!empty($Data)){

 $obj = json_decode($Data);
 $OrderID=$obj->OrderID;
 $ZoneCode=$obj->ZoneCode;
 $myfile = fopen("DataZone.json", "w") or die("Unable to open file!");
 fwrite($myfile, $Data);
 fclose($myfile);
 $query="SELECT * FROM rates WHERE Zone=$ZoneCode order by Description";
 $result=mysqli_query($con2,$query);
 if (mysqli_num_rows($result)>0)
 {
   echo '<option value="">Select</option><br>';
   while ($arr=mysqli_fetch_assoc($result))
   {

    $d = array("RateID"=>$arr['RateID'], "ItemID"=>$arr['ItemID']);
    $data = json_encode($d);
    echo "<option value='".$data."'>".$arr['Description']."</option><br>";
  }
}
}

$ZoneCodeAMC=!empty($_POST['ZoneCodeAMC'])?$_POST['ZoneCodeAMC']:'';

if (!empty($ZoneCodeAMC))
{   
  $myfile = fopen("ZoneCodeAMC.txt", "w") or die("Unable to open file!");
  fwrite($myfile, $ZoneCodeAMC);
  fclose($myfile);
  $ZoneAMC="SELECT * from amcs WHERE ZoneRegionCode=$ZoneCodeAMC";
  $result=mysqli_query($con,$ZoneAMC);
  if (mysqli_num_rows($result)>0)
  {

    while ($row=mysqli_fetch_assoc($result))
    {
      print "<tr>";
      print '<td style="min-width: 150px;">'.$row["Device"]."</td>";
      print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["StartDate"]))."</td>";
      print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["EndDate"]))."</td>";
      print '<td style="min-width: 150px;">'.$row["Visits"]."</td>";
      print '<td style="min-width: 150px;">'.$row["Rate"]."</td>";
      print '</tr>';
    }

  }
}

$Regiondata=!empty($_POST['Regiondata'])?$_POST['Regiondata']:'';

if (!empty($Regiondata))
{   

  $Region="SELECT * FROM cyrusbackend.districts
  join `cyrus regions`on districts.RegionCode=`cyrus regions`.RegionCode
  WHERE ControlerID=$EXEID 
  order by RegionName";
  $result=mysqli_query($con,$Region);
  if (mysqli_num_rows($result)>0)
  {

    while ($row=mysqli_fetch_assoc($result))
    {
      print "<tr>";
      print '<td>'.$row["RegionName"]."</td>";
      print '<td>'.$row["District"]."</td>";
      print '</tr>';
    }

  }
}

$BankCodeVisit=!empty($_POST['BankCodeVisit'])?$_POST['BankCodeVisit']:'';
if (!empty($BankCodeVisit))
{

  $Designation=!empty($_POST['Designation'])?$_POST['Designation']:'';
  $Name=!empty($_POST['Name'])?$_POST['Name']:'';
  $VisitDate=!empty($_POST['VisitDate'])?$_POST['VisitDate']:'';
  $Description=!empty($_POST['Description'])?$_POST['Description']:'';
  $NextVisitDate=!empty($_POST['NextVisitDate'])?$_POST['NextVisitDate']:'';

  $Data="SELECT * from bankvisits WHERE VisitDate='$VisitDate' and ExecutiveID=$EXEID and BankCode=$BankCodeVisit and Name='$Name'";
  $result=mysqli_query($con3,$Data);
  if (mysqli_num_rows($result)>0)
  {
    echo "Details already exist";
  }elseif($VisitDate>=$NextVisitDate){
    echo 'Next visit date must be greater than visit date';
  }else{
    $sql = "INSERT INTO bankvisits (ExecutiveID, BankCode, Designation, Name, VisitDate, Description, NextVisitDate)
    VALUES ($EXEID, $BankCodeVisit, '$Designation', '$Name', '$VisitDate', '$Description', '$NextVisitDate')";

    if ($con3->query($sql) === TRUE) {
      echo 1;
    }else {
      echo "Error: " . $sql . "<br>" . $con3->error;
    }

  }
}

$BankVisit=!empty($_POST['BankVisit'])?$_POST['BankVisit']:'';

if (!empty($BankVisit))
{   

  $query="SELECT * from cyrusbackend.bankvisits join cyrusbackend.bank on bankvisits.BankCode=bank.BankCode
  WHERE ExecutiveID=$EXEID order by VisitDate desc";
  $result=mysqli_query($con3,$query);
  if (mysqli_num_rows($result)>0)
  {

    while ($row=mysqli_fetch_assoc($result))
    {
      print "<tr>";
      print '<td style="min-width: 150px;">'.$row["BankName"]."</td>";
      print '<td style="min-width: 150px;">'.$row["Name"]."</td>";
      print '<td style="min-width: 150px;">'.$row["Designation"]."</td>";
      print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["VisitDate"]))."</td>";
      print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["NextVisitDate"]))."</td>";
      print '<td style="min-width: 150px;">'.$row["Description"]."</td>";
      print '</tr>';
    }

  }
}

?>

