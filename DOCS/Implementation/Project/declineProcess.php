<?php
include('dbconnect.php');
$uname = $_GET['varname'];
$query1 = "DELETE FROM rest_signup WHERE username='$uname'";
$boolean = mysqli_query($conn, $query1);

if($boolean){
    echo "<script> alert('The register is deleted.'); </script> "; 
}

