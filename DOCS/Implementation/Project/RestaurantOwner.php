<!DOCTYPE html>
<link href="style.css" rel="stylesheet" ></link>
<?php include('bootstrapinclude.php') ?>
<script src="scripts.js" type="text/javascript"></script>
<?php
include('accountsProcess.php');
include("dbconnect.php");
if (!isset($_SESSION['success'])) {
    header('location: index.php');
} else {
    $username = $_SESSION['username'];
    $query = mysqli_query($conn, "select * from restaurant_owner where uname = '$username'");
    $counta = mysqli_num_rows($query);
    if ($counta != 1) {
        header("location:index.php");
    }
    $restArray = mysqli_fetch_assoc($query);
    $rest_name = $restArray['rest_name'];
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>RESTAURANT OWNER</title>
        
    </head>
    <body>
        <div class=container id="fullC">
            <div class="top">
                <?php $resta_name = $_SESSION['username']; ?>
                <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
                <a href = "restaurantProfile.php?varname=<?php echo $resta_name ?>"><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <a href ="support.php"><button id ="support"> Support</button> </a>
                <a href="RestaurantOwner.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
            </div>  
            <div class="wholepanel">
                <div class="adminpanel">
                    <ul>
                        <h1> Panel </h1>
                        <li><a onclick="openBookings()">View Bookings of My Restaurant</a></li>
                        <li><a onclick="openAccountSettings()">Account Settings</a></li>
                    </ul>
                </div>

                <div class="functions">
                    <div class="adminsearchpart" id="viewBookings">

                        <div class="old_ie_wrapper">
                            <table id="adminSearchTable">
                                <thead>
                                    <tr class="head">
                                        <th>Customer</th>
                                        <th>Party Size</th>
                                        <th>Date</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $vari = $_SESSION['username'];
                                    $query1 = mysqli_query($conn, "select * from bookings where restaurant_uname = '$vari'");



                                    while ($bookArr = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {

                                        echo "<tr> <td>" . $bookArr['customer_uname'] . "</td>"
                                        . "<td> " . $bookArr['party'] . " </td> "
                                        . "<td> " . $bookArr['date'] . "</td>"
                                        . "<td> " . $bookArr['start_time'] . "</td>"
                                        . "<td> " . $bookArr['end_time'] . " </td> "
                                        . "<td> " . $bookArr['fname'] . "</td>"
                                        . "<td> " . $bookArr['lname'] . "</td>"
                                        . "<td> " . $bookArr['phoneNo'] . "</td> </tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="adminsearchpart" id="accountSettings">

                        <div class="changePassword" id="formArea" >
                            <form class="formX1" method="post" action="RestaurantOwner.php">
                                <h1>Change Password</h1>
                                <?php include('errors.php'); ?>
                                <div class="input-group">
                                    <label>Current Password</label>
                                    <input placeholder="Current Password" type="password" name="current_password" required/>
                                    <br><br>
                                </div>
                                <div class="input-group">    
                                    <label><b>Password</b></label>
                                    <input placeholder="Your new password" type="password"  name="password_1" required/>

                                </div>
                                <div class="input-group">    
                                    <label><b>Confirm Password</b></label>
                                    <input placeholder="Re-enter your new password" type="password"  name="password_2" required/>
                                </div>
                                <div class="input-group">
                                    <button type="submit" class="btn" name="changePassword">Confirm</button>
                                </div>
                            </form>
                        </div>

                        <div class="changeEmail" id="formArea" >
                            <form class="formX1" method="post" action="RestaurantOwner.php">
                                <h1>Change Email</h1>
                                <?php include('errors.php'); ?>
                                <div class="input-group">
                                    <label>Current Email</label>
                                    <input placeholder="Current email" type="email" name="current_email" value="<?php echo $current_email ?>" pattern="[a-z0-9._%+-]+@gmail\.com$" required/>
                                    <br><br>
                                </div>
                                <div class="input-group">    
                                    <label><b>Password</b></label>
                                    <input placeholder="Your new email" type="email"  name="email_1" value="<?php echo $email_1 ?>" pattern="[a-z0-9._%+-]+@gmail\.com$" required/>

                                </div>
                                <div class="input-group">    
                                    <label><b>Confirm Password</b></label>
                                    <input placeholder="Re-enter your new Email" type="email"  name="email_2" value="<?php echo $email_2 ?>" pattern="[a-z0-9._%+-]+@gmail\.com$" required/>
                                </div>
                                <div class="input-group">
                                    <button type="submit" class="btn" name="changeEmail">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="feedback">
                        <?php include('feedbacks.php') ?>
                        <?php if (count($feedbacks) > 0) : ?>
                            <script> openFeedback();</script>
                            <button onclick="window.location.href = 'Admin.php'">OK</button>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
