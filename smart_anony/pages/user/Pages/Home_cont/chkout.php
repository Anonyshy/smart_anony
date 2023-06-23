<?php
include_once("../../../connection.php");

session_start();
$loginame = $_SESSION['UserName'];
$queryCus = "SELECT * FROM customer WHERE UserName='$loginame' LIMIT 1;";
$resultCus = $conn->query($queryCus);
$rows = $resultCus->fetch_assoc();
$Address = $rows['Address1'];
$Email = $rows['Email'];
$phone = $rows['Phone'];


$id = $_GET['price'];
//..........order id...........
$query_1 = "SELECT * from orders order by Order_ID desc limit 1";
$result_1 = mysqli_query($conn, $query_1);
if ($result_1->num_rows > 0) {
  $row_2 = mysqli_fetch_array($result_1);
  $lastid = $row_2['Order_ID'];

} else {
  $lastid = " ";
}
if ($lastid == " ") {
  $order = "Order_1";
} else {
  $order1 = substr($lastid, 6);
  $order2 = intval($order1);
  $order = "Order_" . ($order2 + 1);
}

//..........Invoice id...........
$query_2 = "SELECT * from invoice order by Inv_ID desc limit 1";
$result_2 = mysqli_query($conn, $query_2);
if ($result_2->num_rows > 0) {
  $row_3 = mysqli_fetch_array($result_2);
  $lastid = $row_3['Inv_ID'];

  $inv1 = substr($lastid, 4);
  $inv2 = intval($inv1);
  $inv = "Inv_" . ($inv2 + 1);

} else {
  $inv = "Inv_1";
}

//................................

?>
<link rel="stylesheet" type="text/css" href="../../../../css/style_rege.css">

<body>

  <div class="box" style="margin-top:30px;">

    <h1>Order Details</h1>


    <form action="chkout_process.php" name="chkout" method="POST">
      <?php echo "
            <div class='row1'>
            <input type='hidden' name='order_id' value='$order'>
            <input type='hidden' name='inv_id' value='$inv'>
            <input type='hidden' name='date_created' id='frmDate'>
            
            <p>Full Name</p>
                <input type='text' name='UserName' placeholder='Enter Your name' value='$loginame' required=''><br>

                <p>Shipping Address</p>
                <input type='text' name='address' placeholder='Enter your address here' value='$Address' required=''><br>

                <p>Email</p>
                <input type='Email' name='email' placeholder='Enter email id' value='$Email'  required=''><br>

                <p>Phone Number</p>
                <input type='text' name='pnum' placeholder='Enter Phone no'  value='$phone'><br>

                <b>Total : 
                <input type='text' style='color:green;font-size:20px;' name='tot' value='$id' readonly>
                </b>
                <br>



                <input type='submit' name='submit' value='Order Now' onclick='message()'>
            </div>"; ?>
    </form>


  </div>

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