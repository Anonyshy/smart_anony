<?php
include_once("../pages/connection.php");
$q = "SELECT * FROM customer where Position='Admin' LIMIT 1;";
$r = $conn->query($q);
$r1 = mysqli_fetch_assoc($r);
$row1 = $r1['Username'];

session_start();
if (isset($_GET['check'])) {
    unset($_SESSION['Username']);
    session_destroy();
    //header("Location: index.php");
}
//unset($_SESSION['Username']);
if (isset($_SESSION['Username'])) {
    if ($_SESSION['Username'] == $row1) {
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Smart Anony Video Rentout</title>

            <link rel="icon" href="user/Images/logo.png" type="image/x-icon">
            <link href="../css/style.css" rel="stylesheet">
            <link href="../css/home.css" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
                integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css"
                href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


        </head>

        <body class="hold-transition sidebar-mini  pace-done">

            <div class="pace  pace-inactive">


                <div class="pace-progress" data-progress-text="100%" data-progress="99"
                    style="transform: translate3d(100%, 0px, 0px);">
                    <div class="pace-progress-inner"></div>
                </div>
                <div class="pace-activity"></div>
            </div>

            <div class="wrapper">

                <header class="main-header">

                    <a href="home.php" class="logo">
                        <span class="logo-lg">
                            <img src="../Image/A2Z.png" alt="logo">
                        </span>
                    </a>



                    </nav>
                </header>


                <aside class="main-sidebar">
                    <!-- sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar user panel -->
                        <div class="user-panel text-center">
                            <div class="image">
                                <img src="../Image/admin.jpg" class="img-circle" alt="User Image">
                            </div>
                            <div class="info">

                                <p class="user">
                                    <?php echo $_SESSION['Username'];
                                    ?>
                                </p>
                                <?php
                                ?><img src="../Image/icons/status.png" height="10px">
                                <p class="status"> </p><br>
                                <span style="color: #f22;"></span>
                            </div>
                        </div>

                        <!-- sidebar menu -->
                        <ul class="sidebar-menu">
                            <a href="home.php">
                                <li class="treeview active">
                                    <i class="fa fa-home"></i> <span>Dashboard</span>
                                </li>
                            </a>

                            <a href="#" onclick="catpage();">
                                <li class="treeview ">

                                    <i class="fa fa-list"></i> <span>Catogory</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>



                                </li>
                            </a>

                            <a href="#" onclick="purchasepage();">
                                <li class="treeview ">

                                    <i class="fa fa-user"></i> <span>xxxx</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>

                                </li>
                            </a>



                            <a href="#" onclick="productpage();">
                                <li class="treeview ">

                                    <i class="fa fa-braille"></i> <span>Product</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </li>
                            </a>

                            <a href="#" onclick="Supplierpage()">
                                <li class="treeview ">

                                    <i class="fa fa-handshake-o"></i> <span>xxxx</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>

                                </li>
                            </a>


                            <a href="#" onclick="regpage();">
                                <li class="treeview ">

                                    <i class="fa fa-user"></i><span>xxxx</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>


                                </li>
                            </a>

                            <a href="#" onclick="report();">
                                <li class="treeview ">

                                    <i class="fa fa-braille"></i> <span>Report</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </li>
                            </a>
                    </div> <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header  -->
                    <section class="content-header">

                        <div class="header-icon"><img class="header-home" src="../Image/icons/home1.png" height="50px"></div>
                        <div class="header-title">
                            <h1>Home</h1>

                        </div>
                        <!-- Header Navbar -->

                        <div class="navbar-custom-menu" style="margin-left:910px;margin-top:10px;font-size:18px;">
                            <ul class="top">
                                <!-- settings -->
                                <li class="pro1" ><a href="#" onclick="editProf()"><i class="fa fa-cog"></i> Setting</a></li>
                                <li class="pro2"style="margin-left:30px;"><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>


                            </ul>
                        </div>
                    </section>


                    <!-- Main content -->
                    <div class="content" id="window">
                        <!-- load messages -->
                        <div class="first">

                            <h4>&nbsp;&nbsp;Smart Anony Video Rentout</h4>
                        </div>

                        <br /><br /><br /><br />
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card mx-auto">
                                        <center><img class="card-img-top mx-auto" style="width:60%;border-radius:100px;"
                                                src="../Image/admin.jpg" alt="login Image">
                                            <div class="card-body">
                                                <h4 class="card-title">Profile Info</h4>
                                                <p class="card-text"><i class="fa fa-user">&nbsp;</i>
                                                    <?php echo $_SESSION['Username'];
                                                    ?>
                                                </p>

                                                <a href="#" class=" " onclick="editProf()"><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="jumbotron" style="width:100%;height:100%;">
                                        <center>
                                            <h1>Welcome
                                                <?php echo $_SESSION['Username'];
                                                ?>
                                            </h1>
                                        </center>
                                        <div class="row">
                                            <div class="col-sm-6d-6">
                                                <iframe
                                                    src="http://free.timeanddate.com/clock/i616j2aa/n1993/szw160/szh160/cf100/hnce1ead6"
                                                    id="clock" frameborder="0" width="160" height="160"></iframe>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">xxxxxx</h4>
                                                        <p class="card-text">xx x xx x x x xxx xxx xxx x xx xxxx xxxx x
                                                        </p>
                                                        <a href="#" onclick="orderpage()">xxxxx</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>



        </body>

        <script>

            function catpage() { document.getElementById('window').innerHTML = '<object type="text/html" data="../templates/category.php" ></object>'; }
            function editProf(){document.getElementById('window').innerHTML = '<object type="text/html" data="../templates/editProf.php" ></object>';}
                                /*    function regpage() { document.getElementById('window').innerHTML = '<object type="text/html" data="register_form.php" ></object>'; }
                                    function purchasepage() { document.getElementById('window').innerHTML = '<object type="text/html" data="index.html" ></object>'; }
                                   */ function productpage() { document.getElementById('window').innerHTML = '<object type="text/html" data="../templates/product.php" ></object>'; }
                                   /* function Supplierpage() { document.getElementById('window').innerHTML = '<object type="text/html" data="register_supplier.php" ></object>'; }
        function orderpage() { document.getElementById('window').innerHTML = '<object type="text/html" data="order.php" ></object>'; }
        function report() { document.getElementById('window').innerHTML = '<object type="text/html" data="../templates/report.php" ></object>'; }
        */</script>

        </html>
        <?php
    } else {
        header("location:Index.html");
    }
} else {
    session_destroy();
    unset($_SESSION['Username']);
    header("location:Index.html");
}
?>