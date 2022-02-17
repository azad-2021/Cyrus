
<?php

include 'connection.php';



if(isset($_POST['Data'])){
	//$OrderID = $_POST['OrderID'];
	//$Discription=$_POST['discription'];
	$Data=$_POST['Data'];
	$obj = json_decode($Data);

	$OrderID= $obj->OrderID;
	$Discription= $obj->discription;

	$myfile = fopen("discription.json", "w") or die("Unable to open file!");
	fwrite($myfile, $_POST['Data']);
	fclose($myfile);

	$sql = "UPDATE orders SET `Discription`= '$Discription' WHERE OrderID=$OrderID";
}elseif (isset($_POST['infodate'])) {

	$Date=$_POST['infodate'];
	$OrderID = $_POST['OrderID'];
	$sql = "UPDATE orders SET `DateOfInformation`= '$Date' WHERE OrderID=$OrderID";
	$sql2 = "UPDATE demandbase SET `DemandGenDate`= '$Date' WHERE OrderID=$OrderID";
	if ($con->query($sql2) === TRUE) {
    //echo "<meta http-equiv='refresh' content='0'>";
	} else {
		$myfile = fopen("error.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $con->error);
		fclose($myfile);
	}

}elseif (isset($_POST['ReceivedBy'])) {

	$ReceivedBy=$_POST['ReceivedBy'];
	$OrderID = $_POST['OrderID'];
	$sql = "UPDATE orders SET `ReceivedBy`= '$ReceivedBy' WHERE OrderID=$OrderID";

}elseif (isset($_POST['OrderBy'])) {

	$OrderedBy=$_POST['OrderBy'];
	$OrderID = $_POST['OrderID'];
	$sql = "UPDATE orders SET `OrderedBy`= '$OrderedBy' WHERE OrderID=$OrderID";

}elseif (isset($_POST['gadget'])) {

	$GadgetID=$_POST['gadget'];
	$OrderID = $_POST['OrderID'];
	$sql = "UPDATE orders SET `GadgetID`= $GadgetID WHERE OrderID=$OrderID";

}

if ($con->query($sql) === TRUE) {
    //echo "<meta http-equiv='refresh' content='0'>";
} else {
	echo "Error: " . $sql . "<br>" . $con->error;

	$myfile = fopen("error.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $con->error);
	fclose($myfile);
}


?>
