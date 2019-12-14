<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
session_start(); 
include("dbconnect.php");

if ($_SESSION['username'])
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
$errors = array();

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

    if (empty($fname)) {
        array_push($errors, "First Name is required");
    }
    if (empty($lname)) {
        array_push($errors, "Last Name is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($startTime)) {
        array_push($errors, "Start time is required");
    }
    if (empty($endTime)) {
        array_push($errors, "End time is required");
    }
    if (empty($party)) {
        array_push($errors, "Party size is required");
    }
    if (empty($phone)) {
        array_push($errors, "Phone number is required");
    }
    if (empty($date)) {
        array_push($errors, "Booking date is required");
    }
    

    $query1 = mysqli_query($conn, "SELECT * FROM bookings WHERE restaurant_uname = '$r_username' AND date = '$date'");

    $partySize = 0;
    $i = 0;
    while ($array = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
        if (!(strtotime($startTime) - strtotime($array['end_time']) >= 0 || strtotime($array['start_time']) - strtotime($endTime) >= 0)) {
            $partySize = $partySize + $array['party'];
        }
    }
    $currentCap = $cap - $partySize;


    if ($currentCap >= $party && count($errors) == 0) {
        $query = mysqli_query($conn, "insert into bookings VALUES('$bookingId', '$c_username', '$r_username','$party','$startTime','$endTime','$fname','$lname','$email','$phone','$date')");
        echo "<script> alert('Your reservation is completed.'); </script>";
        header('location:user.php');
    } else {
        array_push($errors, "There are no capacity in the restaurant that meets your party size at the selected hours.");
    }
}
?>
