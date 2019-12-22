<?php

include("dbconnect.php");

if (isset($_POST['drop_reply'])) {
    $reply = filter_input(INPUT_POST, 'reply');
    $reviewId = filter_input(INPUT_POST, 'reviewId');
    $sql41 = "SELECT * FROM review WHERE reviewId = '$reviewId'";
    $query41 = mysqli_query($conn, $sql41);
    $arr41 = mysqli_fetch_assoc($query41);

    if (empty($arr41['reply'])) {

        if (!empty($reply) && !empty($reviewId)) {
            $sqlRep = "UPDATE review SET reply = '$reply' WHERE reviewId = '$reviewId'";
            $queryRep = mysqli_query($conn, $sqlRep);
            header('location:restaurantProfile.php?varname='.$arr41['rest_uname']);
        } else {
            header('location:errorPage.php');
        }
    }
}

