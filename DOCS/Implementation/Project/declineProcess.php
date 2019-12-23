<?php

include('dbconnect.php');
session_start();
$usercheck2 = $_SESSION['username']; // SESSION USERNAME
$sql3 = "select uname from admin where uname='$usercheck2'"; //SELECTING USERNAME FROM THE ADMIN TABLE WHERE THE USERNAME IS THE SESSION USERNAME
$queryA = mysqli_query($conn, $sql3);


if (mysqli_num_rows($queryA) > 0) { // CHECK IF THE VIEWER IS AN ADMIN OR NOT
    
    //STARTING THE DELETE PROCESS OF THE RESTAURANT APPLICATION THAT IS DECLINED TO REGISTER
    $uname = $_GET['varname'];
    $query1 = "DELETE FROM rest_signup WHERE uname='$uname'"; // QUERY FOR DELETING
    $boolean = mysqli_query($conn, $query1);
    $restArray = mysqli_fetch_assoc($query);

    $rest_email = $restArray['email'];// GETTING THE EMAIL OF THE RESTAURANT THAT APPLIED

    // CHECKING IF THE QUERY FOR DELETION WORKED OR NOT
    if ($boolean) {
        $subject = "Restaurant Sign Up";
        $body = "Welcome to our Restaurant Booking System. Your registration is accepted. :)";
        $headers = "From: Restaurant Booking System";

        if (mail($rest_email, $subject, $body, $headers)) { // SENDING MAIL TO THE OWNER OF THE RESTAURANT THAT ACCEPTED TO THE SITE
            array_push($feedbacks, "Email successfully sent to " . $rest_email . ". About being denied."); // INITIALIZING FEEDBACK THAT SAYS MAIL IS SENT
        }

        header('location: Admin.php'); // REDIRECTING TO THE ADMIN HOMEPAGE
    }
} else {
    header('location:errorPage.php'); // IF THE USER THAT IS VIEWING IS NOT AN ADMIN REDIRECT TO THE ERROR PAGE
}





