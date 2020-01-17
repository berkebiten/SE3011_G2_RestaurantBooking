<link rel="stylesheet" href="style.css"></link>
<?php include('bootstrapinclude.php') ?>
<?php
include 'dbconnect.php';
include 'editBook.php';
//IF SESSION IS NOT EXIST REDIRECT TO ERROR PAGE
if (!isset($_SESSION['username'])) {
    header('location:errorPage.php');
}
$username = $_SESSION['username'];
$vname = $_GET['varname'];
$sql = "select * from bookings where bookingId='$vname'"; //FIND THE BOOKING
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
$r_uname = $row['restaurant_uname'];
$sql2 = "select * from restaurant_owner where uname='$r_uname'"; //FIND THE RESTAURANT
$query2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC);
//PULL THE BOOKING'S AND RESTAURANT'S INFORMATIONS 
$restName = $row2['rest_name'];
$fname = $row['fname'];
$lname = $row['lname'];
$email = $row['email'];
$date = $row['date'];
$startTime = $row['start_time'];
$endTime = $row['end_time'];
$phone = $row['phoneNo'];
$party = $row['party'];
$restStartTime = $row2['startTime'];
$restEndTime = $row2['endTime'];
?>
<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
}
?>
<body>
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
    <div class="container" id="fullC">
        <div id='formArea'>

            <form class='formX' method='post' action='editBookingForm.php?varname=<?php echo $vname ?>'>
                <h1>Edit Booking</h1>
<?php include('errors.php'); ?>
                <div class="input-group">
                    <label for="rName">Restaurant Name</label>
                    <input class="input" type="text" value="<?php echo $restName ?>" name="rName" readonly></input>
                </div>
                <div class="input-group">
                    <label for="date">Date</label>
                    <input onclick="dateConstraint()" class="input" id="bookingDate" type="date" name="date" value="<?php echo $date ?>" ></input>
                </div>
                <div class="input-group">
                    <label>Start Time</label>
                    <select class="input" type="time" name="startTime" required>
                        <option value="<?php echo $startTime ?>" selected hidden><?php echo $startTime ?></option>
                        <?php
                        //LIST THE STARTING TIMES THAT USER CAN CHOOSE ACCORDING TO RESTAURANT OPERATION OF HOURS
                        $start_time = $restStartTime;
                        $end_time = $restEndTime;
                        while (strtotime($start_time) < strtotime($end_time)) {
                            if (strtotime($start_time) === strtotime("23:59:00")) {
                                echo "<option value=" . $start_time . ">" . "24:00:00" . "</option>";
                            } else {
                                echo "<option value=" . $start_time . ">" . $start_time . "</option>";
                            }

                            if (strtotime($start_time) === strtotime("23:59:00")) {
                                break;
                            } else if (strtotime($start_time) === strtotime("23:00:00")) {
                                $start_time = date("H:i:s", strtotime('+59 minutes', strtotime($start_time)));
                            } else {
                                $start_time = date("H:i:s", strtotime('+1 hour', strtotime($start_time)));
                            }
                        }
                        ?>              
                    </select>
                </div>
                <div class="input-group">
                    <label>End Time</label>
                    <select class="input" type="time" name="endTime" required>
                        <option value="<?php echo $endTime ?>"selected hidden><?php echo $endTime ?></option>
                        <?php
                        //LIST THE END TIMES THAT USER CAN CHOOSE ACCORDING TO RESTAURANT OPERATION OF HOURS
                        $start_time2 = date("H:i:s", strtotime('+1 hour', strtotime($restStartTime)));
                        $end_time2 = $restEndTime;
                        while (strtotime($start_time2) <= strtotime($end_time2)) {

                            if (strtotime($start_time2) === strtotime("23:59:00")) {
                                echo "<option value=" . $start_time2 . ">" . "24:00:00" . "</option>";
                            } else {
                                echo "<option value=" . $start_time2 . ">" . $start_time2 . "</option>";
                            }

                            if (strtotime($start_time2) === strtotime("23:59:00")) {
                                break;
                            } else if (strtotime($start_time2) === strtotime("23:00:00")) {
                                $start_time2 = date("H:i:s", strtotime('+59 minutes', strtotime($start_time2)));
                            } else {
                                $start_time2 = date("H:i:s", strtotime('+1 hour', strtotime($start_time2)));
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group">
                    <label for="lname">Party Size</label>
                    <input class="input" type="text" placeholder="Enter Party Size" name="party" value="<?php echo $party ?>"></input>
                </div>
                <div class="input-group">
                    <label for="fname">First Name</label>
                    <input class="input" type="text" placeholder="Enter First Name"name="fname" value="<?php echo $fname ?>"></input>
                </div>
                <div class="input-group">
                    <label for="lname">Last Name</label>
                    <input class="input" type="text"  placeholder="Enter Last Name"name="lname" value="<?php echo $lname ?>"></input>
                </div>
                <div class="input-group">
                    <label>Email</label>
                    <input placeholder="Your Email Address" type="email" name="email" value="<?php echo $email ?>" pattern="[a-z0-9._%+-]+@gmail\.com$" title="Your email must be gmail type." />
                    <div class="help_text">
                        <style>
                            .fa-info-circle a{
                                color:#E0AE43;
                            }
                            .fa-info-circle a:hover{
                                color:darksalmon;
                            }
                        </style>
                        <i class="fa fa-info-circle" style="color:black;" aria-hidden="true">  Your e-mail must be gmail type. </i>

                    </div>
                </div>
                <div class="input-group">
                    <label for="phoneNo">Phone</label>
                    <input class="input" type="tel" placeholder="Enter Phone Number" name="phoneNo" value="<?php echo $phone ?>" pattern="[0-9]{10}"></input>
                    <div class="help_text">
                        <style>
                            .fa-info-circle a{
                                color:#E0AE43;
                            }
                            .fa-info-circle a:hover{
                                color:darksalmon;
                            }
                        </style>
                        <i class="fa fa-info-circle" style="color:black;" aria-hidden="true">  Write your phone number without zero(0) at the beginning and spaces. Ex: 5354023791 </i>

                    </div>
                </div>
                <a href='editBook.php?varname=<?php echo $vname ?>'><button type='submit' class='btn' name='editBooking'>Edit Booking</button></a>
            </form>   
        </div>
        <!--    FEEDBACK-->
        <div  id="feedback">
<?php include('feedbacks.php') ?>
            <?php if (count($feedbacks) > 0) : ?>
                <script> openFeedback();</script>
                <button onclick="window.location.href = 'viewMyBookings.php?varname=<?php echo $username ?>'" >OK</button>
<?php endif ?>
        </div>
    </div>
</div>
</body>