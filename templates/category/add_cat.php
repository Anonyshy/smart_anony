<?php
 session_start();
//$catID = $_POST['catid'];
$catname = $_POST['category_name'];
//$displays = function echo {"<script>document.getElementById('success').style.display = 'inline';</script>"};

include_once("../../pages/connection.php");

if (!empty($catname)) {

  if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
      . mysqli_connect_error());
  } else {
    $INSERT = "INSERT Into category values('','$catname')";

    $conn->query($INSERT);

   
    $_SESSION['success'] = "ok";
    header('location:../category.php');
    ?>
    
    <?php
    
  }
} else {
  echo "<script>alert('Name cannot be empty...')</script>";
  die();
}
?>