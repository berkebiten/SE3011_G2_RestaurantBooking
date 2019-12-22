<?php
include('accountsProcess.php');

$username = $_GET['varname'];

if (!isset($_SESSION['success'])) {
    header('location:index.php');
}

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

if (mysqli_num_rows($query6) > 0) {
    $isARestaurantViewing = true;
}
if (mysqli_num_rows($queryU) > 0) {
    $isUserViewing = true;
}
if (mysqli_num_rows($queryA) > 0) {
    $isAdminViewing = true;
}
?>
<html>
    <head>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <script src="scripts.js"></script>
    </head>


    <body>
    <div class="container" id="fullC">
        <div class="top">
            <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
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
                <a href ="support.php"><button id ="support"> Support</button> </a>
            <?php else: ?>
                <a href="accountSettings.php?varname=<?php echo $_SESSION['varname'] ?>"><button class='btn' name='accountSettings'>Account Settings</button></a>
            <?php endif ?>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>
        <div id="formArea">
            <?php echo "<a href='changePassword.php?varname=$username'><button class='btn' name='change_Password'>Change Password</button></a>" ?>
            <?php echo "<a href='changeEmail.php?varname=$username'><button class='btn' name='change_Email'>Change Email</button></a>" ?>
        </div>
        <div id="feedback">
            <?php include('feedbacks.php') ?>
            <?php if (count($feedbacks) > 0) : ?>
                <?php $fp = false; ?>
                <script> openFeedback();</script>
                <button onclick="window.location.href = 'signIn.php'">OK</button>
            <?php endif ?>
        </div>
    </div>
</body>
</html>




