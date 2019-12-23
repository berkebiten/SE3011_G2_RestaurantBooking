<?php
include('dbconnect.php');
session_start();
$usercheck = $_SESSION['username']; //SESSION USERNAME
$sql = "select uname from user where uname='$usercheck'"; 
$query = mysqli_query($conn,$sql);
$row = mysqli_num_rows($query); 
//CHECK THE VIEWER IS USER OR NOT
if($row != 1){
    header('location:errorPage.php'); //IF VIEWER IS NOT USER REDIRECT TO ERROR PAGE
}else { //ELSE ADD TO FAVORITES THE RESTAURANT
    $id = null;
    $rest= $_GET['varname'];
    $addFavorite = "insert into favorites values('$id','$usercheck','$rest')";
    $addFQ = mysqli_query($conn,$addFavorite);
    header('location:restaurantProfile.php?varname='. $rest);
}
