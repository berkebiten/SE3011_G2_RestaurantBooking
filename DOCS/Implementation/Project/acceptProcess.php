<?php
session_start();
include("dbconnect.php");
$feedbacks=array();
function generateRandomString($length = 8) {
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

$uname = $_GET['varname'];
$sql = "SELECT * FROM rest_signup WHERE uname='$uname'";
$query = mysqli_query($conn, $sql);

$restArray = mysqli_fetch_assoc($query);

$rest_uname = $restArray['uname'];
$rest_fname = $restArray['fname'];
$rest_lname = $restArray['lname'];
$rest_name = $restArray['rest_name'];
$rest_email = $restArray['email'];
$rest_password = $restArray['psw'];
$rest_loc = $restArray['location'];
$rest_phone = $restArray['phoneNo'];
$rest_address = $restArray['address'];
$rest_start = $restArray['startTime'];
$rest_end = $restArray['endTime'];
$rest_cap = $restArray['cap'];
$recCode = generateRandomString();

$password = md5($rest_password);
$query = "INSERT INTO restaurant_owner(uname, fname, lname, rest_name, email, psw, location, phoneNo, cap, address, startTime, endTime,  recCode) VALUES('$rest_uname',"
        . "'$rest_fname','$rest_lname', '$rest_name', '$rest_email', '$password','$rest_loc','$rest_phone','$rest_cap', '$rest_address', '$rest_start','$rest_end', "
        . "'$recCode')";
$boolean = mysqli_query($conn, $query);

if ($boolean) {
    $query1 = "DELETE FROM rest_signup WHERE uname='$uname'";
    mysqli_query($conn, $query1);
    $subject = "Restaurant Sign Up";
    $body = "Welcome to our Restaurant Booking System. Your registration is accepted. :)";
    $headers = "From: Restaurant Booking System";

    if (mail($rest_email, $subject, $body, $headers)) {
        array_push($feedbacks, "Email successfully sent to " . $rest_email . ". About being accepted.");
    }
    
    header('location: Admin.php');
}
?>

