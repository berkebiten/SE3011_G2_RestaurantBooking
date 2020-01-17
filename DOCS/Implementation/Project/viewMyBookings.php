<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
session_start();
include ('dbconnect.php');
//INITIALIZING VARIABLES
$vname = $_GET['varname'];
$user = $_SESSION['username'];
$isMyProfile = false;

//IF ITS NOT VIEWER'S PROFILE REDIRECT  TO ERROR PAGE
if ($user == $vname) {
    $isMyProfile = true;
}
if (!$isMyProfile) {
    header('location:errorPage.php');
}
?>
<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
}
?>
<body>
    <!--    APPROPRIATE HEADER FOR THE USER-->
<div class="container">
    <div class="top">
        <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
        <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
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
        <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>   
    </div>
    <div id='formArea'>
        <table id="userProfileTable">
            <thead>
                <tr class="head">
                    <th style="width:50%;">Restaurant Name</th>
                    <th style="width:40%;">Date</th>
                    <th style="width:40%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $date = date("Y-m-d"); //CHANGE THE DATE FORMAT FOR THE COMPARISON 
                $time = date("H:i:s"); //CHANGE THE TIME FORMAT FOR THE COMPARISON 
                $time2 = date("H:i:s", strtotime('+4 hours', strtotime($time)));
                $sqlB = "select * from bookings where customer_uname= '$vname'"; //FIND THE USER'S BOOKINGS
                $queryB = mysqli_query($conn, $sqlB);
                while ($row = mysqli_fetch_array($queryB, MYSQLI_ASSOC)) {
                    $rest_uname = $row['restaurant_uname'];
                    $sqlR = "select * from restaurant_owner where uname='$rest_uname'";
                    $restName = mysqli_query($conn, $sqlR);
                    $rowR = mysqli_fetch_array($restName, MYSQLI_ASSOC);
                    $id = $row['bookingId'];
                    if (($date == $row['date'] && $time2 < $row['start_time']) || $date < $row['date']) { //IF THE BOOKING IS NOT FINISHED SHOW THE EDIT AND CANCEL BUTTONS
                        echo "<tr> <td>" . $rowR['rest_name'] . "</td>"
                        . "<td> " . $row['date'] . " </td> <td> <a href='editBookingForm.php?varname=$id'><button>Edit</button></a> "
                        . "<br><br><button onclick=\"if (confirm('Are you sure want to cancel your booking?')) window.location.href='cancelBook.php?varname=$id';\">Cancel</button></td></tr>";
                    } else if (($date == $row['date'] && $time > $row['end_time']) || $date > $row['date']) {
                        echo "<tr> <td>" . $rowR['rest_name'] . "</td>" ////IF THE BOOKING IS FINISHED SHOW THE REVIEW BUTTON
                        . "<td> " . $row['date'] . " </td><td> <a href='reviewBooking.php?varname=$id'><button>Review</button> </a></td></tr>";
                    } else {
                        echo "<tr> <td>" . $rowR['rest_name'] . "</td>" ////IF THE BOOKING IS FINISHED SHOW THE REVIEW BUTTON
                        . "<td> " . $row['date'] . " </td><td></td> </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!--SHOW THE FEEDBACK-->
    <div id="feedback">
<?php include('feedbacks.php') ?>
        <?php if (count($feedbacks) > 0) : ?>
            <script> openFeedback();</script>
            <button onclick="window.location.href = 'cancelBooking.php?varname=<?php $id ?>'">OK</button>
<?php endif ?>
    </div>
</div>
</body>
