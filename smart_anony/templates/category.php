<?php
session_start();
include_once("../pages/connection.php");

//$query = "SELECT * from category order by Cat_Name asc limit 1";
//$result = mysqli_query($conn, $query);
//$row = mysqli_fetch_array($result);
//$lastid = $row['Cat_ID'];


//session_destroy();
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
<div class="add-cat" Id="add-cat">
  <div id="success" class="success">
    <h3>Category Added Successfully..!</h3>
  </div>
  <div id="successa" class="successa">
    <h3>Edited Successfully..!</h3>
  </div>
  <form id="category_form" action="./category/add_cat.php" method="POST" style="display: none;">
    <div class="form-group">
      <label>Category Name</label>
      <input type="text" class="form-control" name="category_name" id="category_name" aria-describedby="emailHelp"
        placeholder="Enter Category Name">

      <!--<input type="hidden" name="catid" value="//echo $cus;">-->
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
  </form>

  <div class="manage-cat" id="manage-cat" style="display: none;">

    <?php include('./category/man_cat.php'); ?>

  </div>
</div>
<?php
if (isset($_SESSION['success'])) {
  ?>
  <script>document.getElementById("success").style.display = "inline";</script>
  <?php
  session_destroy();
}
?>

<script>
  function showAdd() {
    document.getElementById('category_form').style.display = "inline";
    document.getElementById('manage-cat').style.display = "none";
    document.getElementById('success').style.display = "none";
  };
  function showMan() {
    document.getElementById('category_form').style.display = "none";
    document.getElementById('success').style.display = "none";
    document.getElementById('manage-cat').style.display = "inline";
  };

</script>