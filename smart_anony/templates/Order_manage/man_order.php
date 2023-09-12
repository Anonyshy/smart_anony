<?php
include_once("../../pages/connection.php");
$date = date("Y-m-d");
if (isset($_GET['oid'])) {
  $oid = $_GET['oid'];
  $inv = $_GET['inv'];
  $cusid = $_GET['cusid'];
  $dt = $_GET['dt'];
  $st = $_GET['st'];
  $fcolor = "";
  $h = 0; //array access loop number initialized
  $count = 1; //itteration count for script condition & checkbox loop number



  //=============================Adding to array current state and bg color==============================

  $queryst = "SELECT * from order_details Where Order_ID='$oid';";
  $resultst = $conn->query($queryst);

  $arr = array();
  $arr2 = array();
  while ($row8 = mysqli_fetch_assoc($resultst)) {
    $state = $row8['Status'];
    $DueDate = $row8['Due_Date'];
    if ($state == "TakenByUser") {
      if ($DueDate < $date) {
        echo "bla";
        // $state = "NotRecieved";
        //$color = "red";
        $autochg = "UPDATE order_details SET Status='NotRecieved' WHERE Order_ID=$oid ";
        $conn->query($autochg);
      }
    }
    if ($state == "Ordered") {
      $color = "green";
    } elseif ($state == "ToDeliver") {
      $color = "yellow";
      $fcolor = "black";
    } elseif ($state == "TakenByUser") {
      $color = "grey";

    } elseif ($state == "NotRecieved") {
      $color = "red";
    } else {
      $color = "white";
      $fcolor = "black";
    }
    $arr[] = $state;
    $arr2[] = $color;


  }
  //=================insert into array below variables==========================================================
  $ordered = "Ordered";
  $Todel = "ToDeliver";
  $NotRec = "NotRecieved";
  $TakenUser = "TakenByUser";
  $Finished = "Finished";

  $arraystates = array($ordered, $Todel, $NotRec, $TakenUser, $Finished);

  //================================================
  $query = "SELECT * from order_details WHERE Order_ID='$oid'";
  $result = $conn->query($query);

  ?>

  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/home.css" rel="stylesheet">
  <style>
    button.back:hover {

      background-color: #005f00;
    }
  </style>
  <div style="padding-left: 10px;color:grey;">

    <h3>Invoice_id &nbsp; :-
      <?php echo $inv ?>
    </h3>
    <h3>Order_ID &nbsp;&nbsp;&nbsp; :-
      <?php echo $oid ?>
    </h3>
  </div>

  <div class="add-cat" Id="add-cat">

    <div class="manage-cat" id="manage-cat1">
      <a href="../order.php?click=ok" style="text-decoration: none;"><button class="back"
          style="margin-left: -67px;">Back</button></a>
      <table class="table_prod" id="table" width="800px" border="1px" style="color:white;">
        <thead>

          <tr height="50px" style="background-color:black;color:white;">
            <th>Product Name</th>
            <th>Date Created</th>
            <th>Due Date</th>
            <th>Current State</th>
            <th>Fines (if have)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody align="center">
          <?php

          while ($rowresult = mysqli_fetch_assoc($result)) {
            $Pro_ID = $rowresult['Pro_ID'];
            $DueDt = $rowresult['Due_Date'];

            $query1 = "SELECT * from product WHERE Pro_ID='$Pro_ID' LIMIT 1";
            $result1 = $conn->query($query1);

            $result2 = mysqli_fetch_assoc($result1);
            $Proname = $result2['Pro_name'];
            $qty = $result2['Qty_available'];

            ?>
            <form Action="change_state.php" method="post">

              <tr height="50px">
                <td>
                  <?php
                  echo $Proname; ?>
                </td>
                <td>
                  <?php
                  echo $dt; ?>
                </td>
                <td>
                  <?php
                  echo $DueDt; ?>
                </td>

                <td style="background-color: <?php echo $arr2[$h]; ?>">
                  <?php
                  //==================disabled if state = "Finished" =====================================
                  if ($arr[$h] == "Finished") {
                    ?>
                    <select name="state" id="state" disabled>

                      <option value="<?php echo $arr[$h]; ?>" selected>
                        <?php echo $arr[$h]; ?>
                      </option>
                      <?php
                  } else {
                    //========================================================================================
                    ?>
                      <select name="state" id="state">

                        <!-- //================================set selected ==================================================== -->

                        <option value="<?php echo $arr[$h]; ?>" selected>
                          <?php echo $arr[$h]; ?>
                        </option>
                        <?php

                        //==================================read new array excluding above set selected value=============================================================
                        for ($j = 0; $j < sizeof($arraystates); $j++) {
                          if ($arraystates[$j] == $arr[$h])
                            continue;
                          ?>
                          <option value="<?php echo $arraystates[$j]; ?>"><?php echo $arraystates[$j]; ?> </option>
                          <?php

                        }

                        ?>
                      </select>

                      <?php
                  }
                  // print_r($arr); ?>
                </td>
                <td>
                  <?php
                  //===========================fines display===================================
                  $qfines = "SELECT * FROM fines WHERE Order_ID=$oid AND Pro_ID=$Pro_ID";
                  $rfines = $conn->query($qfines);
                  if (mysqli_num_rows($rfines) > 0) {
                    $rowfines = mysqli_fetch_assoc($rfines);
                    $finesamount = $rowfines['Amount'];
                    $finesstate = $rowfines['State'];

                    echo "RS." . $finesamount; ?>

                    <input type="checkbox" id="checkbox<?php echo $Pro_ID; ?>" value="Recieved"
                      onclick="ispaid(<?php echo $oid; ?>,<?php echo $Pro_ID; ?>)">
                    <?php
                    if ($finesstate == "Recieved") {
                      echo "<script>document.getElementById('checkbox$Pro_ID').checked = true;</script>";
                    }
                  } else {
                    echo "-";
                  }
                  ?>

                </td>
                <td>
                  <!-- =======================action button====================================-->
                  <?php

                  if ($arr[$h] == "Finished") {
                    ?>
                    <input type="submit" class='del_cat' value="Save" disabled>
                    <?php
                  } else {
                    ?>
                    <input type="submit" class='del_cat' value="Save">
                    <?php
                  }
                  //============================================================================
                  ?>

                </td>

              </tr>

              <input type="hidden" name="orid" value="<?php echo $oid; ?>">
              <input type="hidden" name="pid" value="<?php echo $Pro_ID; ?>">
              <input type="hidden" name="qty" value="<?php echo $qty; ?>">

            </form>
            <?php
            $count++;
            $h++;
            //echo $qty;
          }

          ?>
          <!--<tr>
            <td colspan="4"></td>
            <td><button id="myButton">Click to save</button></td>
            <td></td>
          </tr>-->
        </tbody>
      </table>
      <table class="table_prod" width="800px" border="1px" style="color:white;">
        <thead>
          <tr>
            <th colspan="5" style="background-color:red;">
              <marquee>Customer Details</marquee>
            </th>
          </tr>
          <tr height="50px" style="background-color:white;color:black;">
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
            <th>Email</th>
            <th>Contact Number</th>
          </tr>
        </thead>
        <tbody align="center">
          <?php
          $qcus = "SELECT * FROM customer WHERE Cus_ID='$cusid' LIMIT 1";
          $rcus = $conn->query($qcus);
          $rowcus = mysqli_fetch_assoc($rcus);
          $name = $rowcus['Username'];
          $address = $rowcus['Address'];
          $email = $rowcus['Email'];
          $pn = $rowcus['PN'];
          ?>
          <tr>
            <td>
              <?php echo $cusid; ?>
            </td>
            <td>
              <?php echo $name; ?>
            </td>
            <td>
              <?php echo $address; ?>
            </td>
            <td>
              <?php echo $email; ?>
            </td>
            <td>
              <?php echo $pn; ?>
            </td>
          </tr>
        </tbody>
      </table>

      <?php
}

