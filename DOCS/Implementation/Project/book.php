<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
include('session.php');
include("dbconnect.php");
$party = filter_input(INPUT_POST, 'party');
$c_username = $_SESSION['username'];
$r_username = $_SESSION['restaurant_name'];
$date = filter_input(INPUT_POST, 'date');
$startTime = filter_input(INPUT_POST, 'startTime');
$endTime = filter_input(INPUT_POST, 'endTime');
$phone =filter_input(INPUT_POST, 'phoneNo');
$fname =filter_input(INPUT_POST, 'fname');
$lname =filter_input(INPUT_POST, 'lname');
$email =filter_input(INPUT_POST, 'email');

$query1 = mysqli_query($conn, "SELECT restaurant_uname, start_time, end_time, date, party FROM bookings WHERE restaurant_uname = '$r_username' AND date = '$date'");
$array = array();
$array[] = mysqli_fetch_array($query1, MYSQLI_ASSOC);
$count = 0;

for($i = 0; $i < sizeof($array); $i++){
    echo $array[$i];
    if($array['end_time'] <= $startTime && $array['start_time'] >= $endTime){
        unset($array[$i]);
    }
}

//while($array){
//    if($array['end_time'] <= $startTime && $array['start_time'] >= $endTime){
//        
//    }
//}


$query2 = mysqli_query($conn, "SELECT * FROM bookings WHERE end_time <= $startTime OR start_time >= $endTime");

//$query = mysqli_query($conn, "insert into bookings VALUES('$c_username', '$r_username','$party','$startTime','$endTime','$fname','$lname','$email','$phone','$date')" );
  ?>


<html>
    <body>
        REZERVASYONUNUZ BASARIYLA TAMAMLANMISTIR. AFIYET OLSUN :)
    </body>
</html>