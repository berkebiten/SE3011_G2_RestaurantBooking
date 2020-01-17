<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
session_start();
include 'dbconnect.php';
//VARIABLE INITALIZING AND QUERIES FOR AUTHENTICATION
$vname = $_GET['varname'];
$user = $_SESSION['username'];
$sql = "select * from user where uname = '$vname'";
$sql2 = "select * from bookings where customer_uname = '$user'";
$sql3 = "select uname from admin where uname='$user'";
$query = mysqli_query($conn, $sql);
$query2 = mysqli_query($conn, $sql2);
$queryA = mysqli_query($conn, $sql3);
$arr = mysqli_fetch_assoc($query);
$arr2 = mysqli_fetch_assoc($query2);
$firstname = $arr['fname'];
$lastname = $arr['lname'];
$email = $arr['email'];
$isAdminViewing = false;
$isMyProfile = false;

if ($user == $vname) {
    $isMyProfile = true;
}
if (mysqli_num_rows($queryA) > 0) {
    $isAdminViewing = true;
}
//USER PROFILES CAN BE SHOWN ONLY OWNERS AND ADMINS
if (!$isMyProfile && !$isAdminViewing) {
    header('location:errorPage.php');
}

$isBanned = $arr['isBanned'];
if($isBanned == 1){
    header('location:banned.php');
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
    <title>PROFILE</title>

</head>
<body>
<div class="container">
    <div class="top">
        <!--    APPROPRIATE HEADER FOR THE VIEWER-->
        <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
        <?php if ($isAdminViewing): ?> 
            <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <?php else: ?>
            <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <?php endif ?>
        <?php if (!$isAdminViewing): ?>
            <a href ="support.php"><button id ="support"> Support</button> </a>
        <?php endif ?>
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

                        <?php $whilecount++; endwhile?>
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

                        <?php $whilecount++; endwhile ?>
                    <a style="font-weight:bold;" href="notifications.php">See All</a>
                </div>
            </div>
        <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>   
    </div>

    <div id="fullProfile">
        <div id='profileButtons'>
            <?php if ($isAdminViewing): //IF THE ADMIN VIEWS THE PAGE SHOW THE BAN AND WARN BUTTONS?>
                <?php echo "<a href='banWarnForm.php?varname=$vname'><button>Ban/Warn User</button></a>" ?>
            <?php else: ?>
                <a href="accountSettings.php"<button>Account Settings</button></a>
            <?php endif ?>
        </div>
        <div id="personalInfos">
            <!--        PRINT THE USER'S INFORMATIONS-->
            <p><?php echo $vname ?></p>
            <p>First Name: <?php echo $firstname ?> </p>
            <p>Last Name: <?php echo $lastname ?></p>
            <p>Email: <?php echo $email ?></p>
        </div>
        
        <div class='stats' id="favRest">
            <h4>Favorite Restaurants</h4>
            <table id="userProfileTable">
                <thead>
                    <tr class="head">
                        <th style="width:70%;">Restaurant Name</th>
                        <th style="width:30%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //PRINT THE FAVORITE RESTAURANTS OF THE USER
                    $sqlF = "select * from favorites where customer_uname= '$vname'";
                    $queryF = mysqli_query($conn, $sqlF);
                    while ($row = mysqli_fetch_array($queryF, MYSQLI_ASSOC)) {
                        $rest = $row['rest_uname'];
                        $favId = $row['favoritesId'];
                        $sqlRESTNAME = "select * from restaurant_owner where uname='$rest'";
                        $queryRESTNAME = mysqli_query($conn, $sqlRESTNAME);
                        $row2 = mysqli_fetch_array($queryRESTNAME, MYSQLI_ASSOC);
                        if (!$isAdminViewing) { //IF THE PROFILE OWNER VIEWS THE PAGE SHOW THE REMOVE BUTTON
                            echo" <tr> <td>  <a href='restaurantProfile.php?varname=$rest'>" . $row2['rest_name'] . "</a> </td>"
                            . " <td> <a href='removeFavorite.php?varname=$favId'><button>Remove</button></a> </td></tr> ";
                        } else {//IF THE ADMIN VIEWS THE PAGE SHOW THE ONLY RESTAURANT NAME
                            echo" <tr> <td>  <a href='restaurantProfile.php?varname=$rest'>" . $row2['rest_name'] . "</a> </td> <td></td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class='stats' id="bookings">
            <h4>Upcoming Bookings</h4>
            <?php if ($isMyProfile): ?>
                <a style ="float:right; margin-right:6%;" href='viewMyBookings.php?varname=<?php echo $vname ?>'>See all bookings</a><br>
            <?php endif ?> 
            <table id="userProfileTable">
                <thead>
                    <tr class="head">
                        <th style="width:40%;">Restaurant Name</th>
                        <th style="width:40%;">Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //PRINT THE UPCOMING BOOKINGS
                    $date = date("Y-m-d");
                    $time = date("H:i:s");
                    $time2 = date("H:i:s", strtotime('+4 hours', strtotime($time)));
                    $sqlB = "select * from bookings where customer_uname= '$vname' and date>='$date'"; //DATE OF THE BOOKING MUST BE AFTER THE CURRENT TIME
                    $queryB = mysqli_query($conn, $sqlB);
                    while ($row = mysqli_fetch_array($queryB, MYSQLI_ASSOC)) {
                        $id = $row['bookingId'];
                        $rest_uname = $row['restaurant_uname'];
                        $sqlR = "select * from restaurant_owner where uname='$rest_uname'";
                        $restName = mysqli_query($conn, $sqlR);
                        $rowR = mysqli_fetch_array($restName, MYSQLI_ASSOC);
                        if (!$isAdminViewing) { //IF THE PROFILE OWNER VIEWS THE PAGE SHOW THE EDIT AND CANCEL BUTTONS
                            if (($date == $row['date'] && $time2 < $row['start_time']) || $date < $row['date']) {
                                echo "<tr> <td>" . $rowR['rest_name'] . "</td>"
                                . "<td> " . $row['date'] . " </td> <td>  <a href='editBookingForm.php?varname=$id'><button>Edit</button></a> "
                                . "<br><br><button onclick=\"if (confirm('Are you sure want to cancel your booking?')) window.location.href='cancelBook.php?varname=$id';\">Cancel</button></td></tr>";
                            }
                        } else { //IF THE ADMIN VIEWS THE PAGE SHOW THE ONLY RESTAURANT NAME AND DATE
                            if (($date == $row['date'] && $time < $row['start_time']) || $date < $row['date']) {
                                echo "<tr> <td>" . $rowR['rest_name'] . "</td>"
                                . "<td> " . $row['date'] . " </td> <td> </tr>";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div> 
</div>
</body>