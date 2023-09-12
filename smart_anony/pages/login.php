<?php

include_once("../pages/connection.php");
session_start();




if (isset($_POST['username'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);


    $SELECT = "SELECT * From customer Where Username = '$uname' AND Pwd='$password' Limit 1";
    $result = mysqli_query($conn, $SELECT);

    

    if ($result && mysqli_num_rows($result) == 1) {
        $uname = $_POST['username'];
        $SELECT2 = "SELECT * From customer Where Username = '$uname' AND (position = 'Admin') Limit 1";
        $result2 = mysqli_query($conn, $SELECT2);


        if (mysqli_num_rows($result2) == 1) {
            //include("home.php");
            
            $_SESSION['Username']=$uname;
            header("Location: home.php");
           
        } else {
            
            $_SESSION['Username']=$uname;
            header("Location: user/Index.php");
            exit();
        }
    } 
    else {
        include("retry.html");
        exit();
    }
}
else{

    header("location:Index.html");
}

?>