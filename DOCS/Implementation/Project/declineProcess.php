<?php
include('dbconnect.php');
$uname = $_GET['varname'];
$query1 = "DELETE FROM rest_signup WHERE uname='$uname'";
$boolean = mysqli_query($conn, $query1);
$restArray = mysqli_fetch_assoc($query);

$rest_email = $restArray['email'];

if ($boolean) {
    $query1 = "DELETE FROM rest_signup WHERE uname='$uname'";
    mysqli_query($conn, $query1);
    $subject = "Restaurant Sign Up";
    $body = "Welcome to our Restaurant Booking System. Your registration is accepted. :)";
    $headers = "From: Restaurant Booking System";

    if (mail($rest_email, $subject, $body, $headers)) {
        array_push($feedbacks, "Email successfully sent to " . $rest_email . ". About being denied.");
    }
    
    header('location: Admin.php');
}

