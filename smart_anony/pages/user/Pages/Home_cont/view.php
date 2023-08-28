<?php
include_once("../../../connection.php");
//this is for preview trailer

$id = $_GET['id'];
$name = $_GET['name'];
$cat = $_GET['cat'];

$query = "SELECT * FROM product WHERE Pro_ID=$id";
$result = $conn->query($query);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$des = $row['Description'];
	$url =$row['url'];
}
?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible " content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"
		href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		,
		.row .col-3 {
			font-family: Verdana, Tahoma, sans-serif;
			
		}

		.col-md-auto {
			font-family: 'Times New Roman', Times, serif;
			color: white;
			font-weight: bolder;
			font-size: xx-large;
		}

		.row {
			padding: 5px;
			color: white;
			background-color: darkslategray;
			font-size: medium;
		}
	</style>

</head>

<body background="../../Images/bg_prod.jpg">


	<div class="container"><br>
		<div class="row justify-content-md-center">

			<div class="col-md-auto ">
				<?php echo $name ?>

			</div>

		</div><br>
		<div class="row">

			<div class="col-9">

				<iframe class="embed-responsive-item" src="<?php echo $url?>"
					height="450px" width="800px" allowfullscreen></iframe>

			</div>
			<div class="col-3 text-justify" ><br><br><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $des ?>
			</div>
		</div>
	</div>

</body>

</html>