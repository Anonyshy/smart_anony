<?php
include_once("../../../connection.php");

session_start();
$loginame = $_SESSION['UserName'];
$inv_id = $_POST['inv_id'];
$order_id = $_POST['order_id'];
$uname = $_POST['UserName'];
$email = $_POST['email'];
$address = $_POST['address'];
$pn = $_POST['pnum'];
$tot = $_POST['tot'];
$date = $_POST['date_created'];

$queryCus = "SELECT * FROM customer WHERE UserName='$loginame' LIMIT 1; ";
$resultCus = $conn->query($queryCus);
$rowcus = $resultCus->fetch_assoc();
$cusid = $rowcus['Cus_ID'];

// Insert details to orders
$Insert = "INSERT INTO orders VALUES ('$order_id','$cusid','EMP_1','$date','$uname','$address','$email','$pn','$tot');";
$conn->query($Insert);

//insert details to invoice
$Insert2 = "INSERT INTO invoice VALUES ('$inv_id','$order_id','$date','$tot');";
$conn->query($Insert2);

//change product count & delete cart items after chkout
$querycheck = "SELECT * FROM product_temp_online WHERE Cus_Name='$loginame' ORDER BY prod_id ASC;";
$resultcheck = $conn->query($querycheck);

while ($rowcheck = $resultcheck->fetch_assoc()) {
    $prod_id = $rowcheck['prod_id'];
    $qty = $rowcheck['qty'];

    //search from product
    $queryprod = "SELECT * FROM product WHERE Prod_ID='$prod_id';";
    $resultprod = $conn->query($queryprod);
    $rowprod = $resultprod->fetch_assoc();

    $qtyAvail = $rowprod['Qty_Availble'];
    $unitPrice = $rowprod['List_Price'];

    $newqty = $qtyAvail - $qty;

    //update product count changes

    $queryUpdate = "UPDATE product SET Qty_Availble='$newqty' WHERE Prod_ID='$prod_id';";
    $conn->query($queryUpdate);

    //post details to product_details
    $Insert2 = "INSERT INTO order_details VALUES ('$order_id','$prod_id','$qty','$unitPrice','0');";
    $conn->query($Insert2);

}
header("Location: invoice.php?order=$order_id");


?>