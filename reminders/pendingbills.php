<?php 
include 'connection.php';
include 'session.php';
$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$orgDate = date('Y-m-d',strtotime($timestamp));
$Date = date('Y-m-d', strtotime($orgDate. ' -1 days'));


?>



<!DOCTYPE html>  
<html>  
<head>   
	<meta name="viewport" content="width=device-width, initial-scale=1">  
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="author" content="Anant Singh Suryavanshi">
	<title>Reminders</title>
	<link rel="icon" href="cyrus logo.png" type="image/icon type">
	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

	<style type="text/css">
	label{
		margin: 5px;
	}
/*
	input[type=text] {
		width: 200px;
		-webkit-transition: width 0.6s ease-in-out;
		transition: width 0.6s ease-in-out;
	}

	input[type=text]:focus {
		width: 30%;
		border-bottom: 2px solid #d3d3d3;
		box-shadow: none;
		color: #111;
		}*/
		tfoot input {
			width: 100%;
			padding: 3px;
			box-sizing: border-box;
		}

	</style>

</head>  
<body> 
	<?php 
	include 'navbar.php';
	include 'modals.php';

	?>
	
	<div class="container">

		<div class="table-responsive"> 
			<h5 align="center">All Pending GST Bills</h5>
			<table id="example" class="display" style="width:100%">
				<thead> 
					<tr> 
						<th style="min-width:160px">Bank</th>
						<th style="min-width:80px">Zone</th>           
						<th style="min-width:150px">Branch</th>
						<th style="min-width:100px">Bill No</th>
						<th style="min-width:80px">Bill Date</th>        
						<th style="min-width: 100px;">Total Billed Value</th> 
						<th style="min-width: 100px;">Received Amount</th> 
						<th style="min-width: 100px;">Pending Payment</th>           
					</tr>                     
				</thead>                 
				<tbody>
					<?php 
					//echo $queryDate;
					$query="SELECT * FROM cyrusbilling.billbook
					join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
					join cyrusbackend.zoneregions on branchdetails.ZoneRegionCode=zoneregions.ZoneRegionCode 
					WHERE (billbook.TotalBilledValue - billbook.ReceivedAmount) >1 and Cancelled=0 and billbook.BillDate <'$Date' and zoneregions.BankCode not in (17,29,30,33,43,46,49,50,52)  order by billbook.BillDate";

					$result=mysqli_query($con2,$query);
					while($row = mysqli_fetch_array($result)){
						/*
						print "<tr>";
						print "<td>".$row['BankName']."</td>";             
						print "<td>".$row['ZoneRegionName']."</td>";
						print "<td>".$row['BranchName']."</td>"; 

						print '<td style="color:Blue;" data-bs-toggle="modal" data-bs-target="#Bill" class="Bill" id="'.$row['BranchCode'].'" >'.$row['BookNo']."</td>";

						print "<td>".$row['BillDate']."</td>";
						print "<td>".$row['TotalBilledValue']."</td>";
						print "<td>".$row['ReceivedAmount']."</td>";
						print "<td>".sprintf('%0.2f', ($row['TotalBilledValue']-$row['ReceivedAmount']))."</td>";
						print "</tr>";*/

						?>
						<tr>
							<td><?php echo $row['BankName'] ?></td>
							<td><?php echo $row['ZoneRegionName'] ?></td>
							<td><?php echo $row['BranchName'] ?></td>
							<td style="color:Blue;" data-bs-toggle="modal" data-bs-target="#Bill" class="Bill" id="<?php echo $row['BranchCode'] ?>"><?php echo $row['BookNo'] ?></td>
							<td><?php echo $row['BillDate'] ?></td>
							<td><?php echo $row['TotalBilledValue'] ?></td>
							<td><?php echo $row['ReceivedAmount'] ?></td>
							<td><?php echo sprintf('%0.2f', ($row['TotalBilledValue']-$row['ReceivedAmount'])) ?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th style="min-width:160px">Bank</th>
						<th style="min-width:80px">Zone</th>           
						<th style="min-width:150px">Branch</th>
						<th style="min-width:100px">Bill No</th>
						<th style="min-width:80px">Bill Date</th>        
						<th style="min-width: 100px;">Total Billed Value</th> 
						<th style="min-width: 100px;">Received Amount</th> 
						<th style="min-width: 100px;">Pending Payment</th> 
					</tr>
				</tfoot>
			</table>

		</div>
	</div>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
	<script src="ajax-script.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
    	var title = $(this).text();
    	$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    	responsive :true;
    } );

    // DataTable
    var table = $('#example').DataTable({
    	initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
            	var that = this;

            	$( 'input', this.footer() ).on( 'keyup change clear', function () {
            		if ( that.search() !== this.value ) {
            			that
            			.search( this.value )
            			.draw();
            		}
            	} );
            } );
        },
        responsive: true
    });

} );
</script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>