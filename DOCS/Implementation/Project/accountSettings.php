<?php
include('accountsProcess.php');

$username = $_GET['varname'];

if (!isset($_SESSION['success'])) {
    header('location:index.php');
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
                <a href='userProfile.php?varname=<?php echo $usercheck ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <a href ="support.php"><button id ="support"> Support</button> </a>
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




