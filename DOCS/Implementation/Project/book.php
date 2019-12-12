<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
include('session.php');
include("dbconnect.php");

if($_SESSION['username'])

$c_username = "";
$r_username = "";
$date = "";
$startTime = "";
$endTime = "";
$phone = "";
$fname = "";
$lname = "";
$email = "";
$party = "";

if (isset($_POST['booking'])) {
    $c_username = $_SESSION['username'];
    $r_username = filter_input(INPUT_POST, 'rName');
    $date = filter_input(INPUT_POST, 'date');
    $startTime = filter_input(INPUT_POST, 'startTime');
    $endTime = filter_input(INPUT_POST, 'endTime');
    $phone = filter_input(INPUT_POST, 'phoneNo');
    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $email = filter_input(INPUT_POST, 'email');
    $party = filter_input(INPUT_POST, 'party');
}

$uname = $_GET['varname'];
$sql = "SELECT * FROM restaurant_owner WHERE uname='$uname'";
$query = mysqli_query($conn, $sql);
$restArray = mysqli_fetch_assoc($query);
$rest_name = $restArray['rest_name'];
$description = $restArray['description'];
$payment = $restArray['payment'];
$additional = $restArray['additional'];
$phoneNo = $restArray['phoneNo'];
$address = $restArray['address'];
$start = $restArray['startTime'];
$end = $restArray['endTime'];
$cap = $restArray['cap'];

//$count = mysqli_num_rows($query);
//if($count == 0) {
//    header('location:errorPage.php');
//}

$query1 = mysqli_query($conn, "SELECT * FROM bookings WHERE restaurant_uname = '$r_username' AND date = '$date'");
$array = mysqli_fetch_array($query1, MYSQLI_ASSOC);

$partySize = 0;
$i = 0;
while ($array = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
    if (strtotime($startTime) - strtotime($array['end_time']) >= 0 || strtotime($array['start_time']) - strtotime($endTime) >= 0 ) {
        unset($array['party']);
    }
    $partySize = $partySize + $array['party'];
    $i++;
}
$currentCap = $cap - $partySize;


//$query = mysqli_query($conn, "insert into bookings VALUES('$c_username', '$r_username','$party','$startTime','$endTime','$fname','$lname','$email','$phone','$date')" );
?>
<html>
    <body>
<?php
echo $partySize ." ". $currentCap;
?>
    </body>
</html>
