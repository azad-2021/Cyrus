<?php 


include 'connection.php';

include 'session.php';
$User=$_SESSION['userid'];

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));



$AMCID=!empty($_POST['AMCID'])?$_POST['AMCID']:'';
$EmployeeID=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';

if (!empty($AMCID) and !empty($EmployeeID)){ 


	for ($i=0; $i < count($AMCID); $i++) { 


	//echo $AMCID[$i].' '.$EmployeeID.'<br>';

		$sql = "UPDATE orders SET EmployeeCode=$EmployeeID, AssignDate='$Date' WHERE OrderID=$AMCID[$i]";

		if ($con->query($sql) === TRUE) {


		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}

	}


}