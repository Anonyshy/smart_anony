<?php

include_once("../../../connection.php");
session_start();
$loginame = $_SESSION['Username'];


if (isset($_GET['proidnew'])) {
	$idnew = $_GET['proidnew'];
	$query3 = "DELETE FROM product_temp_online WHERE prod_id='$idnew' AND Cus_Name='$loginame';";
	$conn->query($query3);
	header("location:cart.php");
	//echo "success";
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$loginame = $_SESSION['Username'];
	//$quanty = $_POST['quant'];
	$query = "INSERT INTO product_temp values ('$id','$loginame');";
		$conn->query($query);
		$query2 = "DELETE FROM wishlist WHERE id='$id' AND Username='$loginame';";
		$conn->query($query2);	
		echo "<script>alert('Added Successfully!')</script>";
	  
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
	<link rel="stylesheet" type="text/css" href="../../CSS/External.css">
	<style>
		a,
		h1,
		p.con,
		pre {
			color: white;
			font-family: Arial;
			text-decoration: none;
		}

		
	</style>

</head>

<body background="../../Images/bg_prod.jpg">


	<br><br>
	<div class="container mt-5">
		<a href="cart.php" class="btn btn-warning"><span class="glyphicon glyphicon-heart "></span>&nbsp;Cart</a><br><br><br>
		<div class="row">
			<?php


			$wishquery = "SELECT * FROM wishlist WHERE Username='$loginame'";
			$wishresult = $conn->query($wishquery);
			if ($wishresult->num_rows > 0) {
				$total = 0; ?>
				<table width="100%" border="1px" align="center" style=" text-align: center;color:white;">
					
					<?php
					while ($rowstemp = $wishresult->fetch_assoc()) {
						$proid = $rowstemp['id'];
						//$qty = $rowstemp['qty'];
						//$price = $rowstemp['List_Price'];
				
						$query = "SELECT * FROM product Where Pro_ID='$proid';";
						$result = $conn->query($query);
						if ($result->num_rows > 0) {

							while ($rows = $result->fetch_assoc()) {
								$name = $rows['Pro_name'];
								$qtya = $rows['Qty_available'];
								$price = $rows['Cost'];
								if ($qtya > 0) {
									?>

									<tr style="align-items:center;">
										<td width="50%">
											<?php echo "<b>$name</b> | <font size='1px'>Available: $qtya </font>| <font size='1px'>Unit Price : $price</font>"; ?>
										</td>


										<td width="10px">
											<?php echo "<a href='cart.php?proid=$proid'   class='btn btn-danger mt-3'>Delete</a> <a href='wish.php?id=$proid'   class='btn btn-success mt-3'>Add to Cart</a>"; ?>
										</td>
									</tr>



									<?php

									$total = $total + ($price);
								} else {
									?>

									<tr style="align-items:center;">
										<td width="50%">
											<?php echo "<b>$name</b> | <font size='1px'>Available: <font color='red'>Out of stock</font> </font>| <font size='1px'>Unit Price : $price</font>"; ?>
										</td>


										<td width="10px">
											<?php echo "<a href='cart.php?proid=$proid'   class='btn btn-danger mt-3'>Delete</a>"; ?>
										</td>
									</tr>



									<?php

								}
							}
						}

					}
					?>
				</table>
			</div>
		




			<?php
			} else { ?>
			<p>No items</p>
		<?php }

			?>

</body>

</html>