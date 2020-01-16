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
    //STARTING THE BAN PROCESS OF THE USER
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

    if (isset($_POST['ban'])) {// START OF THE INSERTION AFTER CLICKING THE BUTTON NAMES BOOKING
        $bwId = null;
        $reason = filter_input(INPUT_POST, 'reason');
        $type = filter_input(INPUT_POST, 'type');


        if ($isUser) {
            $sql6 = "select * from ban_warn where ((user_uname='$uname') && (type='ban'))";
            $query6 = mysqli_query($conn, $sql6);
            if (mysqli_num_rows($query6) > 0) {
                array_push($errors, "The user has already banned");
            }
            if (count($errors) == 0) {
                $sql5 = "insert into ban_warn(bwId,type,admin_uname,user_uname,reason) values('$bwId','$type','$usercheck2','$uname','$reason')";
                $query5 = mysqli_query($conn, $sql5);
                if ($type == 'Ban') {
                    $sql58 = "UPDATE user SET isBanned = '1' WHERE (uname = '$uname')";
                    $query58 = mysqli_query($conn, $sql58);
                    array_push($feedbacks, "The user has been banned.");
                } else {
                    array_push($feedbacks, "The user has been warned.");
                    $sqlW = "select count(*) as count from ban_warn where user_uname='$uname' && type='warn'";
                    $queryW = mysqli_query($conn, $sqlW);
                    $arrayW = mysqli_fetch_assoc($queryW);
                    if ($arrayW['count'] == 10) {
                        $sqlBAN = "insert into ban_warn(bwId,type,admin_uname,user_uname,reason) values('$bwId','Ban','$usercheck2','$uname','User has 10 warnings')";
                        $queryBAN = mysqli_query($conn, $sqlBAN);
                    }
                }
            }
        } else if ($isRestaurant) {
            $sql6 = "select * from ban_warn where ((rest_uname='$uname') && (type='ban'))";
            $query6 = mysqli_query($conn, $sql6);
            if (mysqli_num_rows($query6) > 0) {
                array_push($errors, "The user has already banned");
            }
            if (count($errors) == 0) {
                $sql5 = "insert into ban_warn(bwId,type,admin_uname,rest_uname,reason) values('$bwId','$type','$usercheck2','$uname','$reason')";
                $query5 = mysqli_query($conn, $sql5);
                if ($type == 'Ban') {
                    $sql58 = "UPDATE restaurant_owner SET isBanned = '1' WHERE (uname = '$uname')";
                    $query58 = mysqli_query($conn, $sql58);
                    array_push($feedbacks, "The user has been banned.");
                } else {
                    array_push($feedbacks, "The user has been warned.");
                    $sqlW = "select count(*) as count from ban_warn where rest_uname='$uname' && type='warn'";
                    $queryW = mysqli_query($conn, $sqlW);
                    $arrayW = mysqli_fetch_assoc($queryW);
                    if ($arrayW['count'] == 10) {
                        $sqlBAN = "insert into ban_warn(bwId,type,admin_uname,rest_uname,reason) values('$bwId','Ban','$usercheck2','$uname','User has 10 warnings')";
                        $queryBAN = mysqli_query($conn, $sqlBAN);
                    }
                }
            }
        } else {
            header('location:errorPage.php');
        }
    }
} else {
    header('location:errorPage.php');
}