<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
session_start();
include('dbconnect.php');

if (!isset($_SESSION['success'])) {
    header('location:index.php');
}
?>

<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>HOMEPAGE</title>
</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <?php if (isset($_SESSION['success'])): ?>

            <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
            <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <a href ="support.php"><button id ="support"> Support</button> </a>

            <a href="notifications.php" class="notification">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <?php if ($unreadCount > 0): ?>
                    <span class = "badge"><?php echo $unreadCount;
                    ?></span>
                <?php endif ?>
            </a>

            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px;"></a>


        <?php endif ?>
    </div>
    <h1 style="color:#388CF2">YOUR NOTIFICATIONS</h1>
    <div class="myNotifications">
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

            <?php
            $whilecount++;
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

            <?php
            $whilecount++;
        endwhile
        ?>

    </div>
</body>
</html>