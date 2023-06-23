<?php

//$id = $_POST['Cus_ID'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$address = $_POST['address'];
$pn = $_POST['pn'];
$pswd1 = $_POST['pswd1'];
//$pass_hash = password_hash($pswd1,PASSWORD_BCRYPT);
$pswd2 = $_POST['pswd2'];
$position = $_POST['position'];
//$pic = $_POST['pic'];
$encrpt1 = md5($pswd1);
$encrpt2 = md5($pswd2);



if (!empty($uname) || !empty($email) || !empty($pswd1) || !empty($pswd2) || !empty($address)) {

  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "smart_anony";



  // Create connection
  $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

  if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
      . mysqli_connect_error());
  } else {
    $SELECT = "SELECT Email From customer Where Email = ? Limit 1";
    $INSERT = "INSERT Into customer values('','$uname','$email','$pn','$address','$encrpt1','$position')";
  
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
  
    if ($rnum == 0) {
     
      if ($pswd1 == $pswd2) {
    
        $conn->query($INSERT);
        require("Index.html")
   
      ?>
      <script>alert("You are registered Succesfully")</script>
      <?php
      } 
      else {
        require("register_user.php");
        ?>
        <script>alert("Your password is does not match")</script>
        <?php
      }
    }
    else{
      require("register_user.php");
      ?>
      <script>alert("Someone already register using this email")</script>
      <?php
    }
  }
}
?>