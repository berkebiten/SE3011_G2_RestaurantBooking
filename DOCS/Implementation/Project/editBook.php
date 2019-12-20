<link rel="stylesheet" href="style.css"></link>
<?php
session_start();
include 'dbconnect.php';
$vname = $_GET['varname'];
$sql = "select * from bookings where bookingId='$vname'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
$r_uname = $row['restaurant_uname'];
$sql2 = "select * from restaurant_owner where uname='$r_uname'";
$query2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC);
$restName = $row2['rest_name'];
$fname= $row['fname'];
$lname= $row['lname'];
$email= $row['email'];
$date = $row['date'];
$startTime = $row['start_time'];
$endTime = $row['end_time'];
$phone = $row['phoneNo'];
$party = $row['party'];

?>
<body>
<div id='formArea'>
    <form class='formX'>
        <div class="input-group">
                <label for="rName">Restaurant Name</label>
                <input class="input" type="text" value="<?php echo $restName ?>" name="rName" readonly></input>
            </div>
            <div class="input-group">
                <label for="date">Date</label>
                <input onclick="dateConstraint()" class="input" id="bookingDate" type="date" name="date" value="<?php echo $date ?>" ></input>
            </div>
            <div class="input-group">
                <label for="time">Start Time</label>
                <input class="input" id="bookingsTime" type="time" name="startTime" value="<?php echo $startTime ?>"> </input>
            </div>
            <div class="input-group">
                <label for="time">End Time</label>
                <input class="input" id="bookingeTime" type="time" name="endTime" value="<?php echo $endTime ?>"></input>
            </div>
            <div class="input-group">
                <label for="phoneNo">Phone</label>
                <input class="input" type="text" placeholder="Enter Phone Number" name="phoneNo" value="<?php echo $phone ?>" ></input>
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
                <label for="lname">Party Size</label>
                <input class="input" type="text" placeholder="Enter Party Size" name="party" value="<?php echo $party ?>"></input>
            </div>
    </form>   
</div>
</body>