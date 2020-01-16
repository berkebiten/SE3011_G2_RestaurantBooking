<?php
include('dbconnect.php');
session_start();

//INITIALIZING VARIABLES
$errors = array();
$feedbacks = array();
$isViewerAuthorized = false;

$uname = $_SESSION['username'];

$current_email = "";
$email_1 = "";
$email_2 = "";
$restuname = "";

//CHANGE PASSWORD PROCESS START
if (isset($_POST['changePassword'])) {
    //GET INPUTS FROM THE FORM
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    //CHECKING FIELDS' EMPTYNESS AND PUSHING ERRORS
    if (empty($current_password)) {
        array_push($errors, "Current Password is required");
    }if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if (empty($password_2)) {
        array_push($errors, "Re-Password is required");
    }

    if (count($errors) == 0) {//IF THERE ARE NO ERRORS
        //DETERMINING THE USER TYPE
        $query1 = "SELECT * FROM user WHERE uname='$uname'";
        $query2 = "SELECT * FROM restaurant_owner WHERE uname='$uname'";
        $query3 = "SELECT * FROM admin WHERE uname='$uname'";
        $results1 = mysqli_query($conn, $query1);
        $results2 = mysqli_query($conn, $query2);
        $results3 = mysqli_query($conn, $query3);
        $array = array();
        //FILLING THE ARRAY RELATED TO USER TYPE
        if (mysqli_num_rows($results1) > 0) {
            $array = mysqli_fetch_array($results1, MYSQLI_ASSOC);
        } else if (mysqli_num_rows($results2) > 0) {
            $array = mysqli_fetch_array($results2, MYSQLI_ASSOC);
        } else if (mysqli_num_rows($results3) > 0) {
            $array = mysqli_fetch_array($results3, MYSQLI_ASSOC);
        }

        $current_password2 = md5($current_password); //PASSWORD ENCRYPTION
        if ($current_password2 == $array['psw']) {//CHECKING IF GIVEN CURRENT PASSWORD IS CORRECT
            if ($password_1 != $password_2) {
                array_push($errors, "Password do not match."); //PUSHING AN ERROR IF TWO GIVEN NEW PASSWORDS ARE NOT MATCHING
            } else {//IF PASSWORDS MATCH
                $password = md5($password_1); //ENCRYPTING THE NEW PASSWORD
                if (mysqli_num_rows($results1) == 1) {//IF ACCOUNT TYPE IS USER
                    $changeP = mysqli_query($conn, "UPDATE user SET psw = '$password'  WHERE (uname = '$uname')");
                    array_push($feedbacks, "Your password has been changed.");
                    array_push($feedbacks, "You will be redirected to the Sign In screen when you click 'OK' button.");
                } else if (mysqli_num_rows($results2) == 1) {//IF ACCOUNT TYPE IS RESTAURANT OWNER
                    $changeP = mysqli_query($conn, "UPDATE restaurant_owner SET psw = '$password'  WHERE (uname = '$uname')");
                    array_push($feedbacks, "Your password has been changed.");
                    array_push($feedbacks, "You will be redirected to the Sign In screen when you click 'OK' button.");
                } else if (mysqli_num_rows($results3) == 1) {//IF ACCOUNT TYPE IS ADMIN
                    $changeP = mysqli_query($conn, "UPDATE admin SET psw = '$password'  WHERE (uname = '$uname')");
                    array_push($feedbacks, "Your password has been changed.");
                    array_push($feedbacks, "You will be redirected to the Sign In screen when you click 'OK' button.");
                }
            }
        } else {
            array_push($errors, "Your current password is wrong."); //IF CURRENT PASSWORD IS WRONG, PUSHING AN ERROR
        }
    }
}

