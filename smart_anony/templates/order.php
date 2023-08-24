<?php
include_once("../pages/connection.php");

?>

<link href="../css/style.css" rel="stylesheet">
<link href="../css/home.css" rel="stylesheet">

<div class="add-manage">
  <ul style=" display: flex;">
    <a href="order.php?all=ok&check=1">
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


            $queryst = "SELECT * from order_details Where Order_ID='$row2';";
            $resultst = $conn->query($queryst);
            $row8 = mysqli_fetch_assoc($resultst);
            $state = $row8['Status'];
            if ($state == "Ordered") {
              $color = "green";
            } elseif ($state == "ToDeliver") {
              $color = "yellow";
              $fcolor = "black";
            } elseif ($state == "TakenByCustomer") {
              $color = "grey";
            } else {
              $color = "red";
            }
            ?>
            <tr height="50px">
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
                <?php echo "<a href='#' >View & Edit</a>"; ?>
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
          while ($row1 = mysqli_fetch_assoc($result)) {
            $row2 = $row1['Order_ID'];
            $row3 = $row1['Cus_ID'];
            $row4 = $row1['Date_Created'];

            $query1 = "SELECT * from order_details  WHERE Order_ID='$row2' AND Status='$condition' LIMIT 1";
            $result1 = $conn->query($query1);
            while ($rows = mysqli_fetch_assoc($result1)) {
              $state = $rows['Status'];

              ?>
              <tr height="50px">
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
                  <?php echo "<a href='#' >View & Edit</a>"; ?>
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