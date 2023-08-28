<!DOCTYPE html>

<head>
  <title>User Registration</title>
  <link rel="stylesheet" type="text/css" href="../css/style_reg.css">


<body>

  <div class="box">
    <img src="../Image/m.png" class="user">

    <h1 style="color:white;">&nbsp;&nbsp; User Registration</h1>

    <form name="myform2" action="register_user_php.php" method="POST" >
      
    <p >Username <div id="error" style="color:red;"> </div></p>
      <input type="text" onkeyup="checkUsername()" id="username" name="uname" placeholder="Enter Username" required="">
      
      <p>Email</p>
      <input type="Email" name="email" placeholder="Enter email id" required="">

      <p>Phone Number</p>
      <input type="text" name="pn" placeholder="Optional" id="pn" >

      <p>Address</p>
      <input type="text" name="address" placeholder="Enter shiping address" required="">

      <p>Password</p>
      <input type="password" name="pswd1" placeholder="Enter Password" required="">

      <p>Retype Password</p>
      <input type="password" name="pswd2" placeholder="Re-Enter Password" required="">
      <p><input type="hidden" name="position" value="User"></p>
      <!--<p><input type="hidden" name="pic" value="../Image/m.png"></p>-->

      <input type="submit" name="" id="submit" value="Register" >

      <br><br>
      <a href="index.html">Login</a>


    </form>

    <h4 id="inpswd" class="inpswd">Password does not match </h4>
    <h6 id="regerror" class="regerror">Someone already registered with this email !</h6>

  </div>
  <?php
  include_once("connection.php");
    $q1 = "SELECT Username FROM customer;";
    $r1 = $conn->query($q1);
    
    if(mysqli_num_rows($r1) > 0)
    {
      
      while ($row1 = mysqli_fetch_assoc($r1)) {
        $row2 = $row1['Username'];
        echo $row2;
      }
      }
      
    
  ?>
  <script>
    function checkUsername() {
      
      var username = document.getElementById("username").value;
      if (username == "admin") 
  
  {
        document.getElementById("error").innerHTML = "Username already taken!";
        document.getElementById("submit").disabled = true;
      } 
      else{
        document.getElementById("error").innerHTML = "";
        document.getElementById("submit").disabled = false;
      }
    };
    function checkPn(){
      
    }
  </script>
</body>


</html>