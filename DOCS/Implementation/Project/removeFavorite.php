<?php
include('dbconnect.php');
session_start();
$usercheck = $_SESSION['username'];
$sql = "select uname from user where uname='$usercheck'";
$query = mysqli_query($conn,$sql);
$row = mysqli_num_rows($query);
if($row != 1){
    header('location:errorPage.php');
}else {
    $id= $_GET['varname'];
    $removeFavorite = "delete from favorites where favoriteId='$id')";

    $addFQ = mysqli_query($conn,$addFavorite);
    header('location:restaurantProfile.php?varname='. $rest);
}