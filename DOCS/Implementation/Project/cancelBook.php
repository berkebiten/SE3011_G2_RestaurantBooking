<?php
session_start();
include 'dbconnect.php';
if(!isset($_SESSION['username'])){
	header('location:errorPage.php');
}
else{


$uname = $_SESSION['username'];
$vname = $_GET['varname']; 
$sql1 = "select * from bookings where bookingId='$vname'";
$query1 = mysqli_query($conn, $sql);
$arr1 = mysqli_fetch_arry($query1, MYSQLI_ASSOC);
if(mysqli_num_rows($arr1)>0){
	$customer_uname = $arr1['customer_uname'];
	$restaurant_uname = $arr1['customer_uname'];
	$sql = "delete from bookings where bookingId='$vname'";
$query = mysqli_query($conn, $sql);
header("location: viewMyBookings.php?varname=$uname");
}else{
	header('location:errorPage.php');
}

}
?>