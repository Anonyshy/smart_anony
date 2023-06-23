<?php
include_once("../../pages/connection.php");
$catID = $_POST['cat'];
//$prodid = $_POST['Prod_ID'];
$prodname = $_POST['prod_name'];
$dcr = $_POST['discription'];
$cost = $_POST['std_cost'];
//$status = $_POST['status'];
$qty = $_POST['qty'];
//$image = $_POST["imgs"];




if (isset($_POST['submit']) && isset($_FILES['imgs'])) {

    $img_name = $_FILES['imgs']['name'];
    //$img_size = $_FILES['img']['size'];
    $tmp_name = $_FILES['imgs']['tmp_name'];
    //$error = $_FILES['img']['error'];


    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $new_name = uniqid("img_", True) . '.' . $img_ex_lc;
    $uppath = '../uploads/' . $new_name;
    move_uploaded_file($tmp_name, $uppath);

    $INSERT = "INSERT Into product values('','$prodname','$qty','$catID','$cost','$dcr','$new_name')";
    $conn->query($INSERT);

    header("Location: ../product.php");
    echo '<script>alert("Product Added Succesfully")</script>';
    
    
} else {
    echo 'Fail';
}

?>