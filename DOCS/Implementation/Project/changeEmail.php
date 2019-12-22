<?php
include('accountsProcess.php');

$uname = $_GET['varname'];

if (!isset($_SESSION['success'])) {
    header('location:index.php');
}
?>
<html>
    <head>
        <title>Change Email</title>
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
                    <h1>Forgot Password</h1>
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


