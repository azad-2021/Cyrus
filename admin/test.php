<?php 
include 'connection.php';
include 'session.php';
$sql ="SELECT BankName, ZoneRegionName, EmployeeCode,  BranchName, BookNo, BankCode, ZoneRegionCode, BillDate, sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
join cyrusbackend.districts on billbook.EmployeeCode=districts.`Assign To`
join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and ControlerID=8 and BankName!='Cyrus'
group by BankCode, ZoneRegionCode
ORDER BY BankName";

$result = mysqli_query($con,$sql);
print_r($result);
$PendingBills=array();
$Bankarr=array();
while ($row = mysqli_fetch_array($result)) { 
	rsort($row);
	$PendingBills[]  = $row['TotalAmount']-$row['ReceiveAMOUNT'];
	$Bankarr[] = $row['BankName'].' '.$row['ZoneRegionName'];
}

print_r($PendingBills);

?>