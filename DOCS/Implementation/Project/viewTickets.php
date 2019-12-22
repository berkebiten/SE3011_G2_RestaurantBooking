<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
session_start();
if (!isset($_SESSION['success'])) {
    header('location:errorPage.php');
}
include("dbconnect.php");
$vname = $_GET['varname'];
$user = $_SESSION['username'];
$isMyProfile = false;
$sqlU = "select * from ticket where ticketId = $vname";
$queryU = mysqli_query($conn, $sqlU);
$arrU = mysqli_fetch_assoc($queryU);
if (($user == $arrU['user_uname']) || ($user == $arrU['rest_uname'])) {
    $isMyProfile = true;
}
if (!$isMyProfile) {
    header('location:errorPage.php');
}

$usercheck2 = $_SESSION['username'];
$sql1 = "select * from restaurant_owner where uname = '$usercheck2'";
$sql2 = "select uname from user where uname='$usercheck2'";
$sql3 = "select uname from admin where uname='$usercheck2'";
$query6 = mysqli_query($conn, $sql1);
$queryUs = mysqli_query($conn, $sql2);
$queryA = mysqli_query($conn, $sql3);
$isUserViewing = false;
$isAdminViewing = false;
$isARestaurantViewing = false;

if (mysqli_num_rows($query6) > 0) {
    $isARestaurantViewing = true;
}
if (mysqli_num_rows($queryU) > 0) {
    $isUserViewing = true;
}
if (mysqli_num_rows($queryA) > 0) {
    $isAdminViewing = true;
}
?>
<?php
$ticketId = $_GET['varname'];
$sql = "SELECT * FROM ticket WHERE ticketId='$ticketId'";
$query = mysqli_query($conn, $sql);
$ticketArray = mysqli_fetch_assoc($query);
$user_uname = $ticketArray['user_uname'];
$rest_uname = $ticketArray['rest_uname'];
$category = $ticketArray['category'];
$description = $ticketArray['description'];
$isResponded = $ticketArray['isResponded'];
$respond = $ticketArray['respond'];
$admin_uname = $ticketArray['admin_uname'];
$date = $ticketArray['date'];
$count = mysqli_num_rows($query);
if ($count == 0) {
    header('location:errorPage.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>View Tickets Page</title>

</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <a href="SignOut.php"><button  id="signout">Sign Out </button></a>

        <a href='userProfile.php?varname=<?php echo $usercheck ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
    <div id="formArea">
        <form class="formX" method="post" action="respondRequest.php?varname=<?php echo $ticketId ?>">
            <h1>My Tickets</h1>

            <h3>Category : <?php echo $category ?></h3>
            <h3>Description</h3>
            <textarea placeholder ="<?php echo $description ?>"rows="8" cols="50" class="tArea" name="description" readonly></textarea>
            <h3>Answer</h3>
            <?php if ($isResponded == 0): ?>
                <p> This Ticket has not been answered yet.</p>
            <?php endif ?>
            <?php if ($isResponded == 1): ?>
                <textarea placeholder ="<?php echo $respond ?>"rows="8" cols="50" class="tArea" name="answer" readonly></textarea>
            <?php endif ?>

        </form>

    </div>
    <div id="feedback">
        <?php include('feedbacks.php') ?>
        <?php if (count($feedbacks) > 0) : ?>
            <script> openFeedback();</script>
            <button onclick="window.location.href = 'Admin.php'">OK</button>
        <?php endif ?>
    </div>
</div>
</body>
</html>


