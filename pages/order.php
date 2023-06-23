<?php
include_once("connection.php");

if (isset($_GET['del'])) {
  $Del = "DELETE FROM product_temp;";
  $conn->query($Del);
}

$query = "SELECT * from product order by Prod_Name asc";
$result = $conn->query($query);

//................Emp Id ...........................
session_start();
$emp = $_SESSION['UserName'];
$sqlemp = "SELECT * FROM employee WHERE UserName='$emp' LIMIT 1;";
$resultemp = $conn->query($sqlemp);
$emprow = mysqli_fetch_array($resultemp);
$empid = $emprow['EMP_ID'];


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
$dis = "5";
?>
<link href="../css/order.css" rel="stylesheet">

<body
  style=" background: url(../Image/bg.jpg);background-size: cover;display: flex;justify-content: center;align-items: center;padding: 10px;">
<script>
  document.getElementById("continue")style.display="none";
</script>

  <div class="add-cat">
    <form action="order_process.php" method="post">
      <select name="prod" style="width:200px;height:30px;">
        <?php


        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <option id="proname" value="<?php echo $row['Prod_ID']; ?>">
            <?php echo $row['Prod_Name'];
            $getrow = $row['Prod_Name']; ?>
          </option>
          <?php


        }

        ?>

      </select>
      <label style="color: aliceblue;">QTY</label>
      <input type="number" name="quentity" value="1" style="width: 60px;">
      &nbsp;&nbsp;<button type="submit" class="add">+ Add</button>
    </form>

    <!-- ------------------------------------------------------------------------------------->

    <form id="category_form" method="post" action="#">
      <div class="form-group">
        <div class="box">
          <input type="hidden" value="<?php echo $order; ?>" name="order_id">
          <label>Invoice ID </label>
          <input type="text" value="<?php echo $inv; ?>" name="inv_id" readonly>

          <label class="cusname">Customer Name</label>
          <input type="text" name="cusname" value="Customer"><br><br>

          <label>Create By</label>
          <input type="text" style="margin-left:8px ;" value="<?php echo $_SESSION['UserName']; ?>" name="emp" readonly>

          <label class="date">Date</label><label></label>
          <input type="text" style="margin-left:101px ;" id="frmDate" name="datec">

          <?php echo "<input type='submit' value='NEXT' name='submit'  formaction='order.php'>"; ?>
        </div>

        <br>

        <br><br><br><div id="print">
        
          <button formaction="orderprint.php" id="continue">Click To Continue</button>
        </div>
        <table width="100%" border="1px" cellspacing="0" id="myTable">
          <tr>
            <td colspan="5" align="right">Discount : </td>
            <td>
              <input type="number" value="<?php echo $dis; ?>" name="dis" id="dis" onchange="totalf();"
                style="width:50%;">%
            </td>

          </tr>

          <tr height="40px">
            <th>Product Name</th>
            <th>Availble Qty</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th>&nbsp;Action&nbsp;</th>
          </tr>


          <?php
          /*if (isset(($_GET['id']))){
          $id = $_GET['id'];
          $query1="DELETE From "
          }*/
          $querytemp1 = "SELECT * from product_temp; ";
          $resulttemp1 = $conn->query($querytemp1);
          $total = '0';
          $final_total = '0';

          while ($rowtemp1 = mysqli_fetch_assoc($resulttemp1)) {
            $rowtemp2 = $rowtemp1['prod_ID'];
            $rowtempqty = $rowtemp1['qenty'];

            $querysrc = "SELECT * from product where Prod_ID='$rowtemp2';";
            $resulttemp2 = $conn->query($querysrc);
            while ($rowtemp3 = mysqli_fetch_assoc($resulttemp2)) {
              $cell1 = $rowtemp3['Prod_Name'];
              $cell2 = $rowtemp3['Qty_Availble'];
              $cell3 = $rowtemp3['List_Price'];

              $tot = $cell3 * $rowtempqty;
              $total = $total + $tot;



              ?>
          <tr align="center">
            <td>
              <input type="text" value="<?php echo $cell1; ?>" readonly>
            </td>

            <td><input type="text" value="<?php echo $cell2; ?>" readonly></td>

            <td><input type="number" id="quentity1" name="qty" value="<?php echo $rowtempqty; ?>" readonly></td>
            <td><input type="text" value="<?php echo $cell3; ?>" readonly></td>
            <td><input type="text" value="<?php echo $tot . '.00'; ?>" readonly></td>
            <td>
              <?php echo "<a href='order.php?prodid=$rowtemp2' value='Delete' class='delete' >Delete</a>" ?>
            </td>
          </tr>

          <?php

              //echo $order, $rowtemp2, $rowtempqty, $cell3;
              //$sql_details = "INSERT INTO order_details VALUES ('$order','Prod_2','3','1000','0.00');";
              //$conn->query($sql_details);
              //$sql_details = "INSERT INTO order_details VALUES ('$order','$rowtemp2','$rowtempqty','$cell3','0');";
          

            }
          } ?>
          <tr>
            <td colspan="4" align="right">Total Amount : </td>
            <input type="hidden" id="totalfi" value="<?php echo $total; ?>">
            <td><input type="text" name="final_total" value="<?php $final_total = ($total * ((100 - $dis) / 100));
            echo $final_total; ?>" id="final_total" readonly>
            </td>

            <td></td>
          </tr>


        </table>
    </form>
    <br>
  </div>

  </div>


  <script>
    var discount = document.getElementById("dis");
    var total = document.getElementById("totalfi");
    var totallast = document.getElementById("final_total");

    function totalf() {
      totallast.value = ((100 - (discount.value)) / 100) * (total.value);
    }
    totalf();

    function getDate() {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var datestring = yyyy + "/" + mm + "/" + dd;
      document.getElementById("frmDate").value = datestring;
    }

    getDate();
    function nextpage()
    {
      document.getElementById('myTable').style.display = "none";
      document.getElementById('print').style.display = "block";
    }


  </script>

<?php
if (isset($_POST['final_total'])) {
  $date = $_POST['datec'];
  $cusname = $_POST['cusname'];
  $dis = $_POST['dis'];
  $final_total = $_POST['final_total'];
  $sql = "INSERT INTO orders VALUES ('$order','Cus_0','$empid','$date','$cusname','','','','$final_total');";
  $conn->query($sql);

  $querycheck = "SELECT * FROM product_temp;";
  $resultcheck = $conn->query($querycheck);

  while ($rowcheck = $resultcheck->fetch_assoc()) {
    $prod_id = $rowcheck['prod_ID'];
    $qty = $rowcheck['qenty'];

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
    $Insert2 = "INSERT INTO order_details VALUES ('$order','$prod_id','$qty','$unitPrice','$dis');";
    $conn->query($Insert2);

  }
 
  $sql_invoice = "INSERT INTO invoice VALUES ('$inv','$order','$date','$final_total');";
  $conn->query($sql_invoice);
  //header('orderprint.php');
  echo "<script>nextpage();</script>";
}
if (isset($_GET['prodid'])) {
  $prodid = $_GET['prodid'];
  $querydel = "DELETE FROM product_temp where prod_ID='$prodid';";
  $conn->query($querydel);
  header('location:order.php');
}

?>
</body>