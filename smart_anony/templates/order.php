<?php
include_once("../pages/connection.php");

$date = date("Y-m-d");
//echo $date;
//<!-- ====================auto click once "All" button====================== -->
if (isset($_GET['click'])) {
  ?>

  <a href="order.php?all=ok&check=1" id="myButton">
  </a>
  <?php
  echo "<script>
    
    window.location.href = \"order.php\";
    window.document.getElementById(\"myButton\").click();
  </script>";
  //=============================================================================
}
if (isset($_GET['FineProID'])) {
  $pid = $_GET['FineProID'];
  $oid = $_GET['FineOID'];
  if ($_GET['select'] == "ok") {
    $fineUpdate = "UPDATE fines SET State='Recieved' WHERE Order_ID=$oid AND Pro_ID=$pid";
  } else {
    $fineUpdate = "UPDATE fines SET State='NotRecieved' WHERE Order_ID=$oid AND Pro_ID=$pid";
  }
  $conn->query($fineUpdate);
}
?>

<link href="../css/style.css" rel="stylesheet">
<link href="../css/home.css" rel="stylesheet">
<style>
  ul a li:hover {
    background-color: #005f00;
  }
</style>
<marquee bgcolor="grey" Direction="right" style="padding: 5px;">
  <h3 style="color:White;font-family: sans-serif;">Order Manage</h3>
</marquee>
<div class="add-manage">
  <ul style=" display: flex;">
    <a href="order.php?all=ok&check=1" id="myButton">
      <li>All</li>
    </a>
    <a href="order.php?order=ok&check=1">
      <li>Ordered</li>
    </a>
    <a href="order.php?todel=ok&check=1">
      <li>To Deliver</li>
    </a>
    <a href="order.php?taken=ok&check=1">
      <li>Taken By User</li>
    </a>
    <a href="order.php?notrec=No&check=1">
      <li>Not recieved</li>
    </a>
    <a href="order.php?finished=ok&check=1">
      <li>Finished</li>
    </a>
  </ul>
</div>
<div class="add-cat">

  <div class="manage-cat" id="all">
    <table class="table_prod" id="table" width="800px" border="1px" style="color:white;">
      <thead>
        <tr height="50px" style="background-color:black;color:white;">
          <th>Invoice ID</th>
          <th>Order ID</th>
          <th>Customer ID</th>
          <th>Date Created</th>
          <th>Current State</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="get_category" align="center">
        <?php
        if (isset($_GET['all'])) {
          $query = "SELECT * from order_tbl order by Order_ID Desc";
          $result = $conn->query($query);
          $fcolor = "";
          while ($row1 = mysqli_fetch_assoc($result)) {
            $row2 = $row1['Order_ID'];
            $row3 = $row1['Cus_ID'];
            $row4 = $row1['Date_Created'];

            $qInv = "SELECT Inv_ID from invoice Where Order_ID='$row2';";
            $rInv = $conn->query($qInv);
            $rowInv = mysqli_fetch_assoc($rInv);
            $InvId = $rowInv['Inv_ID'];

            $queryst = "SELECT * from order_details Where Order_ID='$row2';";
            $resultst = $conn->query($queryst);
            $row8 = mysqli_fetch_assoc($resultst);
            $state = $row8['Status'];
            $DueDate = $row8['Due_Date'];
            //=========================calculate fine and update to fines table===================================
            if ($state == "NotRecieved") {
              if ($DueDate < $date) {
                $date1 = new DateTime($DueDate);
                $date2 = new DateTime($date);
                $diffr = $date1->diff($date2);

                $latedates = $diffr->format('%a'); //format get absolute number
                $fines = 30 * $latedates;

                $DueDate1 = new DateTime($DueDate);

                // Add one day
                $DueDate1->add(new DateInterval('P1D'));
                $fineCreated = $DueDate1->format('Y-m-d');
                //$fineCreatedDate = date($fineCreated);
                //echo $fineCreated;
                $qProducts = "SELECT Pro_ID FROM order_details WHERE Order_ID=$row2 ";
                $rProducts = $conn->query($qProducts);
                while ($rowpro = mysqli_fetch_assoc($rProducts)) {
                  $proid = $rowpro['Pro_ID'];
                  $qFines = "INSERT INTO fines VALUES ($row2,$row3,$proid,'$fineCreated',$fines,'NotRecieved')";
                  $conn->query($qFines);
                }
              } else {
                //echo "no";
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
            ?>
            <tr height="50px">
              <td>
                <?php
                echo $InvId; ?>
              </td>
              <td>
                <?php
                echo $row2; ?>
              </td>
              <td>
                <?php
                echo $row3; ?>
              </td>
              <td>
                <?php
                echo $row4; ?>
              </td>
              <td style="background-color: <?php echo $color; ?>;color:<?php echo $fcolor; ?>;">
                <?php
                echo $state; ?>
              </td>
              <td>
                <?php echo "<a href='Order_manage/man_order.php?oid=$row2&inv=$InvId&cusid=$row3&dt=$row4&st=$state' class='del_cat'>View & Edit</a>"; ?>
              </td>

            </tr>
            <?php
          }
        }
        if (isset($_GET['check'])) {
          $query = "SELECT * from order_tbl  order by Order_ID Desc";
          $result = $conn->query($query);
          $condition = "";
          $color = "";
          $fcolor = "";
          if (isset($_GET['order'])) {
            $condition = "Ordered";
            $color = "green";
            //echo "dds";
          }
          if (isset($_GET['todel'])) {
            $condition = "ToDeliver";
            $color = "yellow";
            $fcolor = "black";
          }
          if (isset($_GET['taken'])) {
            $condition = "TakenByUser";
            $color = "grey";
          }
          if (isset($_GET['notrec'])) {
            $condition = "NotRecieved";
            $color = "red";
          }
          if (isset($_GET['finished'])) {
            $condition = "Finished";
            $color = "white";
            $fcolor = "black";
          }
          while ($row1 = mysqli_fetch_assoc($result)) {
            $row2 = $row1['Order_ID'];
            $row3 = $row1['Cus_ID'];
            $row4 = $row1['Date_Created'];

            $qInv = "SELECT Inv_ID from invoice Where Order_ID='$row2';";
            $rInv = $conn->query($qInv);
            $rowInv = mysqli_fetch_assoc($rInv);
            $InvId = $rowInv['Inv_ID'];

            $query1 = "SELECT * from order_details  WHERE Order_ID='$row2' AND Status='$condition' LIMIT 1";
            $result1 = $conn->query($query1);
            while ($rows = mysqli_fetch_assoc($result1)) {
              $state = $rows['Status'];
              $DueDate = $rows['Due_Date'];
              //=========================calculate fine and update to fines table===================================
              if ($condition == "NotRecieved") {
                if ($DueDate < $date) {
                  $date1 = new DateTime($DueDate);
                  $date2 = new DateTime($date);
                  $diffr = $date1->diff($date2);

                  $latedates = $diffr->format('%a'); //format get absolute number
                  $fines = 30 * $latedates;

                  $DueDate1 = new DateTime($DueDate);

                  // Add one day
                  $DueDate1->add(new DateInterval('P1D'));
                  $fineCreated = $DueDate1->format('Y-m-d');
                  //$fineCreatedDate = date($fineCreated);
                  //echo $fineCreated;
                  $qProducts = "SELECT Pro_ID FROM order_details WHERE Order_ID=$row2 ";
                  $rProducts = $conn->query($qProducts);
                  while ($rowpro = mysqli_fetch_assoc($rProducts)) {
                    $proid = $rowpro['Pro_ID'];
                    $qFines = "INSERT INTO fines VALUES ($row2,$row3,$proid,'$fineCreated',$fines,'NotRecieved')";
                    $conn->query($qFines);
                  }
                } else {
                  //echo "no";
                }
              }
              ?>
              <tr height="50px">
                <td>
                  <?php
                  echo $InvId; ?>
                </td>
                <td>
                  <?php
                  echo $row2; ?>
                </td>
                <td>
                  <?php
                  echo $row3; ?>
                </td>
                <td>
                  <?php
                  echo $row4; ?>
                </td>
                <td style="background-color:<?php echo $color; ?>;color:<?php echo $fcolor; ?>">
                  <?php
                  echo $state; ?>
                </td>
                <td>
                  <?php echo "<a href='Order_manage/man_order.php?oid=$row2&inv=$InvId&cusid=$row3&dt=$row4&st=$state' class='del_cat'>View & Edit</a>"; ?>
                </td>

              </tr>
              <?php
            }
          }
        }

        ?>
      </tbody>
    </table>
  </div>

</div>