<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <hr style="background-color:white;">

    <div class="flexlts" id="flexlts">
        <div class="row">
            <?php
            if (isset($_GET['catids'])) {
                //echo "bla blab l";
            }
            $qlts = "SELECT * from product  WHERE Cat_ID=$getcatid order by Pro_name asc;";
            $rlts = $conn->query($qlts);

            while ($fetchlts = mysqli_fetch_assoc($rlts)) {
                $ltsname = $fetchlts['Pro_name'];
                $proid = $fetchlts['Pro_ID'];
                $qty = $fetchlts['Qty_available'];
                $price = $fetchlts['Cost'];
                $image = $fetchlts['file_name'];
                $des = $fetchlts['Description'];
                $cat = $fetchlts['Cat_ID'];




                ?>

                <div class="col-lg-2" style="padding-bottom: 10px;">
                    <div class="card-body" style="border: 0.2px solid white;padding:8px;width:170px;height:410px;">
                        <center><a
                                href="Home_cont/view.php?name=<?php echo $ltsname ?>&id=<?php echo $proid ?>&cat=<?php echo $cat ?>"
                                target="_blank"><img src="../../../templates/uploads/<?php echo $image; ?>" height="170px"
                                    style="margin-top:20px;"></a></center>

                        <br>

                        <h5 class="card-title text-secondary">
                            <center>
                                <?php echo $ltsname; ?>
                            </center>
                        </h5>
                        <p class="card-title" style="font-size:10px;"><b>Available </b> :
                            <?php if ($qty > 0) {
                                echo "$qty";
                            } else
                                echo "<font color='red'> Out of Stoke</font>"; ?> | Rs.
                            <?php echo $price; ?>
                        </p>

                        <p class="card-title" style="font-size:10px;"><b>Description</b> :
                            <a href="Home_cont/view.php?name=<?php echo $ltsname ?>&id=<?php echo $proid ?>&cat=<?php echo $cat ?>"
                                target="_blank">Click here...</a>
                        </p>
                        <form method="POST" action="#">
                            <center>
                                <?php if ($qty > 0) { ?>
                                    <?php echo "<button type='submit' style='background-color:Red;border-radius:8px;color:white;font-size:14px;border: 2px solid white;cursor: pointer;' formaction='Home.php?id=$proid&qty=$qty'>Add to cart</button>"; ?>
                                    <?php
                                } else { ?>
                                    <?php echo "<button type='submit' style='background-color:yellow;border-radius:8px;color:black;font-size:14px;border: 2px solid white;cursor: pointer;' formaction='Home.php?moveid=$proid'>Add to wishlist</button>"; ?>
                                    <?php
                                }
                                ?>
                            </center>
                        </form>
                    </div>
                </div><br>
            <?php } ?>

        </div>


    </div>
</body>

</html>