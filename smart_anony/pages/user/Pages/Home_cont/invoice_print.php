<?php
include_once("../../../connection.php");

session_start();
$loginame = $_SESSION['UserName'];


//================delete temp table product=======================================
$queryDel = "DELETE FROM product_temp WHERE Username='$loginame';";
$conn->query($queryDel);

header("location: ../Home.php");

?>