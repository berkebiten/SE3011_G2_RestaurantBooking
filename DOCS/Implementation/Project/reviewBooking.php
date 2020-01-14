<link rel="stylesheet" href="style.css"></link>
<?php include('bootstrapinclude.php') ?>
<script src="scripts.js"></script>
<?php
session_start();
include 'dbconnect.php';
$bookId = $_GET['varname'];
$user = $_SESSION['username'];
$sql = "select * from bookings where bookingId='$bookId'";
$query = mysqli_query($conn, $sql);
$arr = mysqli_fetch_assoc($query);
$isMyProfile = false;
$restUname = $arr['restaurant_uname'];
$sqlRest = "select rest_name, location from restaurant_owner where uname = '$restUname' ";
$queryRest = mysqli_query($conn, $sqlRest);
$restArr = mysqli_fetch_assoc($queryRest);




if ($arr['customer_uname'] == $user) {
    $isMyBooking = true;
}
if (!$isMyBooking) {
    header('location:errorPage.php');
}
?>
<?php include('dropReview.php') ?>
<html>
    <head>
    <title>Drop a Review</title>
</head>
<body>
<div class="container" id="fullC">
    <div class="top">
        <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
        <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <a href ="support.php"><button id ="support"> Support</button> </a>
        <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>   
    </div>

    <div id="formArea">
        <form class="formX" method="post" action="reviewBooking.php?varname=<?php echo $bookId ?>">
            <h1>Drop a Review</h1>
            <p> This review will be about this past booking of yours: </p>
            <div class='bookInfo'>
                <p><?php
                    echo "Date: " . $arr['date'] . "<br>"
                    . "Restaurant Name: " . $restArr['rest_name'] . "<br>"
                    . "Location: " . $restArr['location'] . "<br>"
                    . "Time Interval: " . $arr['start_time'] . " - " . $arr['end_time'] . "<br>"
                    . "Party Size: " . $arr['party'] . "<br>"
                    ?></p>
            </div>

            <?php include('errors.php'); ?>

            <label>Rate this restaurant</label>
            <select class="select-css" name ="starRate" required>
                <option>Bad</option>
                <option>Average</option>
                <option>Good</option>
            </select>
            <label>Rate this restaurant's prices</label>
            <select class="select-css" name ="priceRate" required>
                <option>Cheap</option>
                <option>Average</option>
                <option>Expensive</option>
            </select>
            <label>Your review:</label>
            <textarea placeholder="Your review text.." class="tArea" rows="8" cols="50" name="text" required></textarea>
            <br></br>
            <button type="submit" class="btn" name="drop_review">Submit</button>

        </form>
    </div>
    <div  id="feedback">
        <?php include('feedbacks.php') ?>
        <?php if (count($feedbacks) > 0) : ?>
            <script> openFeedback();</script>
            <button onclick="window.location.href = 'viewMyBookings.php?varname=<?php echo $_SESSION['username'] ?>'">OK</button>
        <?php endif ?>
    </div>
</div>
</body>