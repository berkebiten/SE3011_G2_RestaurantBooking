<?php
include("dbconnect.php");
function generateRandomString($length = 8) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$fname = filter_input(INPUT_POST, 'fname');
$lname = filter_input(INPUT_POST, 'lname');
$username = filter_input(INPUT_POST, 'uname');
$password = filter_input(INPUT_POST, 'psw');
$email = filter_input(INPUT_POST, 'email');
$recCode = generateRandomString();


$query = mysqli_query($conn, "select * from user where uname='$username' or email='$email'");
$count = mysqli_num_rows($query);
if ($count != 0) {
    echo "<font size='3'>The user has already registered </font> ";
} else {
    $ekle = mysqli_query($conn, "insert into user values ('$username','$fname' , '$lname' ,'$email', '$password')");
    header("location:returnHP.php");
}
?>