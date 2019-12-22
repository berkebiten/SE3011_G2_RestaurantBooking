<?php
include('accountsProcess.php');
$uname = $_GET['varname'];
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
                <form class="formX" method="post" action="accountsProcess.php?varname=<?php echo $uname ?>">
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


