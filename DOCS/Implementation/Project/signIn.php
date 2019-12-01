<?php

include ("dbconnect.php");
session_start();
$username = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'username'));
$passwrd = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'psw'));
$passwrd= md5($passwrd);
if (($username == "") or ( $passwrd == "")) {
    exit();
} else {
    $query = mysqli_query($conn, "select * from admin where uname = '$username' and psw = '$passwrd'");
    $query2 = mysqli_query($conn, "select * from user where uname = '$username' and psw = '$passwrd'");
    $query3 = mysqli_query($conn, "select * from restaurant_owner where uname = '$username' and psw = '$passwrd'");
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

    $count = mysqli_num_rows($query);
    $count2 = mysqli_num_rows($query2);
    $count3 = mysqli_num_rows($query3);

    if ($count == 1) {
        $_SESSION['username'] = $username;
        header("location:Admin.php");
    } else if ($count2 == 1) {
        $_SESSION['username'] = $username;
        header("location:user.php");
    } else if ($count3 == 1) {
        $_SESSION['username'] = $username;
        header("location:RestaurantOwner.php");
    } else {
        $error = "Your Login Name or Password is invalid";
        echo $error;
    }
}
?>