//CHANGE EMAIL PROCESS START
if (isset($_POST['changeEmail'])) {
    //GET INPUTS FROM THE FORM
    $current_email = mysqli_real_escape_string($conn, $_POST['current_email']);
    $email_1 = mysqli_real_escape_string($conn, $_POST['email_1']);
    $email_2 = mysqli_real_escape_string($conn, $_POST['email_2']);
    //CHECKING FIELDS' EMPTYNESS AND PUSHING ERRORS
    if (empty($current_email)) {
        array_push($errors, "Current Email is required");
    }if (empty($email_1)) {
        array_push($errors, "Email is required");
    }
    if (empty($email_2)) {
        array_push($errors, "Re-Email is required");
    }

    if (count($errors) == 0) {//IF THERE ARE NO ERRORS
        //DETERMINING THE USER TYPE
        $query1 = "SELECT * FROM user WHERE uname='$uname'";
        $query2 = "SELECT * FROM restaurant_owner WHERE uname='$uname'";
        $query3 = "SELECT * FROM admin WHERE uname='$uname'";
        $results1 = mysqli_query($conn, $query1);
        $results2 = mysqli_query($conn, $query2);
        $results3 = mysqli_query($conn, $query3);
        $array = array();
        //FILLING THE ARRAY RELATED TO USER TYPE
        if (mysqli_num_rows($results1) > 0) {
            $array = mysqli_fetch_array($results1, MYSQLI_ASSOC);
        } else if (mysqli_num_rows($results2) > 0) {
            $array = mysqli_fetch_array($results2, MYSQLI_ASSOC);
        } else if (mysqli_num_rows($results3) > 0) {
            $array = mysqli_fetch_array($results3, MYSQLI_ASSOC);
        }

        if ($current_email == $array['email']) {//CHECKING IF GIVEN CURRENT EMAIL IS CORRECT
            if ($email_1 != $email_2) {
                array_push($errors, "Emails do not match."); //PUSHING AN ERROR IF TWO GIVEN NEW EMAILS ARE NOT MATCHING
            } else {//IF EMAILS MATCH
                if (mysqli_num_rows($results1) == 1) {//IF ACCOUNT TYPE IS USER
                    $changeP = mysqli_query($conn, "UPDATE user SET email = '$email_1'  WHERE (uname = '$uname')");
                    array_push($feedbacks, "Your email has been changed.");
                    array_push($feedbacks, "You will be redirected to the Sign In screen when you click 'OK' button.");
                } else if (mysqli_num_rows($results2) == 1) {//IF ACCOUNT TYPE IS RESTAURANT OWNER
                    $changeP = mysqli_query($conn, "UPDATE restaurant_owner SET email = '$email_1'  WHERE (uname = '$uname')");
                    array_push($feedbacks, "Your email has been changed.");
                    array_push($feedbacks, "You will be redirected to the Sign In screen when you click 'OK' button.");
                } else if (mysqli_num_rows($results3) == 1) {//IF ACCOUNT TYPE IS ADMIN
                    $changeP = mysqli_query($conn, "UPDATE admin SET email = '$email_1'  WHERE (uname = '$uname')");
                    array_push($feedbacks, "Your email has been changed.");
                    array_push($feedbacks, "You will be redirected to the Sign In screen when you click 'OK' button.");
                }
            }
        } else {
            array_push($errors, "Your current email is wrong."); //IF CURRENT EMAIL IS WRONG, PUSHING AN ERROR
        }
    }
}

if (isset($_POST['restShutdown'])) {
    //GET INPUTS FROM THE FORM
    $rest_uname = $_SESSION['username'];

    //CHECKING FIELDS' EMPTYNESS AND PUSHING ERRORS
    if (empty($rest_uname)) {
        array_push($errors, "Username is not defined..");
    }

    if (count($errors) == 0) {//IF THERE ARE NO ERRORS
        //DETERMINING THE USER TYPE
        $query2 = "SELECT * FROM restaurant_owner WHERE uname='$uname'";
        $query3 = "SELECT * FROM bookings WHERE restaurant_uname='$uname'";
        $results2 = mysqli_query($conn, $query2);
        $results3 = mysqli_query($conn, $query3);
        $array = array();
        $array1 = array();
        //FILLING THE ARRAY RELATED TO USER TYPE
        if (mysqli_num_rows($results2) > 0) {
            $array = mysqli_fetch_array($results2, MYSQLI_ASSOC);
        }
        if (mysqli_num_rows($results3) > 0) {
            $array1 = mysqli_fetch_array($results3, MYSQLI_ASSOC);
        }

        if ($rest_uname == $array['uname']) {
            if (mysqli_num_rows($results2) == 1) {//IF ACCOUNT TYPE IS RESTAURANT OWNER
                $shutdown = mysqli_query($conn, "UPDATE restaurant_owner SET shutdown = 1  WHERE (uname = '$rest_uname')");
                $suspend_bookings = mysqli_query($conn, "UPDATE bookings SET is_suspended = 1 WHERE (restaurant_uname = '$rest_uname')");
                array_push($feedbacks, "Your restaurant has been shutdown.");
                array_push($feedbacks, "All of the bookings made to your restaurant has been suspended.");
                array_push($feedbacks, "You will be redirected to the homepage when you click 'OK' button.");
            }
        } else {
            array_push($errors, "Your username is not a restaurant owner username."); //IF CURRENT PASSWORD IS WRONG, PUSHING AN ERROR
        }
    }
}

