<?php
include ('connection.php');
include 'session.php';

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));


$Organization=!empty($_POST['Organization'])?$_POST['Organization']:'';
if (!empty($Organization))
{
  $BankData="SELECT DivisionCode, DivisionName from projects.division WHERE OrganizationCode=$Organization order by DivisionName";
  $result = mysqli_query($con,$BankData);
  if(mysqli_num_rows($result)>0)
  {
    echo "<option value=''>Division</option>";
    while ($arr=mysqli_fetch_assoc($result))
    {
      echo "<option value='".$arr['DivisionCode']."'>".$arr['DivisionName']."</option><br>";
    }
  }

}


$DivisionCodeM=!empty($_POST['DivisionCodeM'])?$_POST['DivisionCodeM']:'';
if (!empty($DivisionCodeM))
{
  //$Material='%'.$_POST['MaterialNameS'].'%';
  $Data="SELECT * from projects.rates WHERE DivisionCode=$DivisionCodeM order by Description";
  $result = mysqli_query($con,$Data);
  if(mysqli_num_rows($result)>0)
  {
    while ($arr=mysqli_fetch_assoc($result))
    {
      print '<tr>';
      print '<td>'.$arr["Description"]."</td>";
      print '<td >'.$arr["Rate"]."</td>";
      print '<td ><input class="form-check-input checkb" name="select" type="checkbox" value="'.$arr["RateID"].'"></td>';
      print '</tr>';

    }
  }

}



$Division=!empty($_POST['Division'])?$_POST['Division']:'';

if (!empty($Division))
{  
  $query="SELECT * FROM projects.site WHERE DivisionCode=$Division";
  $result=mysqli_query($con,$query);

  while($row=mysqli_fetch_assoc($result)){

    ?>
    <tr>
      <td><?php echo $row["SiteName"] ?></td>
      <td>
        <input class="form-check-input checkb" name="select" type="checkbox" value="<?php echo $row["SiteCode"]; ?>">
      </td>
    </tr>
    <?php 
  }
}

if (isset($_POST['GetItem']))
{
  $query="SELECT * from cyrusbackend.item order by ItemName";
  $result=mysqli_query($con,$query);
  if (mysqli_num_rows($result)>0)
    { echo "<option value=''>Select</option><br>";
  while ($arr=mysqli_fetch_assoc($result))
  {
    echo "<option value='".$arr['ItemID']."'>".$arr['ItemName']."</option><br>";
  }
}

}


$DivisionName=!empty($_POST['DivisionName'])?$_POST['DivisionName']:'';

if (!empty($DivisionName))
{  


  $OrganizationCode=$_POST['OrganizationCode'];
  $BGDate=$_POST['BGDate'];
  $BGAmount=$_POST['BGAmount'];
  $LOADate=$_POST['LOADate'];
  $CompletionDate=$_POST['ComplitionDate'];
  $Rate=$_POST['DivRate'];
  $Material=$_POST['DivMaterial'];
  $Description=$_POST['Description'];
  //echo $BGDate;
  $err=0;
  for ($i=0; $i <count($Material) ; $i++) { 


    $query="SELECT * from projects.rates WHERE Description='$Material[$i]'";
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    { 
      echo 'matererial '.$Material[$i].' already exist';
      break;
      $err=1;
    }

    if ($err==0) {


      $sql = "INSERT INTO division (DivisionName, OrganizationCode)
      VALUES ('$DivisionName', $OrganizationCode)";

      if ($con->query($sql) === TRUE) {
       $DivisionCode = $con->insert_id;

       $sql = "INSERT INTO projects.orders (DivisionCode, Description, LOADate, DateOfCompletion, BGAmount, BGDate)
       VALUES ($DivisionCode, '$Description', '$LOADate','$CompletionDate', $BGAmount, '$BGDate')";

       if ($con->query($sql) === TRUE) {

       }else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }


      for ($i=0; $i <count($Material) ; $i++) { 


        $sql = "INSERT INTO projects.rates (DivisionCode, Description, Rate)
        VALUES ($DivisionCode, '$Material[$i]', $Rate[$i])";

        if ($con->query($sql) === TRUE) {

        }else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }


      }
      echo 1;
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }

  }

}

}

?>

