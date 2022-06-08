<?php 
include"connection.php";

$query="SELECT * FROM cyrusbackend.jobcardmain WHERE VisitDate>'2021-09-27' and ServiceDone is null and timestamp='2022-06-06'";
$result = $con->query($query);
while($row=mysqli_fetch_assoc($result)){

	$Jobcard=$row['Card Number'];
	$query="SELECT * FROM cyrusbackend.jobcardmain WHERE `Card Number` like '$Jobcard'";
	$result2 = $con3->query($query);

	if(mysqli_num_rows($result2)>0)
	{
		$row2=mysqli_fetch_assoc($result2);
		echo $Pending=$row2['WorkPending'].'<br>';
		$Done=$row2['ServiceDone'];

		$sql = "UPDATE jobcardmain SET WorkPending='$Pending', ServiceDone='$Done' WHERE `Card Number`='$Jobcard'";

		if ($con->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}

	}

}


?>