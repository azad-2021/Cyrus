<?php 

if(isset($_POST["Date"]))
{  
	$Date=$_POST["Date"];

	$myfile = fopen("date.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $Date);
	fclose($myfile);

	$M =date('M-Y',strtotime($Date));
	$SS=date('Y-m-d', strtotime('second sat of '.$M));
	$FS=date('Y-m-d', strtotime('fourth sat of '.$M));

	if ($SS==date('Y-m-d', strtotime($Date. ' 2 days'))) {
		echo 1;
	}elseif ($FS==date('Y-m-d', strtotime($Date. ' 2 days'))) {
		echo 1;
	}else{
		echo 0;
	}


}
?>
