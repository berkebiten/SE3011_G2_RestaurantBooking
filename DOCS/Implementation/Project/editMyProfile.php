<link rel="stylesheet" href="style.css"></link>
<?php
include 'editMyProfileProcess.php';
if (isset($_SESSION['username'])) {
    $usercheck2 = $_SESSION['username'];
    $sql3 = "select uname from restaurant_owner where uname='$usercheck2'";
    $queryR = mysqli_query($conn, $sql3);
    $isOwnerViewing = false;
    if (mysqli_num_rows($queryR) > 0) {
        $isOwnerViewing = true;
    }
    if (!$isOwnerViewing) {
        header('location:errorPage.php');
    }
}
$uname = $_GET['varname'];
$sql45 = "select * from restaurant_owner where uname='$uname'";
$query2 = mysqli_query($conn, $sql45);
$editArray = mysqli_fetch_array($query2, MYSQLI_ASSOC);
$fname = $editArray['fname'];
$lname = $editArray['lname'];
$restName = $editArray['rest_name'];
$location = $editArray['location'];
$phone = $editArray['phoneNo'];
$cap = $editArray['cap'];
$description = $editArray['description'];
$payment = $editArray['payment'];
$additional = $editArray['additional'];
$address = $editArray['address'];
$startTime = $editArray['startTime'];
$endTime = $editArray['endTime'];
$cuisines = $editArray['cuisines'];
$seating_options = $editArray['seating_options'];
$price = $editArray['price'];
$email = $editArray['email'];
?>
<body>
<div class="top">


    <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
    <a href='restaurantProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
    <a href ="support.php"><button id ="support"> Support</button> </a>
    <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>


</div>
<div class="container" id="fullC">
    <div id='formArea'>
        <?php include('errors.php'); ?>
        <form class='formX' method='post' action='editMyProfile.php?varname=<?php echo $uname ?>'>
            <div class="input-group">
                <label for="fname">First Name</label>
                <input class="input" type="text" placeholder="Enter First Name"name="fname" value="<?php echo $fname ?>"></input>
            </div>
            <div class="input-group">
                <label for="lname">Last Name</label>
                <input class="input" type="text"  placeholder="Enter Last Name"name="lname" value="<?php echo $lname ?>"></input>
            </div>
            <div class="input-group">
                <label for="rName">Restaurant Name</label>
                <input class="input" type="text" value="<?php echo $restName ?>" name="rName"></input>
            </div>
            <div class="input-group">
                <label for="location">Location</label>
                <input class="input" type="text" value="<?php echo $location ?>" name="location"></input>
            </div>
            <div class="input-group">
                <label for="phone">Phone Number</label>
                <input class="input" type="text" value="<?php echo $phone ?>" name="phone"></input>
            </div>
            <div class="input-group">
                <label for="capacity">Capacity</label>
                <input class="input" type="text" value="<?php echo $cap ?>" name="capacity"></input>
            </div>
            <div class="input-group">
                <label for="description">Description</label>
                <textarea rows="8" cols="50" class="tArea" name="description"><?php echo $description ?></textarea>
            </div>
            <div class="input-group">
                <label for="payment">Payment</label>
                <input class="input" type="text" value="<?php echo $payment ?>" name="payment"></input>
            </div>
            <div class="input-group">
                <label for="additional">Additional</label>
                <input class="input" type="text" value="<?php echo $additional ?>" name="additional"></input>
            </div>
            <div class="input-group">
                <label for="address">Address</label>
                <input class="input" type="text" value="<?php echo $address ?>" name="address"></input>
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
                <label for="cuisines">Cuisines</label>
                <input class="input" type="text" value="<?php echo $cuisines ?>" name="cuisines"></input>
            </div>
            <div class="input-group">
                <label for="seating_options">Seating Options</label>
                <input type="checkbox" name="seat1" value="Bar"/> Bar <br>
                <input type="checkbox" name="seat2" value="High Top"/> High Top <br>
                <input type="checkbox" name="seat3" value="Standart" /> Standard <br>
                <input type="checkbox" name="seat4" value="Outdoor" /> Outdoor <br>
            </div>

            <a href='editMyProfileProcess.php?varname=<?php echo $uname ?>'><button type='submit' class='btn' name='editRestaurant'>Edit</button></a>
        </form>   
    </div>
    <div  id="feedback">
        <?php include('feedbacks.php') ?>
        <?php if (count($feedbacks) > 0) : ?>
            <script> openFeedback();</script>
            <button onclick="window.location.href = 'restaurantProfile.php?varname=<?php echo $uname ?>'" >OK</button>
        <?php endif ?>
    </div>
</div>
</body>
