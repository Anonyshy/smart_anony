<?php
include_once("../../../connection.php");

//echo $loginame;

$id = $_GET['id'];
$total = $_GET['total'];
$name = $_GET['name'];
$address = $_GET['address'];
$email = $_GET['email'];
$pn = $_GET['pn'];
$date = date('Y-m-d');
$oid = $_GET['oid'];
$DueDate = date('Y-m-d', strtotime($date . ' + 3 day'));
$status = "Ordered";
//echo $DueDate;

//............................Insert data to order table============================================
$query2 = "INSERT INTO order_tbl VALUES ('$oid','$id','$date')";
$conn->query($query2);

//echo $oid . "" . $id . "" . $date;


//=================================read product ids===============================================
$qids = "SELECT id FROM product_temp WHERE Username='$name'";
$rids = $conn->query($qids);
while ($row = $rids->fetch_assoc()) {
    $prodid = $row['id'];

    $qprice = "SELECT Cost FROM product WHERE Pro_ID='$prodid'";
    $rprice = $conn->query($qprice);
    while ($row1 = $rprice->fetch_assoc()) {
        $price = $row1['Cost'];
        //==============================insert data into order_details table==============================
        $qod = "INSERT INTO order_details VALUES ('$oid','$prodid','$price','$DueDate','$status')";
        $rod = $conn->query($qod);
    }
}

//............................Insert data to Invoice table============================================
//=================================find last Invoice id=========================================
$q = "SELECT Inv_ID FROM invoice ORDER BY Inv_ID DESC LIMIT 1";
$r = $conn->query($q);
if ($r->num_rows > 0) {
    $rw = $r->fetch_assoc();
    $inIdStr = $rw['Inv_ID'];
    $inId = intval($inIdStr) + 1;
    //echo $inId;

} else {
    $inId = 10000;
    // echo "1";
}

$qIn = "INSERT INTO invoice VALUES ('$inId','$oid','$date','$total')";
$conn->query($qIn);
//=============================================================================================================

?>

<link rel="stylesheet" type="text/css" href="../../../../CSS/invoice.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<button onclick="down();" class="btn btn-info" style="margin-left:45%;">Download Invoice</button>
<button onclick="window.location.reload(true)"><span class="glyphicon glyphicon-refresh"></span></button>
<div class="col-md-12">
    <div class="row" id="fullc">

        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3"
            id="TARGET">
            <div class="row">
                <div class="receipt-header">

                    <div class="col-xs-6 col-sm-6 col-md-6">

                        <div class="receipt-left">

                            <img class="img-responsive" src="../../Images/logo.png" style="width: 80px;">

                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <div class="receipt-right">
                            <h5>Smart Anony Video Rentout</h5>
                            <p>+94 71 92 42 999 </p>
                            <p>sav.rent@gmail.com </p>
                            <p>Tissamaharama</p>
                            <p>Sri Lanka</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="fullc">
                <div class="receipt-header receipt-header-mid">
                    <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                        <div class="receipt-left">
                            <h5><b>Mr./Mrs./Miss.</b>
                                <?php echo $name; ?>
                            </h5>
                            <p><b>Mobile :</b>
                                <?php echo $pn; ?>
                            </p>
                            <p><b>Email :</b>
                                <?php echo $email; ?>
                            </p>
                            <p><b>Address :</b>
                                <?php echo $address; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="receipt-left">
                            <h3>INVOICE #
                                <?php echo $inId; ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Unit Price</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queryIn = "SELECT * FROM order_details Where Order_ID='$oid';";
                        $resultIn = $conn->query($queryIn);

                        while ($rowIn = $resultIn->fetch_assoc()) {
                            $prodid = $rowIn['Pro_ID'];
                            $uniprice = $rowIn['Unit_price'];


                            $query1 = "SELECT * FROM product Where Pro_ID='$prodid';";
                            $result1 = $conn->query($query1);
                            $row1 = $result1->fetch_assoc();
                            $prodname = $row1['Pro_name'];
                            $qty = $row1['Qty_available'];
                            $newQty = intval($qty) - 1;

                            //===================update product details=====================================
                            $queryUp = "UPDATE product SET Qty_available='$newQty' WHERE Pro_ID='$prodid';";
                            $conn->query($queryUp);



                            ?>
                            <tr>
                                <td class="col-md-9">
                                    <?php echo $prodname; ?>
                                </td>
                                <td class="col-md-3">
                                    <?php echo $uniprice; ?>
                                </td>

                            </tr>
                            <?php

                        } ?>
                        <tr>

                            <td class="text-right">
                                <h2><strong>Total: </strong></h2>
                            </td>
                            <td class="text-left text-danger">
                                <h2><strong>
                                        <?php echo $total; ?>
                                    </strong></h2>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="receipt-header receipt-header-mid receipt-footer">
                    <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                        <div class="receipt-right">
                            <p><b>Date :</b> </p>
                            <p id="frmDate"></p>
                            <br><br>
                            <h5 style="color: rgb(140, 140, 140);">Thanks you... </h5>
                            <h5 style="color: rgb(255, 0, 0);">Please present this softcopy of invoice for get your
                                order quickly</h5>
                            <h5>If you want get your order to doorstep please contact us...</h5>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="receipt-left">
                            <img class="img-responsive" src="../../../../Image/A2Z.png"
                                style="width: 100px;margin-left:80px;">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
//================delete temp table product=======================================
$queryDel = "DELETE FROM product_temp WHERE Username='$name';";
$conn->query($queryDel);


?>


<script>
    function down() {

        //var divtag = window.getElementById("fullc");
        window.print();
        window.location.href = "../Home.php";

    }
    function getDate() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        var datestring = yyyy + "/" + mm + "/" + dd;
        document.getElementById("frmDate").innerHTML = datestring;
        // alert("You orderd successfully...")
    }
    getDate();

</script>