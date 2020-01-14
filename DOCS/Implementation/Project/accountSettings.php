<?php
include('accountsProcess.php');


if (!isset($_SESSION['success'])) {//REDIRECTS THE USER TO THE INDEX IF VIEWER IS A GUEST
    header('location:index.php');
}

//INITIALIZING VARIABLES AND DETERMINING THE USER TYPE
$username = $_SESSION['username']; 
$usercheck2 = $_SESSION['username'];
$sql = "select * from restaurant_owner where uname = '$usercheck2'";
$sql2 = "select uname from user where uname='$usercheck2'";
$sql3 = "select uname from admin where uname='$usercheck2'";
$query6 = mysqli_query($conn, $sql);
$queryU = mysqli_query($conn, $sql2);
$queryA = mysqli_query($conn, $sql3);
$isMyProfile = false;
$isUserViewing = false;
$isAdminViewing = false;

$isARestaurantViewing = false;

if (mysqli_num_rows($query6) > 0) {//IF VIEWER IS A RESTAURANT
    $isARestaurantViewing = true;
}
if (mysqli_num_rows($queryU) > 0) {//IF VIEWER IS A USER
    $isUserViewing = true;
}
if (mysqli_num_rows($queryA) > 0) {//IF VIEWER IS AN ADMIN
    $isAdminViewing = true;
}
if($isARestaurantViewing || $isAdminViewing){// REDIRECTS THE VIEWER TO THE ERRORPAGE IF VIEWER IS AN ADMIN OR RESTAURANT OWNER 
    header('location: errorPage.php');
}
?>
<html>
    <head>
        <title>Change Password</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="scripts.js"></script>
        <?php include('bootstrapinclude.php') ?>
    </head>


    <body>
        <div class="container" id="fullC">
            <div class="top">
                <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
                <!-- PROFILE BUTTON NAVIGATION DYNAMISM RELATED TO ACCOUNT TYPE !-->
                <?php if ($isAdminViewing): ?>
                    <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <?php endif ?>
                <?php if ($isUserViewing): ?>
                    <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <?php endif ?>
                <?php if ($isARestaurantViewing): ?>
                    <a href='restaurantProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <?php endif ?>

                <?php if (!$isAdminViewing): ?>
                    <a href ="support.php"><button id ="support"> Support</button></a>
                <?php endif ?>
                <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
            </div>
            <div id="formArea">
                <h1>ACCOUNT SETTINGS</h1>
                <div class="changePassword" id="formArea" >
                    <form class="formX1" method="post" action="accountSettings.php">
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
                    <form class="formX1" method="post" action="accountSettings.php">
                        <h1>Change Email</h1>
                        <?php include('errors.php'); ?>
                        <div class="input-group">
                            <label>Current Email</label>
                            <input placeholder="Current email" type="email" name="current_email" value="<?php echo $current_email ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
                            <br><br>
                        </div>
                        <div class="input-group">    
                            <label><b>Password</b></label>
                            <input placeholder="Your new email" type="email"  name="email_1" value="<?php echo $email_1 ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>

                        </div>
                        <div class="input-group">    
                            <label><b>Confirm Password</b></label>
                            <input placeholder="Re-enter your new Email" type="email"  name="email_2" value="<?php echo $email_2 ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
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
                    <?php $fp = false; ?>
                    <script> openFeedback();</script>
                    <button onclick="window.location.href = 'userProfile.php?varname=<?php echo $_SESSION['username']; ?>'">OK</button>
                <?php endif ?>
            </div>
        </div>
    </body>
</html>




