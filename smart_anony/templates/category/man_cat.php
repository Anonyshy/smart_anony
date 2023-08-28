<table class="table_cat" id="table" width="800px" border="1px" style="color:white;">
  <thead>
    <tr height="50px" style="background-color:black;color:white;">
      <th>Category</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="get_category" align="center">
    <?php

    if (isset($_GET['id'])) {
      $id = "category.php?idd=" . $_GET['id'];
      //echo "<script> confirm('$id');</script>";
      echo "<script>let res = confirm('Are you sure you want delete this catogory?');if(res){window.location.href = '$id';console.log('ok');}else{window.location.href = 'category.php';console.log('no');}</script>";
    }
    if (isset($_GET['idd'])) {
      $idd = $_GET['idd'];
      $query3 = "DELETE FROM category where Cat_Name='$idd';";
      $conn->query($query3);
    }

    $query2 = "SELECT Cat_Name from category order by Cat_Name asc";
    $result2 = $conn->query($query2);

    while ($row1 = mysqli_fetch_assoc($result2)) {
      $row2 = $row1['Cat_Name'];


      ?>
      <tr height="50px">
        <td>
          <?php
          echo $row2; ?>
        </td>
        <td>
          <?php echo "
            <a  href='category.php?id=$row2'  class='del_cat'>Delete</a> 
            <a href='category/edit_cat.php?name=$row2' class='edit_cat' >Edit</a>";
          ?>
        </td>
      </tr>
      <?php
    } ?>
  </tbody>
</table>
