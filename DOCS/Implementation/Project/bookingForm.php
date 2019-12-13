<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('book.php'); ?>
<html>
    <body>
        <div class="container" id="fullC">
            <div class="formArea">
                <?php echo "<form class='formX' method='post' action='bookingForm.php?varname=$uname'>" ?>
                <h1>Booking</h1>
                <?php include('errors.php') ?>
                <div class="input-group">
                    <label for="rName">Restaurant Name</label>
                    <input class="input" type="text" value="<?php echo $rest_name ?>" placeholder="<?php echo $rest_name ?>" name="rName" readonly></input>
                </div>
                <div class="input-group">
                    <label for="date">Date</label>
                    <input onclick="dateConstraint()" class="input" id="bookingDate" type="date" name="date" value="<?php echo $date ?>" ></input>
                </div>
                <div class="input-group">
                    <label for="time">Start Time</label>
                    <input class="input" id="bookingsTime" type="time" name="startTime"></input>
                </div>
                <div class="input-group">
                    <label for="time">End Time</label>
                    <input class="input" id="bookingeTime" type="time" name="endTime"></input>
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
                <div class="input-group">
                    <?php
                    $uname = $_GET['varname'];
                    echo "<a href='book.php?varname=$uname'><button type='submit' class='btn' name='booking'>Book</button></a>"
                    ?>

                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

