<?php
include ('connection.php');
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


$ItemZone=!empty($_POST['ItemZone'])?$_POST['ItemZone']:'';
if (!empty($ItemZone))
{

 $query="SELECT * FROM rates WHERE Zone=$ItemZone";
 $result=mysqli_query($con2,$query);
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
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    {
     $a=mysqli_fetch_assoc($result);
     echo '<tr>
     <th scope="col" style="min-width: 150px;">'.$a['Phone'].'</th>
     <th scope="col" style="min-width: 150px;">'.$a['EmployeeCode'].'</th>

     </tr>';

 }
}

$View=!empty($_POST['view'])?$_POST['view']:'';
if (!empty($View))
{
    $query="SELECT * FROM employees WHERE Inservice=1 order by `Employee Name`";
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    {
        $Sr=1;
        
        while($a=mysqli_fetch_assoc($result)){
            $EmployeeID=$a['EmployeeCode'];
            $query="SELECT * FROM reporting
            join pass on reporting.ExecutiveID=pass.ID WHERE EmployeeID=$EmployeeID";
            $result2=mysqli_query($con,$query);
            if (mysqli_num_rows($result2)>0)
            {   
                $row=mysqli_fetch_assoc($result2);
                $AssignTo=$row['UserName'];
            }else{
                $AssignTo='';
            }
            echo '<tr>
            <td scope="col" style="min-width: 50px;">'.$Sr.'</th>
            <td scope="col" style="min-width: 150px;">'.$a['Employee Name'].'</td>
            <td scope="col" style="min-width: 150px;">'.$a['Phone'].'</td>
            <td scope="col" style="min-width: 150px;">'.$AssignTo.'</td>';
            $query="SELECT * FROM pass WHERE UserName is not null Order by UserName";
            $result3=mysqli_query($con,$query);
            ?>
            <th scope="col" style="min-width: 150px;">
                <select class="form-control rounded-corner">
                    <option value="">Select</option>
                    <?php 
                    while($row=mysqli_fetch_assoc($result3)){
                        echo "<option value='".$row['ID']."'>".$row['UserName']."</option><br>";
                    }
                    ?>
                </select>
            </th>
            <?php 
            echo '<td scope="col" style="min-width: 150px;"><button class="btn btn-primary">Reset Password</button></td>
            </tr>';
            $Sr++;

        }
    }
}


$NewUser=!empty($_POST['NewUser'])?$_POST['NewUser']:'';
if (!empty($NewUser))
{
    $UserType=!empty($_POST['UserType'])?$_POST['UserType']:'';
    $sql = "INSERT INTO pass (UserName, Password, UserType)
    VALUES ('$NewUser', 'cyrus@123', '$UserType')";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}

?>