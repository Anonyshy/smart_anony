<?php
include_once("../../pages/connection.php");
//include_once("table.php");
if (isset($_GET['name'])) {
  $id2 = $_GET['name'];
}
if (isset($_POST['edited'])) {
  $editedname = $_POST['edited'];
  $query4 = "UPDATE category SET Cat_Name='$editedname' WHERE Cat_Name='$id2' ";
  $conn->query($query4);
  //header("location:category.php");
  //include("category.php");
  echo '<script>alert("Edit Succesfully..!");window.location.href = "../category.php";</script>';
  //include_once("man_cat.php");
}


?>
<link href="../../css/style.css" rel="stylesheet">
<link href="../../css/home.css" rel="stylesheet">
<!-- edit catogory popup------------------------------------------------------------>
<div class="add-cat" Id="add-cat">
  <div class="manage-cat1" id="manage-cat1">
    <div id="popup1" class="popup1">
      <div class="add-cat2">
        <form id="category_form" action="#" method="post">
          <div class="form-group">
            <label style="color: aliceblue;">Category Name</label>
            <input type="text" class="form-control" id="form-control" value="<?php echo $id2;?>" name="edited" id="category_name"
              placeholder="Enter new name" autofocus>

          </div>
          <button type="submit" class="btn btn-primary">Edit & Save</button>
        </form>
      </div>
    </div>
  </div>
</div>