<?php
include('dbconnect.php');
session_start();
if (!isset($_SESSION['success'])) {
    header('location:errorPage.php');
}
$usercheck2 = $_SESSION['username']; // SESSION USERNAME
$sql3 = "select uname from admin where uname='$usercheck2'"; //SELECTING USERNAME FROM THE ADMIN TABLE WHERE THE USERNAME IS THE SESSION USERNAME
$queryA = mysqli_query($conn, $sql3);
$isAdminViewing = false;
$feedbacks = array();
$errors = array();
if (mysqli_num_rows($queryA) > 0) {
    $isAdminViewing = true;
}
if ($isAdminViewing) { // CHECK IF THE VIEWER IS AN ADMIN OR NOT
    //STARTING THE UNBAN PROCESS OF THE USER
    $uname = $_GET['varname'];
    $sql1 = "select * from user where uname='$uname'"; // CHECK IF THE PROFILE THAT ADMIN WANTS TO BAN IS USER OR NOT
    $sql2 = "select * from restaurant_owner where uname='$uname'"; // CHECK IF THE PROFILE THAT ADMIN WANTS TO BAN IS RESTAURANT OR NOT
    $query1 = mysqli_query($conn, $sql1);
    $query2 = mysqli_query($conn, $sql2);
    $isUser = false;
    $isRestaurant = false;
    if (mysqli_num_rows($query1) > 0) {
        $isUser = true;
    }
    if (mysqli_num_rows($query2) > 0) {
        $isRestaurant = true;
    }

    
        if ($isUser) {
            $sqlU = "delete from ban_warn where user_uname='$uname' and type='Ban'";
            $queryU = mysqli_query($conn, sqlU);
            $sql58 = "UPDATE user SET isBanned = '0' WHERE (uname = '$uname')";
            $query58 = mysqli_query($conn, $sql58);
        } else if ($isRestaurant) {
            $sqlU = "delete from ban_warn where rest_uname='$uname' and type='Ban'";
            $queryU = mysqli_query($conn, $sqlU);
            $sql58 = "UPDATE restaurant_owner SET isBanned = '0' WHERE (uname = '$uname')";
            $query58 = mysqli_query($conn, $sql58);
            header('location:Admin.php');
        }else {
            header('location:errorPage.php');
        }
    }else {
        header('location:errorPage.php');
    }

