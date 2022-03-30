<?php
include ('connection.php');
$EXEID=45;
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));




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


$StateCode=!empty($_POST['StateCode'])?$_POST['StateCode']:'';
if (!empty($StateCode))
{
    $Data="Select EmployeeCode, `Employee Name` from employees WHERE Inservice=1 order by `Employee Name`";
    $result = mysqli_query($con,$Data);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['EmployeeCode']."'>".$arr['Employee Name']."</option><br>";
        }
    }
    
}

$EmployeeCode=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
if (!empty($EmployeeCode))
{
    $Data="SELECT demandbase.OrderID FROM cyrusbackend.orders
    join demandbase on orders.OrderID=demandbase.OrderID
    WHERE StatusID=4 and EmployeeCode=$EmployeeCode and year(DeliveryDate)=year(current_date())";
    $result = mysqli_query($con,$Data);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Orders</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['OrderID']."'>".$arr['OrderID']."</option><br>";
        }
    }
    
}



$OrderID=!empty($_POST['OrderID'])?$_POST['OrderID']:'';
//$OrderID=195836;
if (!empty($OrderID))
{   
    $i=1;
    $j=1;
    $i1=1;
    $i2=2000;
    $i3=3000;
    $i4=4000;

    $Query="SELECT * FROM cyrusbackend.demandextended
    join item on demandextended.ItemID=item.ItemID
    WHERE OrderID=$OrderID";
    $result = mysqli_query($con,$Query);
    if(mysqli_num_rows($result)>0)
    {   
        while($arr=mysqli_fetch_assoc($result)){

            if ($arr['ItemQty']>=1) {
                $i5=$arr['ItemQty'];
                while($i5>=1){
                    echo '<input type="text" class="d-none" id="'.$j.'" value="'.$arr['ItemID'].'">';
                    ?>
                    <tr>
                        <td><?php echo $i1 ?></td>
                        <td><?php echo $arr['ItemName'] ?></td>

                        <td><input type="text" class="form-control my-select4" placeholder="Bar Code" id="<?php echo $i2 ?>" name=""></td>
                        <td><input type="text" class="form-control my-select4" placeholder="Rate" id="<?php echo $i3 ?>" name=""></td>
                        <td>
                          <select class="form-control my-select4 category" id="<?php echo $i4 ?>">
                              <option value="">Select</option>
                              <?php
                              $Query="SELECT * FROM `gst rates` order by CatagoryName";
                              $resultG=mysqli_query($con2,$Query);
                              while ($rowG=mysqli_fetch_assoc($resultG)){

                                  $d = array("HSN"=>$rowG['HSNCode'], "GST"=>$rowG['Rate']);
                                  $data = json_encode($d);
                                  echo "<option value='".$data."''>".$rowG['CatagoryName'].'</option>';
                              }
                              ?>

                          </select>

                      </td>
                  </tr>

                  <?php
                  $i5--;

                  $i1++;  
                  $j++;
                  $i2++;
                  $i3++;
                  $i4++;
              }
              $i++;

              

          }

      }

      echo '<input type="text" class="d-none" id="count" value="'.($j-1).'">';
  }
}



