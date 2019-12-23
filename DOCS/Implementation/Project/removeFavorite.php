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
    $removeFavorite = "delete from favorites where favoritesId='$id'";
    $removeFQ = mysqli_query($conn,$removeFavorite);
    header('location:userProfile.php?varname='.$_SESSION['username']);
}

