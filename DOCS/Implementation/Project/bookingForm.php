<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
include('book.php');

if (!isset($_SESSION['username'])) {
    header('location:signIn.php');
} else {
    $viewerUsername = $_SESSION['username'];
    $sql_rest = "SELECT * FROM restaurant_owner WHERE uname='$viewerUsername'";
    $sql_ad = "SELECT * FROM admin WHERE uname='$viewerUsername'";
    $query_rest = mysqli_query($conn, $sql_rest);
    $query_ad = mysqli_query($conn, $sql_ad);
    if (mysqli_num_rows($query_rest) > 0 || mysqli_num_rows($query_ad) > 0) {
        header('location:index.php');
    }
}

$uname = $_GET['varname'];
$sql = "SELECT * FROM restaurant_owner WHERE uname='$uname'";
$query = mysqli_query($conn, $sql);
$restArray = mysqli_fetch_assoc($query);
$start = $restArray['startTime'];
$end = $restArray['endTime'];
?>

<html>
    <body>
        <div class="container" id="fullC">
            <div class="top">
                <?php if (isset($_SESSION['success'])): ?>

                    <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
                    <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                    <a href ="support.php"><button id ="support"> Support</button> </a>
                    <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>

                <?php endif ?>
                <?php if (!isset($_SESSION['success'])): ?>

                    <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
                    <a href="signUp.php"><button id="signup" >Sign Up</button></a>
                    <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>
                    <a href ="support.php"><button class ="support"> Support</button> </a>
                    <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>

                <?php endif ?>
            </div>
            <div id="formArea">
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
                    <select class="input" id="bookingsTime" type="time" name="startTime" >
                        <?php
                        $start_time = $start;
                        $end_time = $end;
                        while (strtotime($start_time) <= strtotime($end_time)) {
                            echo "<option value=" . $start_time . ">" . $start_time . "</option>";
                            $start_time = date("H:i:s", strtotime('+1 hour', strtotime($start_time)));
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group">
                    <label for="time">End Time</label>
                    <select class="input" id="bookingsTime" type="time" name="endTime" >
                        <?php
                        $start_time1 = $start;
                        $end_time1 = $end;
                        while (strtotime($start_time1) <= strtotime($end_time1)) {
                            echo "<option value=" . $start_time1 . ">" . $start_time1 . "</option>";
                            $start_time1 = date("H:i:s", strtotime('+1 hour', strtotime($start_time1)));
                        }
                        ?>
                    </select>
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
                    echo "<a href='book.php?varname=$uname'><button type='submit' class='btn' name='booking'>Book</button></a>";
                    ?>
                </div>
                </form>

            </div>
            <div id="feedback">
                <?php include('feedbacks.php') ?>
                <?php if (count($feedbacks) > 0) : ?>
                    <script> openFeedback();</script>
                    <button onclick="window.location.href = 'viewMyBookings.php?varname=<?php echo $_SESSION['username'] ?>'">OK</button>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>