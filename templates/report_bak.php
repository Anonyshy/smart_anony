<!DOCTYPE HTML>
<html>

<head>
	<script type="text/javascript">
		window.onload = function () {

			var chart = new CanvasJS.Chart("chartContainer", {
				theme: "dark1", // "light2", "dark1", "dark2"
				animationEnabled: false, // change to true		
				title: {
					text: "Best Sale Product"
				},
				data: [
					{
						// Change type to "bar", "area", "spline", "pie",etc.
						type: "column",
						dataPoints: [
							{ label: "apple", y: 10 },
							{ label: "orange", y: 15 },
							{ label: "banana", y: 25 },
							{ label: "mango", y: 30 },
							{ label: "grape", y: 28 }
						]
					}
				]
			});
			chart.render();

			var chart1 = new CanvasJS.Chart("chartContainer1", {
				theme: "dark1", // "light2", "dark1", "dark2"
				animationEnabled: false, // change to true		
				title: {
					text: "Basic Column Chart"
				},
				data: [
					{
						// Change type to "bar", "area", "spline", "pie",etc.
						type: "pie",
						dataPoints: [
							{ label: "apple", y: 10 },
							{ label: "orange", y: 15 },
							{ label: "banana", y: 25 },
							{ label: "mango", y: 30 },
							{ label: "grape", y: 28 }
						]
					}
				]
			});
			chart1.render();

			var chart2 = new CanvasJS.Chart("chartContainer2", {
				theme: "dark1", // "light2", "dark1", "dark2"
				animationEnabled: false, // change to true		
				title: {
					text: "Sales Report"
				},
				data: [
					{
						// Change type to "bar", "area", "spline", "pie",etc.
						type: "bar",
						dataPoints: [
							{ label: "apple", y: 10 },
							{ label: "orange", y: 15 },
							{ label: "banana", y: 25 },
							{ label: "mango", y: 30 },
							{ label: "grape", y: 28 }
						]
					}
				]
			});
			chart2.render();
		}
	</script>
</head>

<body style="height:700px;">
	<center>
		<div id="chartContainer" style="height: 220px; width: 500px;"></div><br><br>
		<div id="chartContainer1" style="height: 200px; width: 500px;"></div><br><br>
		<div id="chartContainer2" style="height: 220px; width: 500px;"></div><br><br>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
	</center>
</body>

</html>