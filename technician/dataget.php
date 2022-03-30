<?php
include ('connection.php');

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ItemID=!empty($_POST['ItemID'])?$_POST['ItemID']:'';
//$ItemID=1032;
if (!empty($ItemID))
{   
    $EmployeeID=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
    //$RateID=!empty($_POST['RateID'])?$_POST['RateID']:'';
    //$RateID=60;
    //$EmployeeID=70;

    $Data="SELECT Count(BarCode) from deliverychallan WHERE EmployeeCode=$EmployeeID and ItemID=$ItemID and ConsumedDate is null";
    $result = mysqli_query($con1,$Data);
    if(mysqli_num_rows($result)>0)
        {   $arr=mysqli_fetch_assoc($result);
            echo $arr['Count(BarCode)'];
        }else{
            echo '';
        }

    }

?>