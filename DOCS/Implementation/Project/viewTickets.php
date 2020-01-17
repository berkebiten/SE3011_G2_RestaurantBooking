<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
session_start();
//IF THERE IS NO SESSION, ERROR PAGE.
if (!isset($_SESSION['success'])) {
    header('location:errorPage.php');
}
//END OF ERROR PAGE.
//CHECKS IF SESSION USER EQUALS TO VARNAME IF IT IS NOT GO TO ERROR PAGE.
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
//END OF SESSION=VARNAME
//CHECKS THE TYPE OF THE USER

$usercheck2 = $_SESSION['username'];
$sql1 = "select uname from restaurant_owner where uname = '$usercheck2'";
$sql2 = "select uname from user where uname='$usercheck2'";
$sql3 = "select uname from admin where uname='$usercheck2'";
$query6 = mysqli_query($conn, $sql1);
$queryU = mysqli_query($conn, $sql2);
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
    header('location:Admin.php');
}
//END OF CHECK TYPE
?>
<?php
//GETS TICKET ID, AND SELECTS ALL INFO FROM DATABASE, IF COUNT IS 0 GO TO ERROR.
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
//END OF GETTING TICKET ID
?>
<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
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
        <?php if ($isARestaurantViewing): ?>
            <a href='restaurantProfile.php?varname=<?php echo $usercheck2 ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <?php endif ?>
        <?php if ($isUserViewing): ?>
            <a href='userProfile.php?varname=<?php echo $usercheck2 ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <?php endif ?>
        <a href ="support.php"><button id ="support"> Support</button> </a>
        <div class="dropdown">
            <a href="notifications.php" class="notification">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <?php if ($unreadCount > 0): ?>
                    <span class = "badge"><?php echo $unreadCount;
                    ?></span>
                <?php endif ?>
            </a>
            <div class="dropdown-content">
                <p style="font-weight:bold;font-size:20px;"> Notifications </p>
                <?php
                $whilecount = 1;
                while ($row = mysqli_fetch_array($queryUnread, MYSQLI_ASSOC)):
                    $date_sent = $row['date_sent'];
                    $date_sent = date("m/d/y H:m", strtotime($date_sent));
                    $text = $row['text'];
                    $link = $row['link'];
                    ?>
                    <a href="notificationRedirect.php?varname=<?php echo $row['id']; ?>">

                        <div style="width:100%;" class="notificationCard">
                            <p style="color:black;font-size:12px;"><?php echo $date_sent ?></p><p><?php echo $text; ?><p><i class="fa fa-circle" aria-hidden="true"></i>
                        </div>
                    </a>

                    <?php $whilecount++;
                endwhile
                ?>
                <?php
                while ($row = mysqli_fetch_array($queryRead, MYSQLI_ASSOC)):
                    $text = $row['text'];
                    $link = $row['link'];
                    ?>
                    <a href="notificationRedirect.php?varname=<?php echo $date_sent ?>">

                        <div style="background-color:#388CF2;color:white;border-color:white;width:100%;" class="notificationCard">
                            <p style="color:white;font-size:12px;"><?php echo $row['date_sent'] ?></p><p><?php echo $text; ?><p><i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>

                    </a>

                    <?php $whilecount++;
                endwhile
                ?>
                <a style="font-weight:bold;" href="notifications.php">See All</a>
            </div>
        </div>
        <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
    <div id="formArea">
        <form class="formX" method="post" action="viewTickets.php?varname=<?php echo $ticketId ?>">
            <h1 style="color:#388CF2;">Ticket #<?php echo $_GET['varname']; ?></h1>

            <h3>Category: <?php echo $category ?></h3>
            <h3>Description</h3>
            <textarea placeholder ="<?php echo $description ?>"rows="8" cols="50" class="tArea" name="description" readonly></textarea>
            <h3>Answer</h3>
            <?php if ($isResponded == 0): ?> <!-- IF IS RESPONDED 0, MEANS THERE IS NO ANSWER-->
                <p> This Ticket has not been answered yet.</p>
            <?php endif ?>
            <?php if ($isResponded == 1): ?> <!--IF IS RESPONDED 1, MEANS THERE ARE ANSWER AND SHOWS IT.-->
                <textarea placeholder ="<?php echo $respond ?>"rows="8" cols="50" class="tArea" name="answer" readonly></textarea>
<?php endif ?>

        </form>

    </div>

</div>
</body>
</html>


