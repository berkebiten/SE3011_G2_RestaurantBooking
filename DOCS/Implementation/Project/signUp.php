<?php
include("dbconnect.php");
include ("guestHP.php");
$fname = filter_input(INPUT_POST, 'fname');
$lname = filter_input(INPUT_POST, 'lname');
$username = filter_input(INPUT_POST, 'uname');
$password = filter_input(INPUT_POST, 'psw');
$email = filter_input(INPUT_POST, 'email');


$query = mysqli_query($conn, "select * from user where uname='$username'");
$count = mysqli_num_rows($query);

if (($username == "") or ( $fname == "") or ( $lname == "") or ( $password == "") or ( $email == "")) {
    echo "<br>Please fill the inputs";
    exit();
} else if ($count != 0) {
    echo "<font size='3'>The user has already registered </font> ";
} else {
    $ekle = mysqli_query($conn, "insert into user values ('$username','$fname' , '$lname' ,'$email', '$password')");

    if ($ekle) {
        echo "<br><a href=firstPage.php>Registration completed.  Back to Home page </a>";
    } else {
        echo "couldn't inserted into db";
        exit();
    }
}
?>