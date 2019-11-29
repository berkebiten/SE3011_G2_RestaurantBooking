<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<html>
    <body>
        REZERVASYONUNUZ BASARIYLA TAMAMLANMISTIR. AFIYET OLSUN :)
    </body>
</html>
<?php
include('session.php');
include("dbconnect.php");


$party = filter_input(INPUT_POST, 'party');
$c_username = $_SESSION['username'];
$r_username = filter_input(INPUT_POST, 'rName');
$date = filter_input(INPUT_POST, 'date');
$time = filter_input(INPUT_POST, 'time');
$phone =filter_input(INPUT_POST, 'phoneNo');
$fname =filter_input(INPUT_POST, 'fname');
$lname =filter_input(INPUT_POST, 'lname');
$email =filter_input(INPUT_POST, 'email');

echo $c_username;

$query = mysqli_query($conn, "insert into bookings VALUES('$c_username', '$r_username','$party','$time','$fname','$lname','$email','$phone','$date')" );
  ?>