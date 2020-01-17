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
        if ($type == 'ban') {
            $type = 0;
        } else {
            $type = 1;
        }


        if ($isUser) {
            $sql6 = "select * from user where uname='$uname'";
            $query6 = mysqli_query($conn, $sql6);
            $array6 = mysqli_fetch_array($query6,MYSQLI_ASSOC);
            if ($array6['isBanned'] == 1) {
                array_push($errors, "The user is already banned");
            }
            if (count($errors) == 0) {
                $sql5 = "insert into ban_warn(type,admin_uname,user_uname,reason) values('$type','$usercheck2','$uname','$reason')";
                $query5 = mysqli_query($conn, $sql5);
                if ($type == 0) {
                    $sql58 = "UPDATE user SET isBanned = 1 WHERE uname = '$uname'";
                    $query58 = mysqli_query($conn, $sql58);
                    array_push($feedbacks, "The user has been banned.");
                } else {
                    array_push($feedbacks, "The user has been warned.");
                    $sqlW = "select * from user where uname='$uname'";
                    $queryW = mysqli_query($conn, $sqlW);
                    $arrayW = mysqli_fetch_assoc($queryW);
                    $notification2SQL = "insert into notification(toName,text,link,isRead) values('$uname','You have been warned. Reason: $reason' ,'#' ,0)";
                    $queryNoti2 = mysqli_query($conn, $notification2SQL);
                    $warnCount2 = $arrayW['warnCount'] + 1;
                    $sql58 = "UPDATE user SET warnCount = $warnCount2 WHERE uname = '$uname'";
                    $query58 = mysqli_query($conn, $sql58);
                    if ($arrayW['warnCount'] >= 10) {
                        $sqlBAN = "insert into ban_warn(bwId,type,admin_uname,user_uname,reason) values('$bwId',0,'$usercheck2','$uname','User has 10 warnings')";
                        $queryBAN = mysqli_query($conn, $sqlBAN);
                        $sql58 = "UPDATE user SET isBanned = 1 WHERE uname = '$uname'";
                        $query59 = mysqli_query($conn, $sql58);
                        array_push($feedbacks, "The user has been banned. Because warn count reached the limit");
                    }
                }
            }
        } else if ($isRestaurant) {
            $sql6 = "select * from restaurant_owner where uname='$uname' and isBanned=0";
            $query6 = mysqli_query($conn, $sql6);
            $array6 = mysqli_fetch_array($query6,MYSQLI_ASSOC);
            if ($array6['isBanned'] == 1) {
                array_push($errors, "The restaurant is already banned");
            }
            if (count($errors) == 0) {
                $sql5 = "insert into ban_warn(type,admin_uname,rest_uname,reason) values('$type','$usercheck2','$uname','$reason')";
                $query5 = mysqli_query($conn, $sql5);
                if ($type == 0) {
                    $sql58 = "UPDATE restaurant_owner SET isBanned = 1 WHERE uname = '$uname'";
                    $query58 = mysqli_query($conn, $sql58);
                    array_push($feedbacks, "The restaurant has been banned.");
                } else {
                    array_push($feedbacks, "The restaurant has been warned.");
                    $sqlW = "select * from restaurant_owner where uname='$uname'";
                    $queryW = mysqli_query($conn, $sqlW);
                    $arrayW = mysqli_fetch_assoc($queryW);
                    $notification2SQL = "insert into notification(toName,text,link,isRead) values('$uname','You have been warned. Reason: $reason' ,'#' ,0)";
                    $queryNoti2 = mysqli_query($conn, $notification2SQL);
                    $warnCount2 = $arrayW['warnCount'] + 1;
                    $sql58 = "UPDATE restaurant_owner SET warnCount = $warnCount2 WHERE uname = '$uname'";
                    $query58 = mysqli_query($conn, $sql58);
                    if ($arrayW['warnCount'] >= 10) {
                        $sqlBAN = "insert into ban_warn(bwId,type,admin_uname,rest_uname,reason) values('$bwId',1,'$usercheck2','$uname','Restaurant has 10 warnings')";
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