$Rows=!empty($_POST['Rows'])?$_POST['Rows']:'';
if (!empty($Rows))
    {   $i1=1;
        $i2=2000;
        $i3=3000;
        $i4=4000;
        while($Rows>0){
            ?>
            <tr>
                <td><?php echo $i1 ?></td>
                <td>
                    <select class="form-control my-select4 category" id="<?php echo $i1 ?>">
                      <option value="">Select</option>
                      <?php
                      $Query="SELECT * FROM `item` order by ItemName";
                      $result=mysqli_query($con,$Query);
                      while ($row=mysqli_fetch_assoc($result)){
                          echo "<option value='".$row['ItemID']."''>".$row['ItemName'].'</option>';
                      }
                      ?>

                  </select></td>
                  <td><input type="text" class="form-control my-select4" placeholder="Bar Code" id="<?php echo $i2 ?>" name=""></td>
                  <td><input type="number" class="form-control my-select4" placeholder="Rate" id="<?php echo $i3 ?>" name=""></td>
                  <td>
                      <select class="form-control my-select4 category" id="<?php echo $i4 ?>">
                          <option value="">Select</option>
                          <?php
                          $Query="SELECT * FROM `gst rates` order by CatagoryName";
                          $resultG=mysqli_query($con2,$Query);
                          while ($rowG=mysqli_fetch_assoc($resultG)){

                              $d = array("HSN"=>$rowG['HSNCode'], "GST"=>$rowG['Rate'], "ItemID"=>$rowG['ItemID']);
                              $data = json_encode($d);
                              echo "<option value='".$data."''>".$rowG['CatagoryName'].'</option>';
                          }
                          ?>

                      </select>

                  </td>
              </tr>

              <?php
              $i1++;
              $i2++;
              $i3++;
              $i4++;
              $Rows--;
          }

      }

      $ItemID=!empty($_POST['ItemID'])?$_POST['ItemID']:'';
      if (!empty($ItemID))
      {  

        $EmployeeID=!empty($_POST['EmployeeCode2'])?$_POST['EmployeeCode2']:'';
        $Statecode=!empty($_POST['Statecode'])?$_POST['Statecode']:'';
        $Barcode=!empty($_POST['BarCode2'])?$_POST['BarCode2']:'';
        $hsn=!empty($_POST['HSN2'])?$_POST['HSN2']:'';
        $gst=!empty($_POST['GST2'])?$_POST['GST2']:'';
        $rate=!empty($_POST['rate'])?$_POST['rate']:'';
        $OrderID2=!empty($_POST['OrderID2'])?$_POST['OrderID2']:'';
        $Address=!empty($_POST['Address'])?$_POST['Address']:'';
   /* print_r($Desc).'<br>';
    print_r($BarCode).'<br>';
    print_r($HSN).'<br>';
    print_r($GST).'<br>';
    print_r($Rate).'<br>';
    print_r($Rate).'<br>';
    print_r($Category);
*/
    //echo count($Desc);


    $m=date('m',strtotime($timestamp));
    $y=date('y',strtotime($timestamp));

    if ($m<=3) {
        $FY=($y-1).$y;

    }else{
        $FY=$y.($y+1);
    }

    $Query="SELECT ID FROM deliverychallan order by ID desc LIMIT 1";
    $result = mysqli_query($con3,$Query);
    if(mysqli_num_rows($result)>0){ 

        $arr=mysqli_fetch_assoc($result);
        $arrID=$arr['ID'];
    }else{
        $arrID=0;
    }

    $CHID=$FY.'CEUP-'.$arrID+1;
    for ($k=0; $k < count($ItemID); $k++) { 

        //echo $Desc[$i];
        $inid=0;

        $Amount=(($rate[$k]*$gst[$k])/100)+$rate[$k];
        $sql = "INSERT INTO deliverychallan (EmployeeCode, StateCode, ItemID, BarCode, HSNCode, GST, Rate, Amount, DeliveryDate, DeliveryByID, ChallanNo, Address)
        VALUES ($EmployeeID, $Statecode, $ItemID[$k], '$Barcode[$k]', $hsn[$k], $gst[$k],  '$rate[$k]', $Amount, '$Date', $EXEID, '$CHID', '$Address')";

        if ($con3->query($sql) === TRUE) {

            //echo "record created <br>";
        } else {
            $myfile = fopen("error.txt", "w") or die("Unable to open file!");
            fwrite($myfile, $con3->error);
            fclose($myfile);
            echo "Error: " . $sql . "<br>" . $con3->error;
        }

    }
    $inid=$con3->insert_id;
    if ($inid>0) {
        //echo '<input type="number" id="inid" value="'.$inid.'">';
        $myfile = fopen("id.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $inid);
        fclose($myfile);
        echo $inid;
    }  


}



?>

