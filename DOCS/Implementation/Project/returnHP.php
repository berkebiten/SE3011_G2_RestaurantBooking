<?php
include("session.php");
include("dbconnect.php");
$username = $_SESSION['username'];
$query = mysqli_query($conn, "select * from admin where uname = '$username'");
$query2 = mysqli_query($conn, "select * from user where uname = '$username'");
$query3 = mysqli_query($conn, "select * from restaurant_owner where uname = '$username'");
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

$counta = mysqli_num_rows($query);
$countu = mysqli_num_rows($query2);
$countr = mysqli_num_rows($query3);

if ($counta == 1) {
    header("location:Admin.php");
} else if ($countu == 1) {
    header("location:user.php");
} else if ($countr == 1) {
    header("location:RestaurantOwner.php");
} else {
    header("location:index.php");
}
?>