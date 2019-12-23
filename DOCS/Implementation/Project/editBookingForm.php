<link rel="stylesheet" href="style.css"></link>
<?php
include 'dbconnect.php';
include 'editBook.php';
if (!isset($_SESSION['username'])) {
    header('location:errorPage.php');
}
$username = $_SESSION['username'];
$vname = $_GET['varname'];
$sql = "select * from bookings where bookingId='$vname'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
$r_uname = $row['restaurant_uname'];
$sql2 = "select * from restaurant_owner where uname='$r_uname'";
$query2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC);
$restName = $row2['rest_name'];
$fname = $row['fname'];
$lname = $row['lname'];
$email = $row['email'];
$date = $row['date'];
$startTime = $row['start_time'];
$endTime = $row['end_time'];
$phone = $row['phoneNo'];
$party = $row['party'];
?>
<body>
<div class="top">


    <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
    <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
    <a href ="support.php"><button id ="support"> Support</button> </a>
    <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>


</div>
<div class="container" id="fullC">
    <div id='formArea'>
        <?php include('errors.php'); ?>
        <form class='formX' method='post' action='editBookingForm.php?varname=<?php echo $vname ?>'>
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
                        <option value="06:00:00">06:00</option>
                        <option value="07:00:00">07:00</option>
                        <option value="08:00:00">08:00</option>
                        <option value="09:00:00">09:00</option>
                        <option value="10:00:00">10:00</option>
                        <option value="11:00:00">11:00</option>
                        <option value="12:00:00">12:00</option>
                        <option value="13:00:00">13:00</option>
                        <option value="14:00:00">14:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="16:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>
                        <option value="18:00:00">18:00</option>
                        <option value="19:00:00">19:00</option>
                        <option value="20:00:00">20:00</option>
                        <option value="21:00:00">21:00</option>
                        <option value="22:00:00">22:00</option>
                        <option value="23:00:00">23:00</option>
                        <option value="24:00:00">24:00</option>              
                    </select>
                </div>
                <div class="input-group">
                    <label>End Time</label>
                    <select class="input" type="time" name="endTime" required>
                        <option value="<?php echo $endTime ?>"selected hidden><?php echo $endTime ?></option>
                        <option value="06:00:00">06:00</option>
                        <option value="07:00:00">07:00</option>
                        <option value="08:00:00">08:00</option>
                        <option value="09:00:00">09:00</option>
                        <option value="10:00:00">10:00</option>
                        <option value="11:00:00">11:00</option>
                        <option value="12:00:00">12:00</option>
                        <option value="13:00:00">13:00</option>
                        <option value="14:00:00">14:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="16:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>
                        <option value="18:00:00">18:00</option>
                        <option value="19:00:00">19:00</option>
                        <option value="20:00:00">20:00</option>
                        <option value="21:00:00">21:00</option>
                        <option value="22:00:00">22:00</option>
                        <option value="23:00:00">23:00</option>
                        <option value="24:00:00">24:00</option> 
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
                <input placeholder="Your Email Address" type="email" name="email" value="<?php echo $email ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/>
            </div>
            <div class="input-group">
                <label for="phoneNo">Phone</label>
                <input class="input" type="text" placeholder="Enter Phone Number" name="phoneNo" value="<?php echo $phone ?>" ></input>
            </div>
            <a href='editBook.php?varname=<?php echo $vname ?>'><button type='submit' class='btn' name='editBooking'>Edit Booking</button></a>
        </form>   
    </div>
    <div  id="feedback">
        <?php include('feedbacks.php') ?>
        <?php if (count($feedbacks) > 0) : ?>
            <script> openFeedback();</script>
            <button onclick="window.location.href = 'viewMyBookings.php?varname=<?php echo $username ?>'" >OK</button>
        <?php endif ?>
    </div>
</div>
</body>