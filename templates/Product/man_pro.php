<table class="table_prod" id="table" width="800px" border="1px" style="color:white;">
  <thead>
    <tr height="50px" style="background-color:black;color:white;">
      <th>Product</th>
      <th>Product Category</th>
      <th>Cost</th>
      <th>Qty</th>
      <th>Discription</th>
      <!--<th>Status</th>-->
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="get_category" align="center">
    <?php
    if (isset($_GET['id'])) {
      $id = "product.php?idd=" . $_GET['id'];
      //echo "<script> confirm('$id');</script>";
      echo "<script>let res = confirm('Are you sure you want delete this product?');if(res){window.location.href = '$id';console.log('ok');}else{window.location.href = 'product.php';console.log('no');}</script>";
    }
    if (isset($_GET['idd'])) {
      $idd = $_GET['idd'];
      $query3 = "DELETE FROM product where Pro_name='$idd';";
      $conn->query($query3);
    }

    $query2 = "SELECT * from product order by Pro_name asc";
    $result2 = $conn->query($query2);

    while ($row1 = mysqli_fetch_assoc($result2)) {
      $row2 = $row1['Pro_name'];
      $row3 = $row1['Cat_ID'];
      $row4 = $row1['Cost'];
      //$row5 = $row1['Status'];
      $row6 = $row1['Qty_available'];
      $row7 = $row1['Description'];
      $querycat = "SELECT Cat_Name from category Where Cat_ID='$row3';";
      $resultcat = $conn->query($querycat);
      $row8 = mysqli_fetch_assoc($resultcat);
      $row9 = $row8['Cat_Name'];
      ?>
      <tr height="50px">
        <td>
          <?php
          echo $row2; ?>
        </td>
        <td>
          <?php
          echo $row9; ?>
        </td>
        <td>
          <?php
          echo $row4; ?>
        </td>
        <td>
          <?php
          echo $row6; ?>
        </td>
        <td>
          <?php
          echo $row7; ?>
        </td>
       <!-- <td>
          <?php
          //echo $row5; ?>
        </td>
      -->
        <td>
          <?php echo "
            <a href='product.php?id=$row2'  class='del_cat'>Delete</a> 
            <a href='Product/edit_prod.php?name=$row2&cat=$row9&cost=$row4&qty=$row6&description=$row7' class='edit_cat' >Edit</a>";
          ?>
        </td>
      </tr>
      <?php
    } ?>
  </tbody>
</table>