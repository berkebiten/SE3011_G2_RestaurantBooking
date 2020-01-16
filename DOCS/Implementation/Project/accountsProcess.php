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
        if(mysqli_num_rows($results3) > 0){
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
        if(mysqli_num_rows($results3) > 0){
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
?>