if (isset($_POST['undoShutdown'])) {
    //GET INPUTS FROM THE FORM
    $rest_uname = $_SESSION['username'];

    //CHECKING FIELDS' EMPTYNESS AND PUSHING ERRORS
    if (empty($rest_uname)) {
        array_push($errors, "Username is not defined..");
    }

    if (count($errors) == 0) {//IF THERE ARE NO ERRORS
        //DETERMINING THE USER TYPE
        $query2 = "SELECT * FROM restaurant_owner WHERE uname='$uname'";
        $query3 = "SELECT * FROM bookings WHERE restaurant_uname='$uname'";
        $results2 = mysqli_query($conn, $query2);
        $results3 = mysqli_query($conn, $query3);
        $array = array();
        $array1 = array();
        //FILLING THE ARRAY RELATED TO USER TYPE
        if (mysqli_num_rows($results2) > 0) {
            $array = mysqli_fetch_array($results2, MYSQLI_ASSOC);
        }
        if (mysqli_num_rows($results3) > 0) {
            $array1 = mysqli_fetch_array($results3, MYSQLI_ASSOC);
        }

        if ($rest_uname == $array['uname']) {
            if (mysqli_num_rows($results2) == 1) {//IF ACCOUNT TYPE IS RESTAURANT OWNER
                $shutdown = mysqli_query($conn, "UPDATE restaurant_owner SET shutdown = 0  WHERE (uname = '$rest_uname')");
                $suspend_bookings = mysqli_query($conn, "UPDATE bookings SET is_suspended = 0 WHERE (restaurant_uname = '$rest_uname')");
                array_push($feedbacks, "Your restaurant has been opened again.");
                array_push($feedbacks, "All of the booking made to your restaurant are not suspended anymore.");
                array_push($feedbacks, "You will be redirected to the homepage when you click 'OK' button.");
            }
        } else {
            array_push($errors, "Your username is not a restaurant owner username.");
        }
    }
}

if (isset($_POST['acceptBooking'])) {


    // GENERATING A RANDOM RECOVERY CODE FUNCTION

    function generateRandomString($length = 8) {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    // INITIALIZING THE VARIABLES AND GETTING THEM FROM THE FORMS 
    $restuname = $_GET['varname'];
    $sql = "SELECT * FROM rest_signup WHERE uname='$restuname'";
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
    $shutdown = 0;
    $recCode = generateRandomString();


    // START OF THE INSERTION OF A RESTAURANT APPLICATION TO THE RESTAURANT ACCOUNT TABLE
    $password = $rest_password;
    // INSERTING QUERY OF A RESTAURANT ACCOUNT
    $query = "INSERT INTO restaurant_owner(uname, fname, lname, rest_name, email, psw, location, phoneNo, cap, address, startTime, endTime,stars, price, isBanned, warnCount, recCode, shutdown) VALUES('$rest_uname',"
            . "'$rest_fname','$rest_lname', '$rest_name', '$rest_email', '$password','$rest_loc','$rest_phone','$rest_cap', '$rest_address', '$rest_start','$rest_end', "
            . "1,1,0,0,'$recCode', '$shutdown')";
    $boolean = mysqli_query($conn, $query);


    // CHECKING OF THE INSERTION QUERY WORKED OR NOT
    if ($boolean) {
        $query1 = "DELETE FROM rest_signup WHERE uname='$restuname'"; // DELETING THE RESTAURANT APPLICATION FROM THE TABLE
        mysqli_query($conn, $query1);
        $subject = "Restaurant Sign Up";
        $body = "Welcome to our Restaurant Booking System. Your registration is accepted. :)";
        $headers = "From: Restaurant Booking System";

        if (mail($rest_email, $subject, $body, $headers)) { // SENDING MAIL TO THE OWNER OF THE RESTAURANT THAT ACCEPTED TO THE SITE
            array_push($feedbacks, "Email successfully sent to " . $rest_email . ". About being accepted."); // INITIALIZING FEEDBACK THAT SAYS MAIL IS SENT
        }
    }
}

if (isset($_POST['declineBooking'])) {

    //STARTING THE DELETE PROCESS OF THE RESTAURANT APPLICATION THAT IS DECLINED TO REGISTER
    $restuname = $_GET['varname'];
    $sql = "SELECT * FROM rest_signup WHERE uname='$restuname'";
    $restmail = mysqli_query($conn, $sql);
    $restArray = mysqli_fetch_assoc($restmail);
    $rest_email = $restArray['email']; // GETTING THE EMAIL OF THE RESTAURANT THAT APPLIED

    $query1 = "DELETE FROM rest_signup WHERE uname='$restuname'"; // QUERY FOR DELETING
    $boolean = mysqli_query($conn, $query1);


    // CHECKING IF THE QUERY FOR DELETION WORKED OR NOT
    if ($boolean) {
        $subject = "Restaurant Sign Up";
        $body = "Sorry.. Your registration is not accepted. :)";
        $headers = "From: Restaurant Booking System";

        if (mail($rest_email, $subject, $body, $headers)) { // SENDING MAIL TO THE OWNER OF THE RESTAURANT THAT ACCEPTED TO THE SITE
            array_push($feedbacks, "Email successfully sent to " . $rest_email . ". About being denied."); // INITIALIZING FEEDBACK THAT SAYS MAIL IS SENT
        }
    }
}
?>

