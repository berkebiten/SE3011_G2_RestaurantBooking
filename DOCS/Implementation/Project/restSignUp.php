<?php
function generateRandomString($length = 8) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
include("dbconnect.php");
include ("guestHP.php");
$fname = filter_input(INPUT_POST, 'fname');
$lname = filter_input(INPUT_POST, 'lname');
$username = filter_input(INPUT_POST, 'uname');
$password = filter_input(INPUT_POST, 'psw');
$email = filter_input(INPUT_POST, 'email');
$phoneNo = filter_input(INPUT_POST, 'phone');
$adress = filter_input(INPUT_POST, 'adress');
$rname = filter_input(INPUT_POST, 'rname');
$cap = filter_input(INPUT_POST, 'cap');
$recCode = generateRandomString();


$query = mysqli_query($conn, "select * from restaurant_owner where uname='$username'");
$count = mysqli_num_rows($query);

if (($username == "") or ( $fname == "") or ( $lname == "") or ( $password == "") or ( $email == "") or ( $rname == "")
        or ( $adress == "") or ( $phoneNo == "")) {
    echo "<br>Please fill the inputs";
    exit();
} else if ($count != 0) {
    echo "<font size='3'>The user has already registered </font> ";
} else {
    $password = md5($password); 
    $ekle = mysqli_query($conn, "insert into restaurant_owner values ('$username','$fname' , '$lname' ,'$rname', '$email', '$password', '$adress','$phoneNo' , '$cap', '$recCode')");

    if ($ekle) {
        echo "<br>Registration completed.";
    } else {
        echo "couldn't inserted into db";
        exit();
    }
}
?>