<?php
include('dbconnect.php');
session_start();
$usercheck = $_SESSION['username']; //SESSION USERNAME
$id= $_GET['varname']; //FAVORITE ID
$sql = "select * from favorites where favoritesId='$id' and customer_uname='$usercheck'";
$query = mysqli_query($conn,$sql);
$row = mysqli_num_rows($query);
//CHECK IF THE VIEWER TRY TO REMOVE HIS/HER OWN FAVORITE OR NOT
if($row != 1){
    header('location:errorPage.php'); //IF SOMEONE ELSE TRY TO REMOVE, REDIRECT TO ERROR PAGE
}else {
    $removeFavorite = "delete from favorites where favoritesId='$id'";
    $removeFQ = mysqli_query($conn,$removeFavorite);
    header('location:userProfile.php?varname='.$usercheck);
}

