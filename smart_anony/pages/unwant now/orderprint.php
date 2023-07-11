<body style=" background: url(../Image/bg.jpg);background-size: cover;display: flex;justify-content: center;align-items: center;padding: 10px;">
<?php
include_once("connection.php");

$sqlinv = "SELECT * FROM invoice ORDER BY Inv_ID DESC LIMIT 1;";
$sqlreinv = $conn->query($sqlinv);

$resultinv = $sqlreinv->fetch_assoc();
$inv = $resultinv['Inv_ID'];
$Date = $resultinv['Invoice_Date'];

$sqlorder = "SELECT * FROM orders ORDER BY Order_ID DESC LIMIT 1;";
$sqlreorder = $conn->query($sqlorder);


$resultorder = $sqlreorder->fetch_assoc();
$order = $resultorder['Order_ID'];
$cusname = $resultorder['Reciever'];
$emp = $resultorder['Emp_ID'];

?>
  
  <link href="../css/order.css" rel="stylesheet">
  
  <div class="add-cat">

    <!-- ------------------------------------------------------------------------------------->

    <form id="category_form">
      <div class="form-group">
        <div class="box">
          <input type="hidden" value="Order_6" name="order_id">
          <label>Invoice ID </label>
          <input type="text" value="<?php echo $inv; ?>" name="inv_id" readonly="">

          <label class="cusname">Customer Name</label>
          <input type="text" name="cusname" value="<?php echo $cusname; ?>"><br><br>

          <label>Create By</label>
          <input type="text" style="margin-left:8px ;" value="<?php echo $emp; ?>" name="emp" readonly="">

          <label class="date">Date</label>
          <input type="text" style="margin-left:101px ;" value="<?php echo $Date; ?>" id="frmDate" name="datec">
          <input type="button" value="Print" onclick="printnow();" >
        </div>
    </form>
    <br>

    <br><br><br>
    <table width="100%" border="1px" cellspacing="0" id="myTable">
      <tbody>


        <tr height="40px">
          <th>Product Name</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Total</th>

        </tr>
        <?php

        //echo $order;
        $sql = "SELECT * FROM order_details WHERE Order_ID='$order' LIMIT 1;";
        $sqlre = $conn->query($sql);
        session_start();
        while ($result = $sqlre->fetch_assoc()) {
          $_SESSION['dis'] = $result['Discount'];
        }

        $dis = $_SESSION['dis'];
        //echo $dis;

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
            <?php echo $cell1; ?>
          </td>
          <td>
            <?php echo $rowtempqty; ?>
          </td>
          <td>
            <?php echo $cell3; ?>
          </td>
          <td>
            <?php echo $tot; ?>
          </td>
        </tr>
        <?php
          }
        }
        ?>

        <tr>
          <td colspan="3" align="right">Total : </td>
          <td>
            <?php echo $total; ?>
          </td>
        </tr>

        <tr>
          <td colspan="3" align="right">Discount : </td>
          <td>
            <?php echo $dis; ?> %
          </td>
        </tr>

        <tr>
          <td colspan="3" align="right">Total Amount : </td>
          <td>
            <?php if ($dis == 0) {
              echo ($total);
            } else {
              echo ((100-$dis) * $total/100);
            } ?>
          </td>
        </tr>


      </tbody>
    </table>

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
function printnow(){
  window.print();
  window.location.href="order.php?del=ok";
}

  </script>

</body>