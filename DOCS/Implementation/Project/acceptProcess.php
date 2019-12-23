<?php

session_start();
include("dbconnect.php");
$usercheck2 = $_SESSION['username']; //SESSION USERNAME
$sql3 = "select uname from admin where uname='$usercheck2'"; //SELECTING USERNAME FROM THE ADMIN TABLE WHERE THE USERNAME IS THE SESSION USERNAME
$queryA = mysqli_query($conn, $sql3);

if (mysqli_num_rows($queryA) > 0) { // CHECK IF THE VIEWER IS AN ADMIN OR NOT

    // GENERATING A RANDOM RECOVERY CODE FUNCTION
    function generateRandomString($length = 8) {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    
    // INITIALIZING THE VARIABLES AND GETTING THEM FROM THE FORMS 
    $feedbacks = array();
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

    
    // START OF THE INSERTION OF A RESTAURANT APPLICATION TO THE RESTAURANT ACCOUNT TABLE
    $password = $rest_password;
    // INSERTING QUERY OF A RESTAURANT ACCOUNT
    $query = "INSERT INTO restaurant_owner(uname, fname, lname, rest_name, email, psw, location, phoneNo, cap, address, startTime, endTime, isBanned, warnCount, recCode) VALUES('$rest_uname',"
            . "'$rest_fname','$rest_lname', '$rest_name', '$rest_email', '$password','$rest_loc','$rest_phone','$rest_cap', '$rest_address', '$rest_start','$rest_end', "
            . "0,0,'$recCode')";
    $boolean = mysqli_query($conn, $query);

    
    // CHECKING OF THE INSERTION QUERY WORKED OR NOT
    if ($boolean) {
        $query1 = "DELETE FROM rest_signup WHERE uname='$uname'"; // DELETING THE RESTAURANT APPLICATION THE TABLE
        mysqli_query($conn, $query1);
        $subject = "Restaurant Sign Up";
        $body = "Welcome to our Restaurant Booking System. Your registration is accepted. :)";
        $headers = "From: Restaurant Booking System";

        if (mail($rest_email, $subject, $body, $headers)) { // SENDING MAIL TO THE OWNER OF THE RESTAURANT THAT ACCEPTED TO THE SITE
            array_push($feedbacks, "Email successfully sent to " . $rest_email . ". About being accepted."); // INITIALIZING FEEDBACK THAT SAYS MAIL IS SENT
        }

        header('location: Admin.php');// REDIRECTING TO THE ADMIN HOMEPAGE
    }
} else {
    header('location:errorPage.php'); // IF THE USER THAT IS VIEWING IS NOT AN ADMIN REDIRECT TO THE ERROR PAGE
}
?>


