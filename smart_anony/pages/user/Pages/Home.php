<?php
include_once("../../connection.php");
session_start();
$loginame = $_SESSION['Username'];
//======================Add to cart=======================
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $quty = $_GET['qty'];

  $query = "INSERT INTO product_temp values ('$id','$loginame');";

  if ($quty > 0) {
    $conn->query($query);
    echo "<script>alert('Added Successfully!')</script>";
  } else {
    echo "<script>alert('out of Stock');</script>";
  }
}

//=======================Add to wishlist=============
if (isset($_GET['moveid'])) {
  $id = $_GET['moveid'];

  $wishquery = "INSERT INTO wishlist values ('$id','$loginame');";
  $conn->query($wishquery);
  echo "<script>alert('Added Successfully!')</script>";
}
?>
<html>

<head>


  <link rel="stylesheet" type="text/css" href="../CSS/External.css">
  <style>
    a,
    h1,
    p.con,
    pre {
      color: white;
      font-family: Arial;
      text-decoration: none;
    }
  </style>

</head>

<body background="../Images/bg_prod.jpg">
  <!--<iframe width="853" height="480" src="https://www.youtube.com/embed/jHYhTERQ97s" title="Free Horror Trailer Intro 30 second No Copyright For Video Cinematic Teaser." frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
  <!--Main Image------------------------------------------------------------------------------------------------>
  <?php
  $linkyt = "https://www.youtube.com/embed/jHYhTERQ97s";
  ?>

  <iframe width="100%" height="100%"
    src="<?php echo $linkyt . '?autoplay=1&mute=1&showinfo=0&controls=0&rel=0&modestbranding=1&iv_load_policy=3&loop=1&playlist=jHYhTERQ97s'; ?>"
    frameborder="0"></iframe>

  <a href="#partsbg"><button id="btnscrl">Click to scroll down</button></a>
  <br><br><br><br><br><br>



  <div class="wel">
    <p class="con" align="center">
      <font size="7" face="Arial Black">Smart Anony Video Rentout</font>
    </p>
    <p class="con" align="center"><b>
        <font size="3" face="verdana"> Make changes with Technology </font>
      </b></p>
  </div>
  <br><br><br><br><br>
  <div class="partsbg" id="partsbg">

    <div class="leftpart">
      <font color="White" face="Arial">Category</font>
      <br><br><br>


      <table class="table_cat" id="table" width="100%" border="1px" cellspacing="0">
        <tbody id="get_category" align="center">


          <?php


          $query2 = "SELECT Cat_Name from category order by Cat_Name asc";
          $result2 = $conn->query($query2);

          while ($row1 = mysqli_fetch_assoc($result2)) {
            $row2 = $row1['Cat_Name'];

            ?>

            <tr height="50px">

              <td style="color:white;font-family:verdana;"><b>
                  <?php
                  echo $row2; ?>
                </b>
              </td>


            </tr>

            <?php


          } ?>
        </tbody>
      </table>
    </div>
    <div class="rightpart">
      <h2>Latest</h2>
      <hr>

      <div class="flexlts">
        <div class="flex" style="display:flex;max-width:100%;margin-left:40px;">
          <?php
          $qlts = "SELECT * from product order by Pro_ID Desc LIMIT 6;";
          $rlts = $conn->query($qlts);

          while ($fetchlts = mysqli_fetch_assoc($rlts)) {
            $ltsname = $fetchlts['Pro_name'];
            $proid = $fetchlts['Pro_ID'];
            $qty = $fetchlts['Qty_available'];
            $price = $fetchlts['Cost'];
            $image = $fetchlts['file_name'];
            $des = $fetchlts['Description'];
            //$cat = $fetchlts['Cat_ID'];
          



            ?>


            <div class="card-body" style="border: 0.2px solid white;margin-left:5px;padding:5px;">
              <img src="../../../templates/uploads/<?php echo $image; ?>" height="200px" style="margin-top:20px;">

              <br>

              <h5 class="card-title text-secondary">
                <?php echo $ltsname; ?>
              </h5>
              <p class="card-title" style="font-size:10px;"><b>Available </b> :
                <?php if ($qty > 0) {
                  echo "$qty";
                } else
                  echo "<font color='red'> Out of Stoke</font>"; ?> | Rs.
                <?php echo $price; ?>
              </p>

              <p class="card-title" style="font-size:10px;"><b>Description</b> :
                Click here...
              </p>
              <form method="POST" action="#">
                <div style="margin-left:30%;">
                  <?php if ($qty > 0) { ?>
                    <?php echo "<button type='submit' style='background-color:Red;border-radius:8px;color:white;border: 2px solid white;cursor: pointer;' formaction='Home.php?id=$proid&qty=$qty'>Add to cart</button>"; ?>
                    <?php
                  } else { ?>
                    <?php echo "<button type='submit' style='background-color:yellow;border-radius:8px;color:black;border: 2px solid white;cursor: pointer;' formaction='Home.php?moveid=$proid'>Add to wishlist</button>"; ?>
                    <?php
                  }
                  ?>
                </div>
              </form>
            </div>
          <?php } ?>

        </div>


      </div>
      <br><br>





      <br><br>
      <h2>Suggest for you</h2>
      <hr>
      <br>


      <br><br>
      <h2>Most Popular</h2>
      <hr>
      <br>


      <br>
    </div>
  </div>
</body>

</html>