<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
session_start();
include("dbconnect.php");
$feedbacks = array();
$errors = array();
//$count = mysqli_num_rows($query);
//if($count == 0) {
//    header('location:errorPage.php');
//}

if (isset($_POST['editRestaurant'])) { //STARTS WHEN PRESSING EDIT BUTTON
    //GETS THE USERNAME AND GETS THE FULL ATTRIBUTES AND ADD THEM TO VARIABLES
    $uname = $_SESSION['username'];
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $rest_name = mysqli_real_escape_string($conn, $_POST['rName']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);
    $additional = mysqli_real_escape_string($conn, $_POST['additional']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $startTime = filter_input(INPUT_POST, 'startTime');
    $endTime = filter_input(INPUT_POST, 'endTime');
    //END OF ADDING
    
    $cuisinesarray = array();
    if (isset($_POST['filter'])) { // CHECKS IF THE CHECKBOX NAMED FILTER ARE FULL OR NOT.
        $cuisines = $_POST['filter'];
        foreach ($_POST['filter'] as $cuisines) {
            $cuisinearray[] = $cuisines ;
        }
        $cuisines = implode(", ", $cuisinearray);
    }
//CHECKS IF THE CHECKBOX NAMED filter1 ARE FULL OR NOT.
    $seatingarray = array();
    if (isset($_POST['filter1'])) { 
        $seating = $_POST['filter1'];
        foreach ($_POST['filter1'] as $seating) {
            $seatingarray[] = $seating;
        }
        $seatingOptions = implode(", ", $seatingarray);
    }
    //END OF CHECKING
    
//CHECKS IF THE AREAS ARE EMPTY OR NOT

    if (empty($fname)) {
        array_push($errors, "First Name is required");
    }
    if (empty($lname)) {
        array_push($errors, "Last Name is required");
    }
    if (empty($rest_name)) {
        array_push($errors, "Restaurant Name is required");
    }
    if (empty($location)) {
        array_push($errors, "Location is required");
    }
    if (empty($phone)) {
        array_push($errors, "Phone is required");
    }
    if (empty($capacity)) {
        array_push($errors, "Capacity is required. ");
    }
    if (empty($description)) {
        array_push($errors, "Description is required");
    }
    if (empty($payment)) {
        array_push($errors, "Payment is required");
    }
    if (empty($additional)) {
        array_push($errors, "Additional is required");
    }
    if (empty($address)) {
        array_push($errors, "Address is required");
    }
    if (empty($startTime)) {
        array_push($errors, "Start time is required");
    }
    if (empty($endTime)) {
        array_push($errors, "End time is required");
    }
    if (empty($cuisines)) {
        array_push($errors, "Cuisine is required");
    }
    if (empty($seatingOptions)) {
        array_push($errors, "Seating option is required");
    }
    //END OF CHECKING AREAS


//IF THERE IS NO ERROR, UPDATE RESTAURANTOWNER INFORMATIONS AND THEN SHOW FEEDBACK
    if (count($errors) == 0) {
        $uname = $_SESSION['username'];
        $queryEdit = "UPDATE restaurant_owner SET fname='$fname', lname='$lname', rest_name='$rest_name', location='$location', phoneNo='$phone', cap='$capacity', description='$description', payment='$payment', additional='$additional', address ='$address', startTime='$startTime', endTime='$endTime', cuisines='$cuisines', seating_options='$seatingOptions' WHERE uname='$uname' ";
        mysqli_query($conn, $queryEdit);
        array_push($feedbacks, "Your restaurant has been editted.");
        array_push($feedbacks, "You will be redirected to Restaurant Page when you click 'OK' button.");
    } else {
        array_push($errors, "Something wrong with the edit.");
    }
}
?>

