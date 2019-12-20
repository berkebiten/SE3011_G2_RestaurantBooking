<?php
session_start();
include 'dbconnect.php';
$uname = $_SESSION['username'];
$vname = $_GET['varname']; 
$sql = "delete from bookings where bookingId='$vname'";
$query = mysqli_query($conn, $sql);
header("location: viewMyBookings.php?varname=$uname");
?>