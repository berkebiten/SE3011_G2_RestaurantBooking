<?php

include("dbconnect.php");

// INITIALIZING THE VARIABLES 
$customer_uname = "";
$rest_uname = "";
$text = "";
$star = 0;
$price = 0;
$bookId = $_GET['varname'];
$feedbacks = array();
$errors = array();



if (isset($_POST['drop_review'])) { //IS DROP_REVIEW BUTTON CLICKED OR NOT
    
    $customer_uname = $_SESSION['username'];

    $sqlRest = "select restaurant_uname from bookings where bookingId = '$bookId'";
    $queryRest = mysqli_query($conn, $sqlRest);
    $arrRest = mysqli_fetch_assoc($queryRest);

    $rest_uname = $arrRest['restaurant_uname'];

    $text = filter_input(INPUT_POST, 'text');
    $starStr = filter_input(INPUT_POST, 'starRate');
    $priceStr = filter_input(INPUT_POST, 'priceRate');
    
    // VALUES OF THE STARS
    if ($starStr == "Bad") {
        $star = 1;
    } else if ($starStr == "Average") {
        $star = 2;
    } else if ($starStr == "Good") {
        $star = 3;
    } else {
        $star = 0;
    }
    
    // VALUES OF THE PRICE
    if ($priceStr == "Cheap") {
        $price = 1;
    } else if ($priceStr == "Average") {
        $price = 2;
    } else if ($priceStr == "Expensive") {
        $price = 3;
    } else {
        $price = 0;
    }
    
    // INITIALIZING ERRORS 
    if (empty($text)) {
        array_push($errors, "Review text is required.");
    }

    // IF THERE ARE NO ERRORS INSERTS THE REVIEW TO THE REVIEW TABLE
    if (count($errors) == 0){
        $sqlInsert = "INSERT INTO review(customer_uname, rest_uname, text, star, price) VALUES('$customer_uname','$rest_uname','$text','$star','$price')";
        $queryInsert = mysqli_query($conn, $sqlInsert);
        array_push($feedbacks, "Your review is submitted.");
        array_push($feedbacks, "You will be redirected to your bookings when you click 'OK' button.");
        $notification5SQL = "insert into notification(toName,text,link,isRead) values('$rest_uname','A review has been made to your restaurant. Click to see your Reviews via your profile.' ,'restaurantProfile.php?varname=$rest_uname' ,0)";
        $queryNoti5 = mysqli_query($conn, $notification5SQL);
    }
}
?>
