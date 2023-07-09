<?php

include_once("../../../connection.php");
session_start();
$loginame = $_SESSION['Username'];

//================================Delete product from cart==========================================
if (isset($_GET['proid'])) {
	$id = "cart.php?idd=" . $_GET['proid'];
	//echo "<script> confirm('$id');</script>";
	echo "<script>let res = confirm('Are you sure you want to delete this?');if(res){window.location.href = '$id';console.log('ok');}else{window.location.href = 'cart.php';console.log('no');}</script>";
  }
  if (isset($_GET['idd'])) {
	//echo "OKK";
	$idd = $_GET['idd'];
	//echo $idd;
	$delquery = "DELETE FROM product_temp where id='$idd' And Username='$loginame';";
	$conn->query($delquery);
  }


//=============================Insert to wishlist and delete from cart=======================
if(isset($_GET['moveid'])){
	$moveid = $_GET['moveid'];
	$query = "INSERT INTO wishlist values ('$moveid','$loginame');";
	$conn->query($query);
	$query2 = "DELETE FROM product_temp WHERE id='$moveid' AND Username='$loginame';";
	$conn->query($query2);

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

		.mt3 {
			background-color: greenyellow;
		}
	</style>

</head>

<body background="../../Images/bg_prod.jpg">


	<br><br>
	<div class="container mt-5">
		<a href="wish.php" class="btn btn-primary"><span
				class="glyphicon glyphicon-heart "></span>&nbsp;Wishlist</a><br><br><br>
		<div class="row">
			<?php


			$tempquery = "SELECT * FROM product_temp WHERE Username='$loginame'";
			$tempresult = $conn->query($tempquery);
			if ($tempresult->num_rows > 0) {
				$total = 0; ?>
				<table width="100%" border="1px" align="center" style=" text-align: center;color:white;">

					<?php
					while ($rowstemp = $tempresult->fetch_assoc()) {
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
											<?php echo "<a href='cart.php?proid=$proid'   class='btn btn-danger mt-3'>Delete</a> <a href='cart.php?moveid=$proid'   class='btn btn-success mt-3'>Move to Wishlist</a>"; ?>
										</td>
									</tr>



									<?php

									$total = $total + ($price);
								} else {
									
									$query = "INSERT INTO wishlist values ('$proid','$loginame');";
									$conn->query($query);
									$query2 = "DELETE FROM product_temp WHERE id='$proid' AND Username='$loginame';";
									$conn->query($query2);
									

								}
							}
						}

					}
					?>
				</table>
			</div><br><br>
			<div class="checkout" style="background-color:White;padding:8px;display: flex;">
				<div style="margin-Right:55%;margin-left:5%;font-family: Verdana;font-size:20px;color:Red;">
					<p style="color:Black;"><br><b>Total :-
							<font color="Green"> Rs.
								<?php
								echo "$total";
								?>.00
							</font>
						</b>
					</p>
				</div>
				<div>
					<?php echo "<a href='chkout.php?price=$total' class='btn btn-danger mt-3'>Checkout</a>"; ?>
				</div>
			</div>




			<?php
			} else { ?><br><br>
			<div class="checkout" style="background-color:#67da22;padding:8px;display: flex;">
				<div style="margin-Right:55%;margin-left:5%;font-family: Verdana;font-size:20px;color:Red;">
					<p style="color:Black;"><b>Total :-
							<font color="red"> Rs.
								<?php $total = 0;
								echo "$total"; ?>.00
							</font>
						</b>
					</p>
				</div>
				<div>
					<button style="padding:5px;margin-left:120%;">Checkout</button>
				</div>
			</div>
		<?php }

			?>

</body>

</html>