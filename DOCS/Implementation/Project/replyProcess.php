<?php

include("dbconnect.php");
//REPLY 
if (isset($_POST['drop_reply'])) {
    //GETS INPUTS FROM DROP REPLY FORM
    $reply = filter_input(INPUT_POST, 'reply');
    $reviewId = filter_input(INPUT_POST, 'reviewId');

    $sql41 = "SELECT * FROM review WHERE reviewId = '$reviewId'";//GETS ALL FIELDS OF THE TICKET FROM DATABASE
    $query41 = mysqli_query($conn, $sql41);
    $arr41 = mysqli_fetch_assoc($query41);

    if (empty($arr41['reply'])) {//IF REPLY FIELD OF THE REVIEW WAS EMPTY BEFORE

        if (!empty($reply) && !empty($reviewId)) { //IF REPLY FIELD OF THE FORM IS NOT EMPTY
            $sqlRep = "UPDATE review SET reply = '$reply' WHERE reviewId = '$reviewId'";//UPDATES THE RELATED ROW AND INSERTS REPLY.
            $queryRep = mysqli_query($conn, $sqlRep);
            header('location:restaurantProfile.php?varname='.$arr41['rest_uname']);//REDIRECTS THE RESTAURANT OWNER
        } else {
            header('location:errorPage.php');//REDIRECTS TO ERROR PAGE
        }
    }
}

