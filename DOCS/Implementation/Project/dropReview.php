<?php

include("dbconnect.php");

$customer_uname = "";
$rest_uname = "";
$text = "";
$star = 0;
$price = 0;
$bookId = $_GET['varname'];
$feedbacks = array();
$errors = array();



if (isset($_POST['drop_review'])) {
    $customer_uname = $_SESSION['username'];

    $sqlRest = "select restaurant_uname from bookings where bookingId = '$bookId'";
    $queryRest = mysqli_query($conn, $sqlRest);
    $arrRest = mysqli_fetch_assoc($queryRest);

    $rest_uname = $arrRest['restaurant_uname'];

    $text = filter_input(INPUT_POST, 'text');
    $starStr = filter_input(INPUT_POST, 'starRate');
    $priceStr = filter_input(INPUT_POST, 'priceRate');

    if ($starStr == "Bad") {
        $star = 1;
    } else if ($starStr == "Average") {
        $star = 2;
    } else if ($starStr == "Good") {
        $star = 3;
    } else {
        $star = 0;
    }

    if ($priceStr == "Cheap") {
        $price = 1;
    } else if ($priceStr == "Average") {
        $price = 2;
    } else if ($priceStr == "Expensive") {
        $price = 3;
    } else {
        $price = 0;
    }

    if (empty($text)) {
        array_push($errors, "Review text is required.");
    }


    if (count($errors) == 0) {
        $sqlInsert = "INSERT INTO review(customer_uname, rest_uname, text, star, price) VALUES('$customer_uname','$rest_uname','$text','$star','$price')";
        $queryInsert = mysqli_query($conn, $sqlInsert);
        array_push($feedbacks, "Your review is submitted.");
        array_push($feedbacks, "You will be redirected to your bookings when you click 'OK' button.");
    }
}
?>
