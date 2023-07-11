<?php
include_once("../pages/connection.php");
$query = "SELECT * from category order by Cat_Name asc";
$result = $conn->query($query);
/*
$query_1 = "SELECT * from product order by Pro_name asc";
$result_1 = mysqli_query($conn, $query_1);
$row_2 = mysqli_fetch_array($result_1);
*/
?>

<link href="../css/style.css" rel="stylesheet">
<link href="../css/home.css" rel="stylesheet">

<div class="add-manage">
  <ul style=" display: flex;">
    <a href="#" onclick="showAdd()">
      <li>Add</li>
    </a>
    <a href="#" onclick="showMan()">
      <li>Manage</li>
    </a>
  </ul>
</div>
<div class="add-cat">
  <form id="category_form" method="post" action="Product/add_prod.php" style="display: none;"
    enctype="multipart/form-data">
    <div class="form-group" style="margin-top:-8%;">
     
          <label>Product Name</label>
          <input type="text" class="form-control" name="prod_name" id="category_name"
              placeholder="Enter Product Name" required><br>
        
        <label>Select Product Category</label>

        <select name="cat" id="cat" class="form-control" required>

          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['Cat_ID']; ?>">
              <?php echo $row['Cat_Name']; ?>
            </option>
            <?php

          }
          ?>

        </select><br>

        <label>Cost (Rs)</label>
        <input type="text" class="form-control" name="std_cost" id="category_name" placeholder="Enter cost"
          style="margin-left:16%;" required><br>

        <label>Quantity</label>
        <input type="text" class="form-control" name="qty" id="category_name" style="margin-left:17.2%;"><br>

        <label>Description</label>
        <textarea cols="2" rows="2" class="form-control" wrap="soft" name="discription" id="category_name"
          placeholder="Product Details" style="height:20%;margin-left:14.5%;"></textarea><br>

        <label>URL</label>
        <input type="text" class="form-control" name="url" id="category_name" placeholder="Video URL"
          style="margin-left:22%;"><br><br>

        <label>Image</label>
        <input type="file" name="imgs" value="">
        <br><br>


        <button type="submit" name="submit" class="btnsave">Save</button>
    </div>
  </form>

  <div class="manage-cat" id="manage-cat" style="display: none;">
    <?php require('Product/man_pro.php'); ?>
  </div>
</div>

<script>
  function showAdd() {
    document.getElementById('category_form').style.display = "inline";
    document.getElementById('manage-cat').style.display = "none";
  };
  function showMan() {
    document.getElementById('category_form').style.display = "none";
    document.getElementById('manage-cat').style.display = "inline";
  };
</script>