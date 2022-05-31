<?php
include ('data.php');
$BankCode=!empty($_POST['BankCode'])?$_POST['BankCode']:'';
if (!empty($BankCode))
{
    $BankData="SELECT ZoneRegionCode,ZoneRegionName from zoneregions WHERE BankCode=$BankCode order by ZoneRegionName";
    $result = mysqli_query($conn,$BankData);
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
    $result=mysqli_query($conn,$ZoneData);
    if (mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Branch</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['BranchCode']."'>".$arr['BranchName']."</option><br>";
        }
    }
}


$ItemZone=!empty($_POST['ItemZone'])?$_POST['ItemZone']:'';
if (!empty($ItemZone))
{

 $query="SELECT * FROM rates WHERE Zone=$ItemZone";
 $result=mysqli_query($conn2,$query);
 if (mysqli_num_rows($result)>0)
 {
    while ($arr=mysqli_fetch_assoc($result))
    {

        echo "<option value='".$arr['RateID']."'>".$arr['Description']."</option><br>";
    }
}


}


$EmployeeCode=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
if (!empty($EmployeeCode))
{
    $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeCode";
    $result=mysqli_query($conn,$query);
    if (mysqli_num_rows($result)>0)
    {
     $a=mysqli_fetch_assoc($result);
     echo '<tr>
     <th scope="col" style="min-width: 150px;">'.$a['Phone'].'</th>
     <th scope="col" style="min-width: 150px;">'.$a['EmployeeCode'].'</th>

     </tr>';

 }
}


$ZoneCodeAMC=!empty($_POST['ZoneCodeAMC'])?$_POST['ZoneCodeAMC']:'';

if (!empty($ZoneCodeAMC))
{   
    $myfile = fopen("ZoneCodeAMC.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $ZoneCodeAMC);
    fclose($myfile);
    $ZoneAMC="SELECT * from amcs WHERE ZoneRegionCode=$ZoneCodeAMC";
    $result=mysqli_query($conn,$ZoneAMC);
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

?>