<?php
include_once("../../../connection.php");

session_start();
$loginame = $_SESSION['UserName'];
//echo $loginame;

//delete temp table product
$queryDel = "DELETE FROM product_temp_online WHERE Cus_Name='$loginame';";
$conn->query($queryDel);
//............................

$order_id = $_GET['order'];

$query2 = "SELECT * FROM invoice Where Order_ID='$order_id';";
$result2 = $conn->query($query2);
$row2 = $result2->fetch_assoc();
$inv = $row2['Inv_ID'];

$query3 = "SELECT * FROM orders Where Order_ID='$order_id';";
$result3 = $conn->query($query3);
$row3 = $result3->fetch_assoc();
$name = $row3['Reciever'];
$pn = $row3['Phone_No'];
$email = $row3['Email'];
$address = $row3['address'];


?>

<link rel="stylesheet" type="text/css" href="../../../../CSS/invoice.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<button onclick="down();" style="margin-left:45%;">Download Invoice</button>
<div class="col-md-12">
    <div class="row">

        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" id="TARGET">
            <div class="row">
                <div class="receipt-header">

                    <div class="col-xs-6 col-sm-6 col-md-6">

                        <div class="receipt-left">

                            <img class="img-responsive" src="../../Images/logo.png" style="width: 80px;">

                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <div class="receipt-right">
                            <h5>A2Z Computer Services</h5>
                            <p>+94 71 92 42 999 </p>
                            <p>a2zcom@gmail.com </p>
                            <p>Tangalle</p>
                            <p>Sri Lanka</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
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
                                <?php echo $inv; ?>
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
                            <th>Qty.</th>
                            <th>Amount(Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM order_details Where Order_ID='$order_id';";
                        $result = $conn->query($query);
                        $Total = 0;
                        while ($row = $result->fetch_assoc()) {
                            $prodid = $row['Product_ID'];
                            $uniprice = $row['Unit_Price'];
                            $quantity = $row['Quentity'];

                            $query1 = "SELECT * FROM product Where Prod_ID='$prodid';";
                            $result1 = $conn->query($query1);
                            $row1 = $result1->fetch_assoc();
                            $prodname = $row1['Prod_Name'];
                            $amount = $quantity * $uniprice;
                            ?>
                            <tr>
                                <td class="col-md-9">
                                    <?php echo $prodname; ?>
                                </td>
                                <td class="col-md-3">
                                    <?php echo $uniprice; ?>
                                </td>
                                <td class="col-md-9">
                                    <?php echo $quantity; ?>
                                </td>
                                <td class="col-md-3">
                                    <?php echo $amount; ?>
                                </td>
                            </tr>
                            <?php
                            $Total = $Total + $amount;
                        } ?>
                        <tr>

                            <td class="text-right" colspan="3">
                                <h2><strong>Total: </strong></h2>
                            </td>
                            <td class="text-left text-danger">
                                <h2><strong>
                                        <?php echo $Total; ?>
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
                            <h5 style="color: rgb(140, 140, 140);">Thanks for shopping.! </h5>
                            <h5 style="color: rgb(255, 0, 0);">Please remember your Invoice
                                number for futher details..</h5>
                            <h5>Your Order Delivery within 7 Days..</h5>
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
<script>
    function down() {
        
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
    }
    getDate();

</script>