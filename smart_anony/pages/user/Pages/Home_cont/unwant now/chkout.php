<?php
include_once("../../../connection.php");

session_start();
$loginame = $_SESSION['Username'];
$queryCus = "SELECT * FROM customer WHERE Username='$loginame' LIMIT 1;";
$resultCus = $conn->query($queryCus);
$rows = $resultCus->fetch_assoc();
$Address = $rows['Address'];
$Email = $rows['Email'];
$phone = $rows['PN'];

$price = $_GET['price'];

?>

<body background="https://wallpaperaccess.com/full/2666312.jpg">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <style>
    form {
      margin-top: 50px;
      margin-left: 40%;
    }

    input {
      width: 300px;
      height: 30px;
    }

    p {
      font-weight: bolder;
    }
  </style>
  <div class="container">


    <div class="form">
      <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
        <input type="hidden" name="merchant_id" value="1223489"> <!-- Replace your Merchant ID -->
        <input type="hidden" name="return_url" value="http://localhost/smart_anony/pages/user/">
        <input type="hidden" name="cancel_url" value="http://localhost/smart_anony/pages/user/">
        <input type="hidden" name="notify_url" value="http://sample.com/notify">

        <input type="hidden" name="order_id" value="0">

        <input type="hidden" name="items" value=" ">
        <input type="hidden" name="currency" value="LKR">

        <p>Full Name</p>
        <input type="text" name="first_name" value="<?= $loginame ?>"><br><br>
        <input type="hidden" name="last_name" value=" ">
        <p>Email</p>
        <input type="text" name="email" value="<?= $Email ?>"><br><br>
        <p>Phone Number</p>
        <input type="text" name="phone" value="<?= $phone ?>"><br><br>
        <p>Address</p>
        <input type="text" name="address" value="<?= $Address ?>"><br><br>
        <p>Price</p>
        <input type="text" name="amoun" value="Rs. <?= $price ?>.00" readonly><br>
        <input type="hidden" name="amount" value="<?= $price ?>" readonly>

        <input type="hidden" name="city" value=" ">
        <input type="hidden" name="country" value="Sri Lanka">
        <input type="hidden" name="hash" value="098F6BCD4621D373CADE4E832627B4F6"> <!-- Replace with generated hash -->
        <br>
        <input type="submit" class="btn btn-success" value="Buy Now">
      </form>
    </div>
  </div>
  <?php


  if (isset($_POST['amount'])) {
    $uname = $_POST['first_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pn = $_POST['phone'];
    //$date = $_POST['date_created'];
    $merchant_id = $_POST['merchant_id'];
    $order_id = $_POST['order_id'];
    $payhere_amount = $_POST['amount'];
    $payhere_currency = $_POST['currency'];
    $status_code = $_POST['status_code'];
    $md5sig = $_POST['md5sig'];

    $merchant_secret = 'OTkyNzk5MTU3MTk2Mjg5Mjc1MzIxMTAyNzI2NTc2MjcxNzI5OA=='; // Replace with your Merchant Secret
  
    $local_md5sig = strtoupper(
      md5(
        $merchant_id .
        $order_id .
        $payhere_amount .
        $payhere_currency .
        $status_code .
        strtoupper(md5($merchant_secret))
      )
    );

    if (($local_md5sig === $md5sig) and ($status_code == 2)) {
      // Update your database as payment success
      echo "Done";
    }
    $queryCus = "SELECT * FROM customer WHERE Username='$loginame' LIMIT 1; ";
    $resultCus = $conn->query($queryCus);
    $rowcus = $resultCus->fetch_assoc();
    $cusid = $rowcus['Cus_ID'];

    // Insert details to orders
    $Insert = "INSERT INTO order_tbl VALUES ('','$cusid','#2022.10.10#');";
    $conn->query($Insert);

    //insert details to invoice
    $Insert2 = "INSERT INTO invoice VALUES ('','1','#2022.10.10#','$payhere_amount');";
    $conn->query($Insert2);
  }






  ?>

  <script>
    function message() {
      alert('Ordered Successfully');
      //window.location.href = "invoice.php";

    }

    function getDate() {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var datestring = yyyy + "/" + mm + "/" + dd;
      document.getElementById("frmDate").value = datestring;
    }
    getDate();

  </script>
</body>