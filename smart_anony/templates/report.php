<?php
include_once("../pages/connection.php");

$categories = [];
$categoriesName = [];
/*
$qGetdates = "SELECT * FROM order_tbl";
$rGetdates = $conn->query($qGetdates);
while ($row = mysqli_fetch_assoc($rGetdates)) {
	$oid = $row['Order_ID'];
	$datec = $row['Date_Created'];
	//echo $oid . " ";
	$qGetamounts = "SELECT * FROM order_details WHERE Order_ID=$oid";
	$rGetamounts = $conn->query($qGetamounts);
	while ($rowamount = mysqli_fetch_assoc($rGetamounts)) {
		$orid = $rowamount['Order_ID'];
		echo $orid . " " . $datec;
	}

}

$qGetdates = "SELECT order_tbl.Order_ID, order_tbl.Date_Created, order_details.Unit_price 
FROM order_tbl JOIN order_details ON order_tbl.Order_ID = order_details.Order_ID 
WHERE order_tbl.Date_Created BETWEEN CURRENT_DATE - INTERVAL 2 MONTH AND CURRENT_DATE 
GROUP BY Total_amount ";
$rGetdates = $conn->query($qGetdates);
while ($row = mysqli_fetch_assoc($rGetdates)) {
	$oid = $row['Order_ID'];
	$datec = $row['Date_Created'];
	$tot = $row['Total_amount'];
	echo $oid . " " . $tot . " ";

}*/

//============insert categories id to an array from orderdetails table======================
$qsug1 = "SELECT * from order_details";
$rsug1 = $conn->query($qsug1);

while ($fetchsug1 = mysqli_fetch_assoc($rsug1)) {
	$proid = $fetchsug1['Pro_ID'];
	$qsug2 = "SELECT Cat_ID from product WHERE Pro_ID='$proid';";
	$rsug2 = $conn->query($qsug2);
	$fetchsug2 = mysqli_fetch_assoc($rsug2);
	$catid = $fetchsug2['Cat_ID'];
	//echo $catid . " ";
	$categories[] = $catid;
}
//========================================================================================
//==================top 3 modes values and it's names into an array=======================
function array_mode($array)
{
	$counts = array_count_values($array);
	arsort($counts);
	$top_3_modes = array_keys($counts);
	$top_3_modes = array_slice($top_3_modes, 0, 3);
	return $top_3_modes;
}

$mode_cat = array_mode($categories); //---------------call to funtion--------
//print_r($mode_cat);

for ($i = 0; $i < sizeof($mode_cat); $i++) {
	$qsug3 = "SELECT Cat_Name from category WHERE Cat_ID='$mode_cat[$i]';";
	$rsug3 = $conn->query($qsug3);
	$fetchsug3 = mysqli_fetch_assoc($rsug3);
	$catname = $fetchsug3['Cat_Name'];
	$categoriesName[] = $catname;
}

//========================================================================================

//==================count of each top 3 modes=============================================
function array_mode2($array1)
{
	$counts1 = array_count_values($array1);
	arsort($counts1);
	$top_3_modes1 = array_slice($counts1, 0, 3);
	return $top_3_modes1;
}
$mode_cat2 = array_mode2($categories); //---------------call to funtion--------
//print_r($mode_cat2);
//===============================fines=================================================
$countRec = 0;
$countNotRec = 0;
$total = 0;

$qFines = "SELECT * FROM fines";
$rFines = $conn->query($qFines);
while ($rowFine = mysqli_fetch_assoc($rFines)) {
	$fineState = $rowFine['State'];
	$fineValue = $rowFine['Amount'];
	$total += $fineValue;
	if ($fineState == "NotRecieved") {
		$countNotRec += $fineValue;
	} else {
		$countRec += $fineValue;
	}
}
$fines = array($countNotRec, $countRec);
$fineStates = array("NotRecieved", "Recieved");
//============last order=================================================================
$sql3 = "SELECT * FROM order_tbl ORDER BY Order_ID DESC LIMIT 1 ;";
$result3 = $conn->query($sql3);
$row3 = mysqli_fetch_array($result3);
$lastid = $row3['Order_ID'];
$lastdate = $row3['Date_Created'];
$cus = $row3['Cus_ID'];
//=====================================================================================
?>

<!DOCTYPE HTML>
<html>

<body>
	<div id="frmDate"></div>
	<center>

		<hr>
		<h3 style="text-align:center;">Top 3 categories rented</h3>
		<div>
			<canvas id="graph" style="max-width:75%;"></canvas>
		</div>
		<br><br>
		<hr>
		<h3 style="text-align:center;">Fines details (Rs.)</h3>
		<br>
		<div>
			<canvas id="graph2" style="max-width:500px;"></canvas>
			Total :- Rs.
			<?php echo $total; ?>
		</div>

		<div>
			<hr>
			<h3 style="text-align:center;">Last Order Report</h3>
			<table border="1" style="text-align:center;" width="50%">
				<tr>
					<td style="background-color:Grey;color:White;">Order_ID</td>
					<td>
						<?php echo "$lastid"; ?>
					</td>
				</tr>
				<tr>
					<td style="background-color:Grey;color:White;">Customer ID</td>
					<td>
						<?php echo "$cus"; ?>
					</td>
				</tr>
				<tr>
					<td style="background-color:Grey;color:White;">Date Created</td>
					<td>
						<?php echo "$lastdate"; ?>
					</td>
				</tr>


			</table>
	</center>
	</div>

	<!-- js--------------------------------------------------------------------------------------------->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	<script type="text/javascript">

		var ctx = document.getElementById("graph").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($categoriesName); ?>,
				datasets: [{
					backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'],
					data: <?php echo json_encode($mode_cat2); ?>
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}],
					xAxes: [{
						barPercentage: 0.4
					}]
				},
				legend: {
					display: false,
					position: 'bottom',
					labels: {
						fontColor: '#71748d',
						fontFamily: 'Circular Std Book',
						fontSize: 14,
					}
				},
				yaxis: {
					startAtZero: true
				}
			}
		});	</script>

	<script type="text/javascript">

		var ctx1 = document.getElementById("graph2").getContext('2d');
		var myChart = new Chart(ctx1, {
			type: 'pie',
			data: {
				labels: <?php echo json_encode($fineStates); ?>,
				datasets: [{
					backgroundColor: ['red', 'green'],
					data: <?php echo json_encode($fines); ?>
				}]
			},
			options: {

				legend: {
					display: true,
					position: 'bottom',
					labels: {
						fontColor: '#71748d',
						fontFamily: 'Circular Std Book',
						fontSize: 14,
					}
				},
			}
		});	</script>

</body>

</html>