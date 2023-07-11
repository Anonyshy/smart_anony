<?php
include_once("../pages/connection.php");
$q = "SELECT * FROM customer where Position='Admin' LIMIT 1;";
$r = $conn->query($q);
$r1 = mysqli_fetch_assoc($r);
$row1 = $r1['Username'];

session_start();

        ?>
        <!DOCTYPE html>
        <html>

        <head>
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
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header  -->
                    <!-- Main content -->
                    <div class="content" id="window">
                        <!-- load messages -->
                        <div class="first" style="margin-top:30px;margin-left:-20px;width:50%;">

                            <h4 >Edit Profile</h4>
                        </div>

                        <br /><br /><br /><br />
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4" >
                                    <div class="card mx-auto" style="margin-top:-50px;">
                                        <center><img class="card-img-top mx-auto" style="width:60%;border-radius:100px;"
                                                src="../Image/admin.jpg" alt="login Image">
                                            <div class="card-body">
                                                <h4 class="card-title">Profile Info</h4>
                                                <p class="card-text"><i class="fa fa-user">&nbsp;</i>
                                                    <?php echo $_SESSION['Username'];
                                                    ?>
                                                </p>

                                                <a href="#" class=" "><i class="fa fa-edit">&nbsp;</i>Edit Profile</a>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                               
                            </div>

                        </div>



        </body>

       
        </html>