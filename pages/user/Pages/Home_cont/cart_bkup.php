<?php

include_once("../../../connection.php");
session_start();
$loginame = $_SESSION['UserName'];
if (isset($_GET['proid'])) {
	$id = $_GET['proid'];
	//echo $id;
}

if (isset($_GET['proidnew'])) {
	$idnew = $_GET['proidnew'];
	$query3 = "DELETE FROM product_temp_online WHERE prod_id='$idnew' AND Cus_Name='$loginame';";
	$conn->query($query3);
	header("location:cart.php");
	//echo "success";
}





?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible " content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"
		href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


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
		<div class="row">
			<?php


			$tempquery = "SELECT * FROM product_temp_online WHERE Cus_Name='$loginame'";
			$tempresult = $conn->query($tempquery);
			if ($tempresult->num_rows > 0) {
				$total = 0; ?>
				<table width="100%" border="1px" align="center" style=" text-align: center;color:white;">
					<tr>
						<th>Product</th>
						<th>Quantity</th>
						<th>Total</th>
						<th>Action</th>
					</tr>
					<?php
					while ($rowstemp = $tempresult->fetch_assoc()) {
						$proid = $rowstemp['prod_id'];
						$qty = $rowstemp['qty'];
						//$price = $rowstemp['List_Price'];
				
						$query = "SELECT * FROM product Where Prod_ID='$proid'";
						$result = $conn->query($query);
						if ($result->num_rows > 0) {

							while ($rows = $result->fetch_assoc()) {
								$name = $rows['Prod_Name'];
								$qtya = $rows['Qty_Availble'];
								$price = $rows['List_Price'];

								?>

								<tr style="align-items:center;">
									<td width="50%">
										<?php echo "<b>$name</b> | <font size='1px'>Available: $qtya </font>| <font size='1px'>Unit Price : $price</font>"; ?>
									</td>
									<td>
										<input type="number" style="width:50px;" placeholder="<?php echo $qty; ?>"> &nbsp; <a href="#"
											class="btn_add">Add</a>
									</td>
									<td width="300px">
										<?php echo "Rs.";
										echo ($price * $qty);
										echo ".00"; ?>
									</td>
									<td width="10px">
										<?php echo "<a href='cart.php?proid=$proid' onclick='confirmation();'  class='btn btn-danger mt-3'>Delete</a>"; ?>
									</td>
								</tr>



								<?php

								$total = $total + ($price * $qty);
							}
						}

					}
					?>
				</table>
			</div>
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
			} else { ?>
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

		<!-- error not fixed yet-->
		<script>
			function confirmation() {

				let prod = "<?php echo $id; ?>";
				let urlp = "cart.php?proidnew=";
				let fullurl = urlp + prod;
				
				let result = confirm("Are you really want to delete this item?");
				if (result) {
					//alert("Deleted"); 
					window.location.href ="cart.php";
					//fetch('cart.php?proidnew=1');
					console.log(fullurl);
				}
			}
		</script>

</body>

</html>