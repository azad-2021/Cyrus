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


$BranchCode=!empty($_POST['BranchCode'])?$_POST['BranchCode']:'';
if (!empty($BranchCode))
{



    $ZoneData="SELECT * FROM cyrusbackend.approval
    join cyrusbilling.pbills on approval.ApprovalID=pbills.ApprovalID 
    join employees on approval.EmployeeID=employees.EmployeeCode
    WHERE posted=1 and vopen=0 and BranchCode=$BranchCode";
    $result=mysqli_query($con,$ZoneData);
    if (mysqli_num_rows($result)>0)
    {

        while ($arr=mysqli_fetch_assoc($result))
        {
            if ($arr['Status']==1) {
                $Status='OK';
            }else{
                $Status='Not OK';
            }

            ?>

            <tr><td><?php echo $arr['Employee Name']; ?></td>
                <td style="color: blue;" class="viewMaterial" id="<?php echo $arr['ApprovalID']; ?>"><?php echo $arr['OrderID']; ?></td>
                <td style="color: blue;" class="viewMaterial" id="<?php echo $arr['ApprovalID']; ?>"><?php echo $arr['ComplaintID']; ?></td>
                <td><?php echo $Status; ?></td>
                <td><?php echo $arr['JobCardNo']; ?></td>
            </tr>

            <?php 
        }
    }
    
}



$ApprovalID=!empty($_POST['ApprovalID'])?$_POST['ApprovalID']:'';
if (!empty($ApprovalID))
{



    $Query="SELECT * FROM cyrusbilling.pbills Join cyrusbilling.rates on pbills.RateID=rates.RateID
    join cyrusbackend.item on rates.ItemID=item.ItemID WHERE ApprovalID=$ApprovalID";
    $result=mysqli_query($con2,$Query);
    if (mysqli_num_rows($result)>0)
    {

        while ($arr=mysqli_fetch_assoc($result))
        {


            ?>

            <tr>
                <td><?php echo $arr['ItemName']; ?></td>
                <td><?php echo $arr['Description']; ?></td>
                <td ><?php echo $arr['Rate']; ?></td>
                <td><?php echo $arr['Qty']; ?></td>
            </tr>

            <?php 
        }
    }
    
}