if (isset($_GET['savechng'])) {
  $statechange = $_GET['savechng'];
  $orid = $_GET['orid'];
  $pid = $_GET['pid'];
  $qty = $_GET['qty'];
  $newqty = $qty + 1;
  echo $statechange . " ";
  echo $orid . " ";
  echo $newqty;
  $stquery = "UPDATE order_details SET Status='$statechange' WHERE Order_ID='$orid' AND Pro_ID='$pid'";
  $conn->query($stquery);
  if ($statechange == "Finished") {

    $stquery1 = "UPDATE product SET Qty_available='$newqty' WHERE Pro_ID='$pid'";
    $conn->query($stquery1);
  }
  //echo $_GET['savechng'];
  //echo "<script>alert('Save Changes Successfully...');</script>";
  echo "<script>window.close();</script>";


}
?>
  </div>

</div>
<script>
  //  const myArray = [];

  function ispaid(foid, fpid) {

    var ckbox = document.getElementById("checkbox" + fpid);
    if (ckbox.checked) {
      console.log("Ok" + fpid);
      // myArray.push(fpid);
      var url = "../order.php?click=ok&select=ok&FineProID=" + fpid + "&FineOID=" + foid;
      window.location.href = url;
    } else {
      console.log("No" + fpid);
      var url = "../order.php?click=ok&select=no&FineProID=" + fpid + "&FineOID=" + foid;
      window.location.href = url;
    }

  }

</script>