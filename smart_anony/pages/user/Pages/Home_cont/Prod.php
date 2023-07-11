<?php
include_once("../../../connection.php");

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
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible " content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/External.css">

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

<body background="../../Images/bg_prod.jpg">

    <div class="container mt-5">
        <div class="row">
            <div class="row">
                <form id="frmSrch">
                    <input type="text" id="srch" name="srch" placeholder="type to search"
                        onkeyup="search()"><button>Search</button>
                </form>
            </div><br><br>
        </div>
        <div class="row">
            <?php
            $query = "SELECT * FROM product";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($rows = $result->fetch_assoc()) {
                    $proid = $rows['Pro_ID'];
                    $name = $rows['Pro_name'];
                    $qty = $rows['Qty_available'];
                    $price = $rows['Cost'];
                    $image = $rows['file_name'];
                    $des = $rows['Description'];
                    $cat = $rows['Cat_ID'];

                    ?>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="card border-0" style="background-color:#000000;height:480px;">


                            <!-- //class="card-img"
    //echo '<img src="data:image;base64,'.base64_encode($image).'" style=""height:100px">';
-->
                            <center><a href="view.php?name=<?php echo $name ?>&id=<?php echo $proid ?>&cat=<?php echo $cat ?>"
                                    target="_blank"><img src="../../../../templates/uploads/<?php echo $rows['file_name']; ?>"
                                        height="200" style="margin-top:20px;"></a></center>
                            <br>
                            <div class="card-body">
                                <h5 class="card-title text-secondary">
                                    <?php echo $name; ?>
                                </h5>
                                <h6 class="card-title"><b>Available</b> :
                                    <?php if ($qty > 0) {
                                        echo "<font color='red'>$qty</font>";
                                    } else
                                        echo "<font color='red'> Out of Stoke</font>"; ?>
                                </h6>
                                <h4 class="card-title text-success"> Rs.
                                    <?php echo $price; ?>
                                </h4>
                                <h6 class="card-title"><b>Description</b> :
                                    <a href="view.php?name=<?php echo $name ?>&id=<?php echo $proid ?>&cat=<?php echo $cat ?>"
                                        target="_blank">Click here...</a>
                                </h6>
                                <form method="POST" action="#">
                                    <div style="margin-left:30%;">
                                        <?php if ($qty > 0) { ?>
                                            <?php echo "<button type='submit' style='background-color:Red;border-radius:8px;color:white;border: 2px solid white;cursor: pointer;' formaction='Prod.php?id=$proid&qty=$qty'>Add to cart</button>"; ?>
                                            <?php
                                        } else { ?>
                                            <?php echo "<button type='submit' style='background-color:yellow;border-radius:8px;color:black;border: 2px solid white;cursor: pointer;' formaction='Prod.php?moveid=$proid'>Add to wishlist</button>"; ?>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div><br><br>
                    </div>

                <?php }
            } ?>
        </div>

    </div>
    <script>
        function search() {
            const searchbox = document.getElementById("srch").value.toUpperCase();
            console.log(searchbox);
            const vname = document.getElementsByTagName("h5");


            for (let i = 0; i < vname.length; i++) {
                let match = vname[i];
                if (match) {
                    let textvalue = match.textContent || match.innerHTML;
                    let textvalue: String
                    if (textvalue.toUpperCase().indexOf("searchbox") > -1) {
                        console.log(vname[i]);
                    }
                    else {
                        console.log("no");
                    }
                }
            }
        }
    </script>
</body>

</html>