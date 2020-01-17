<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
include('respondProcess.php');
if (isset($_SESSION['username'])) {
    //CHECKS IF THE USER IS ADMIN OR NOT, IF ADMIN GO TO ERROR PAGE.
    $usercheck2 = $_SESSION['username'];
    $sql3 = "select uname from admin where uname='$usercheck2'";
    $queryA = mysqli_query($conn, $sql3);
    $isAdminViewing = false;
    if (mysqli_num_rows($queryA) > 0) {
        $isAdminViewing = true;
    }
    if (!$isAdminViewing) {
        header('location:errorPage.php');
    }
} else {
    header('location:errorPage.php');
}
//END OF CHECK ADMIN
?>
<?php
//GET TICKET ID AND ACCORDING TO THAT ID, SELECT ATTRIBUTES FROM DATABASE AND FILL THEM.
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
//END OF FILLING ATTRIBUTES
?>
<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
    <title>Respond Page</title>

</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
        <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
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
                endwhile ?>
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
                endwhile ?>
                <a style="font-weight:bold;" href="notifications.php">See All</a>
            </div>
        </div>
        <a href="Admin.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
    <div id="formArea">
        <form class="formX" method="post" action="respondRequest.php?varname=<?php echo $ticketId ?>">
            <h1>Respond to Request</h1>
<?php include('errors.php'); ?>
            <h3>Category : <?php echo $category ?></h3>
            <h3>Description</h3>
            <textarea placeholder ="<?php echo $description ?>"rows="8" cols="50" class="tArea" name="description" readonly></textarea> <!-- SEE THE SUBMIT TICKET-->
            <h3>Answer</h3>
<?php if ($isResponded == 0): ?> <!-- IF IT IS NOT RESPONDED, ADD A BUTTON AND TEXTAREA-->
                <textarea rows="8" cols="50" class="tArea" name="answer" required/></textarea>
                <button type="submit" id="subsub" name="respond_request">Submit</button>
            <?php endif ?>
            <?php if ($isResponded == 1): ?> <!-- IF IT IS RESPONDED, THEN JUST SEE THE ANSWER.-->
                <textarea placeholder ="<?php echo $respond ?>"rows="8" cols="50" class="tArea" name="answer" readonly></textarea>
<?php endif ?>

        </form>

    </div>
    <div id="feedback">
        <?php include('feedbacks.php') ?>

<?php if (count($feedbacks) > 0) : ?>
            <!--        TAKES THE FEEDBACK AND GO TO SELECTED PAGE-->
            <script> openFeedback();</script>
            <button onclick="window.location.href = 'Admin.php'">OK</button>
<?php endif ?>
    </div>
</div>
</body>
</html>
