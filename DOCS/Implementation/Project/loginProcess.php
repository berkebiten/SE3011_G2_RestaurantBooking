<?php

session_start();

function generateRandomString($length = 8) {
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

$username = "";
$email = "";
$fname = "";
$lname = "";
$rest_name = "";
$rest_cap = 0;
$rest_loc = "";
$rest_phone = "";

$errors = array();
$recCode = "";

include("dbconnect.php");
// REGISTER USER
if (isset($_POST['reg_user'])) {

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    $recCode = generateRandomString();

    if (empty($fname)) {
        array_push($errors, "First Name is required");
    }
    if (empty($lname)) {
        array_push($errors, "Last Name is required");
    }
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    $user_check_query = "SELECT * FROM user WHERE uname='$username' OR email='$email' LIMIT 1";
    $restaurant_check_query = "SELECT * FROM restaurant_owner WHERE uname='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $result2 = mysqli_query($conn, $restaurant_check_query);
    $user = mysqli_fetch_assoc($result);
    $rest = mysqli_fetch_assoc($result2);

    if ($user || $rest) {
        if ($user['uname'] === $username || $rest['uname'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email || $rest['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1);

        $query = "INSERT INTO user VALUES('$username','$fname','$lname', '$email', '$password', '$recCode',0,0)";
        mysqli_query($conn, $query);
        header('location: signIn.php');
    }
}

//REGISTER RESTAURANT
if (isset($_POST['reg_rest'])) {

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $rest_name = mysqli_real_escape_string($conn, $_POST['rest_name']);
    $rest_loc = mysqli_real_escape_string($conn, $_POST['rest_loc']);
    $rest_cap = mysqli_real_escape_string($conn, $_POST['rest_cap']);
    $rest_phone = mysqli_real_escape_string($conn, $_POST['rest_phone']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    $recCode = generateRandomString();

    if (empty($fname)) {
        array_push($errors, "First Name is required");
    }
    if (empty($lname)) {
        array_push($errors, "Last Name is required");
    }
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }



    $user_check_query = "SELECT * FROM user WHERE uname='$username' OR email='$email' LIMIT 1";
    $restaurant_check_query = "SELECT * FROM restaurant_owner WHERE uname='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $result2 = mysqli_query($conn, $restaurant_check_query);
    $user = mysqli_fetch_assoc($result);
    $rest = mysqli_fetch_assoc($result2);

    if ($user || $rest) {
        if ($user['uname'] === $username || $rest['uname'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email || $rest['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }


    if (count($errors) == 0) {
        $password = md5($password_1);
        $query = "INSERT INTO restaurant_owner(uname, fname, lname, rest_name, email, psw, location, phoneNo, cap, recCode) VALUES('$username','$fname','$lname','$rest_name', '$email', '$password','$rest_loc','$rest_phone','$rest_cap', '$recCode')";
        mysqli_query($conn, $query);
        header('location: signIn.php');
    }
}

//LOGIN
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password2 = md5($password);
        $query1 = "SELECT * FROM user WHERE uname='$username' AND psw='$password2'";
        $query2 = "SELECT * FROM restaurant_owner WHERE uname='$username' AND psw='$password2'";
        $query3 = "SELECT * FROM admin WHERE uname='$username' AND psw='$password2'";
        $results1 = mysqli_query($conn, $query1);
        $results2 = mysqli_query($conn, $query2);
        $results3 = mysqli_query($conn, $query3);
        if (mysqli_num_rows($results1) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else if (mysqli_num_rows($results2) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: RestaurantOwner.php');
        } else if (mysqli_num_rows($results3) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: Admin.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
//FORGOT PASSWORD
if (isset($_POST['forgotSend'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);


    if (empty($email)) {
        array_push($errors, "Email is required");
    }


    if (count($errors) == 0) {
        $query1 = "SELECT * FROM user WHERE email='$email' ";
        $query2 = "SELECT * FROM restaurant_owner WHERE email='$email' ";
        $query3 = "SELECT * FROM admin WHERE email='$email' ";
        $results1 = mysqli_query($conn, $query1);
        $results2 = mysqli_query($conn, $query2);
        $results3 = mysqli_query($conn, $query3);
        /*
          EMAIL PROCESS WILL BE INSERTED HERE
         */


        //TEMPORARY SOLUTION
        if (mysqli_num_rows($results1) == 1 || mysqli_num_rows($results2) == 1 || mysqli_num_rows($results3) == 1) {
            header('location: forgotPswrd2.php');
        } else {
            array_push($errors, "There is no user registered with this email.");
        }
    }
}

//FORGOT PASSWORD 2
if (isset($_POST['forgot2Send'])) {
    $recIn = mysqli_real_escape_string($conn, $_POST['recIn']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    if (empty($recIn)) {
        array_push($errors, "Recovery Code is required");
    }if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if (empty($password_2)) {
        array_push($errors, "Re-Password is required");
    }

    if (count($errors) == 0) {

        $query1 = "SELECT * FROM user WHERE recCode='$recIn'";
        $query2 = "SELECT * FROM restaurant_owner WHERE recCode='$recIn'";
        $query3 = "SELECT * FROM admin WHERE recCode='$recIn'";
        $results1 = mysqli_query($conn, $query1);
        $results2 = mysqli_query($conn, $query2);
        $results3 = mysqli_query($conn, $query3);
        if ($password_1 != $password_2) {
            array_push($errors, "Password do not match.");
        }

        $password = md5($password_1);
        if (mysqli_num_rows($results1) == 1) {
            $changeP = mysqli_query($conn, "UPDATE user SET psw = '$password'  WHERE (recCode = '$recIn')");
            header('location: signIn.php');
        } else if (mysqli_num_rows($results2) == 1) {
            $changeP = mysqli_query($conn, "UPDATE restaurant_owner SET psw = '$password'  WHERE (recCode = '$recIn')");
            header('location: signIn.php');
        } else if (mysqli_num_rows($results3) == 1) {
            $changeP = mysqli_query($conn, "UPDATE admin SET psw = '$password'  WHERE (recCode = '$recIn')");
            header('location: signIn.php');
        } else {
            array_push($errors, "Recovery Code is wrong.");
        }
    }
}

//SUBMIT TICKET
if (isset($_POST['sub_request'])) {

    $textArea = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $username = $_SESSION['username'];
    $date = date('Y/m/d');

    if (empty($textArea)) {
        array_push($errors, "Description is required");
    }
    if ($category == "Category") {
        array_push($errors, "You must choose a category.");
    }

    $variable = "";
    $user_check = "SELECT uname FROM user WHERE uname='$username'";
    $rest_check = "SELECT uname FROM restaurant_owner where uname='$username'";
    $query1 = mysqli_query($conn, $user_check);
    $query2 = mysqli_query($conn, $rest_check);
    if (mysqli_num_rows($query1) == 1) {
        $variable = "user_uname";
    } else if (mysqli_num_rows($query2) == 1) {
        $variable = "rest_uname";
    }

    if ($variable == "user_uname") {
        $ticket_check_query = "SELECT * FROM ticket WHERE user_uname='$username' AND isResponded= '0'";
    } else if ($variable == "rest_uname") {
        $ticket_check_query = "SELECT * FROM ticket WHERE rest_uname='$username' AND isResponded= '0'";
    }


    $result = mysqli_query($conn, $ticket_check_query);
    $count = mysqli_num_rows($result);
    if ($count >= 5) {
        array_push($errors, "You must wait until one of your requests is responded.");
    }


    if (count($errors) == 0) {
        $variable = "";
        $user_check = "SELECT uname FROM user WHERE uname='$username'";
        $rest_check = "SELECT uname FROM restaurant_owner where uname='$username'";
        $query1 = mysqli_query($conn, $user_check);
        $query2 = mysqli_query($conn, $rest_check);
        if (mysqli_num_rows($query1) == 1) {
            $variable = "user_uname";
        } else if (mysqli_num_rows($query2) == 1) {
            $variable = "rest_uname";
        }

        if ($variable == "user_uname") {
            $query4 = "INSERT INTO ticket(user_uname,category, description, date, isResponded)  VALUES('$username','$category','$textArea','$date','0')";
            mysqli_query($conn, $query4);
        } else if ($variable == "rest_uname") {
            $query5 = "INSERT INTO ticket(rest_uname,category, description, date, isResponded)  VALUES('$username','$category','$textArea','$date','0')";
            mysqli_query($conn, $query5);
        } else {
            echo "sasa";
        }
        header('location: support.php');
    }
}
