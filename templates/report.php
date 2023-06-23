<?php
include_once("../pages/connection.php");

$sql = "SELECT * FROM Orders ;";
$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {
	$productname[] = $row['Order_ID'];
	$sales[] = $row['Total'];
}

$sql2 = "SELECT * FROM Orders ORDER BY Total DESC LIMIT 3 ;";
$result2 = $conn->query($sql2);
while ($row2 = mysqli_fetch_array($result2)) {
	$productid[] = $row2['Order_ID'];
	$sale[] = $row2['Total'];
}

$sql3 = "SELECT * FROM Orders ORDER BY Order_ID DESC LIMIT 1 ;";
$result3 = $conn->query($sql3);
$row3 = mysqli_fetch_array($result3);
	$lastprod = $row3['Order_ID'];
	$lasttotal = $row3['Total'];
	$emp = $row3['Emp_ID'];

?>

<!DOCTYPE HTML>
<html>

<body>
	<div id="frmDate"></div>
	<h3 style="text-align:center;">Top 3 Orders</h3>

	<div>
		<canvas id="graph2" style="height:100px"></canvas>
	</div>
	
	<hr><h3 style="text-align:center;">Total Sales</h3>
	<div>
		<canvas id="graph" style="height:300px"></canvas>
	</div>
	<center>
	<div>
		<hr>
		<h3 style="text-align:center;">Last Sell Report</h3>
		<table border="1" style="text-align:center;" width="50%">
			<tr >
				<td style="background-color:Grey;color:White;">Order_ID</td>
				<td ><?php echo "$lastprod";?></td>
			</tr>
			<tr>
				<td style="background-color:Grey;color:White;">Last Sales</td>
				<td >Rs.<?php echo "$lasttotal";?></td>
			</tr>
			<tr>
				<td style="background-color:Grey;color:White;">Create By</td>
				<td ><?php echo "$emp";?></td>
			</tr>
			
			
		</table></center>
	</div>

	<!-- js--------------------------------------------------------------------------------------------->
	<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script type="text/javascript">

		var ctx = document.getElementById("graph").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($productname); ?>,
				datasets: [{
					backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff'],
					data: <?php echo json_encode($sales); ?>
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
		});
	</script>
	<script type="text/javascript">

		var ctx = document.getElementById("graph2").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: <?php echo json_encode($productid); ?>,
				datasets: [{
					backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff'],
					data: <?php echo json_encode($sale); ?>
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
		});

	</script>

</body>

</html>