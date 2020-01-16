<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
session_start();
include("dbconnect.php");

if (!isset($_SESSION['username'])) { // CHECKING IF THERE IS A USER THAT IS LOGGED IN OR NOT
    header('location:signIn.php'); // IF THERE ARE NO USER LOGGED IN 
} else {
    $viewerUsername = $_SESSION['username']; // SESSION USERNAME
    $sql_rest = "SELECT * FROM restaurant_owner WHERE uname='$viewerUsername'"; // SELECTING EVERYTING FROM RESTAURANT USER TABLE WHERE USERNAME IS THE SESSION USERNAME
    $sql_ad = "SELECT * FROM admin WHERE uname='$viewerUsername'"; // SELECTING EVERYTING FROM ADMIN TABLE WHERE USERNAME IS THE SESSION USERNAME
    $query_rest = mysqli_query($conn, $sql_rest);
    $query_ad = mysqli_query($conn, $sql_ad);
    if (mysqli_num_rows($query_rest) > 0 || mysqli_num_rows($query_ad) > 0) { // CHECK IF THE VIEWER IS AN ADMIN OR RESTAURANT OWNER OR NOT
        header('location:index.php');
    }
}
// INITIALIZING THE VARIABLES 
$c_username = "";
$r_username = "";
$date = "";
$startTime = "";
$endTime = "";
$phone = "";
$fname = "";
$lname = "";
$email = "";
$party = "";
$feedbacks = array();
$errors = array();
$uname = $_GET['varname'];
$sql = "SELECT * FROM restaurant_owner WHERE uname='$uname'";
$query = mysqli_query($conn, $sql);
$restArray = mysqli_fetch_assoc($query);
$rest_name = $restArray['rest_name'];
$description = $restArray['description'];
$payment = $restArray['payment'];
$additional = $restArray['additional'];
$phoneNo = $restArray['phoneNo'];
$address = $restArray['address'];
$start = $restArray['startTime'];
$end = $restArray['endTime'];
$cap = $restArray['cap'];
$shutdown = $restArray['shutdown'];

if($shutdown == '1'){
    header('location:errorPage.php');
}


if (isset($_POST['booking'])) {// START OF THE INSERTION AFTER CLICKING THE BUTTON NAMES BOOKING
    //TAKING THE VARIABLES FROM THE FORM AN SESSION
    $c_username = $_SESSION['username'];
    $r_username = $uname;
    $date = filter_input(INPUT_POST, 'date');
    $startTime = filter_input(INPUT_POST, 'startTime');
    $endTime = filter_input(INPUT_POST, 'endTime');
    $phone = filter_input(INPUT_POST, 'phoneNo');
    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $email = filter_input(INPUT_POST, 'email');
    $party = filter_input(INPUT_POST, 'party');

    //INITIALIZING THE ERRORS FROM THE INSERTION OF THE FORM
    if (empty($fname)) {
        array_push($errors, "First Name is required");
    }
    if (empty($lname)) {
        array_push($errors, "Last Name is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($startTime)) {
        array_push($errors, "Start time is required");
    }
    if (empty($endTime)) {
        array_push($errors, "End time is required");
    }
    if (empty($party)) {
        array_push($errors, "Party size is required");
    }
    if (empty($phone)) {
        array_push($errors, "Phone number is required");
    }
    if (empty($date)) {
        array_push($errors, "Booking date is required");
    }
    if ($startTime > $endTime) {
        array_push($errors, "Starting time of the booking cannot be later than ending time.");
    }



    $query1 = mysqli_query($conn, "SELECT * FROM bookings WHERE restaurant_uname = '$r_username' AND date = '$date'"); // CHECKING OF THERE IS A RESERVATION AT THE TIME AND DATE CHOOSEN
    //INITIALIZING THE VARIABLES AND STARTING TO INSERTION OF THE BOOKING
    $partySize = 0;
    $i = 0;
    while ($array = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
        if (!(strtotime($startTime) - strtotime($array['end_time']) >= 0 || strtotime($array['start_time']) - strtotime($endTime) >= 0)) { // SELECTING THE BOOKINGS THAT ARE BETWEEN THE SELECTED START TIME AND END TIME EVEN FOR AN HOUR 
            $partySize = $partySize + $array['party'];
        }
    }
    $currentCap = $cap - $partySize; // INITIALIZING THE CURRENT CAPACITY OF THE RESTAURANT THAT IN BETWEEN START TIME AND END TIME OF THE BOOKING


    if ($currentCap >= $party && count($errors) == 0) {// INITIALIZING THE FEEDBACK THAT WILL BE GIVEN TO THE USER
        $query = mysqli_query($conn, "insert into bookings(customer_uname, restaurant_uname, party, start_time, end_time, fname, lname, email, phoneNo, date) VALUES('$c_username', '$r_username','$party','$startTime','$endTime','$fname','$lname','$email','$phone','$date')");
        array_push($feedbacks, "Your booking has been completed.");
        array_push($feedbacks, "You will be redirected to Your Bookings when you click 'OK' button.");
    } else if (!($currentCap >= $party)) {// INITIALIZING THE ERROR IF CURRENT CAPACITY OF THE RESTAURANT IS NOT GREATER OR EQUAL TO THE CHOSEN PARTY SIZE
        array_push($errors, "There are no capacity in the restaurant that meets your party size at the selected hours.");
    }
}
?>
