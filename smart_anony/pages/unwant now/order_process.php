<?php


/* $prodname = $_POST['prod'];
$querypro = "SELECT * from product where Prod_Name='$prodname';";
$resultpro = $conn->query($querypro);
$rowpro = mysqli_fetch_assoc($resultpro);*/

include_once('connection.php');

$nametemp = $_POST['prod'];
$quentity = $_POST['quentity'];
$queryprod = "SELECT Qty_Availble FROM product WHERE Prod_ID='$nametemp';";
$resultquentity = $conn->query($queryprod);
$rows = $resultquentity->fetch_assoc();
$rowqty = $rows['Qty_Availble'];

$querytemp = "INSERT into product_temp values ('$nametemp','$quentity');";
if ($rowqty >= $quentity) {
   $conn->query($querytemp);
   //echo '<script>alert("Product Added Succesfully")</script>';
   header('location:order.php');
} else

   echo "<script>alert(\"Selected item, there are only \'$rowqty\' in our stock. Please enter less amount of availble from our store\")</script>";
include_once('order.php');

?>