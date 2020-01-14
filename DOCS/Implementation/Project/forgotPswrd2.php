<?php include('loginProcess.php') ?>
<?php
//REDIRECTS THE USER TO INDEX IF THE USER ALREADY LOGGED IN
if (isset($_SESSION['success'])) {
    header('location:index.php');
}

?>
<html>
    <head>
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <script src="scripts.js"></script>
        <?php include('bootstrapinclude.php') ?>
    </head>


    <body>
    <div class="container" id="fullC">
        <div class="top">
            <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
            <a href="signUp.php"><button id="signup" >Sign Up</button></a>
            <a href="signIn.php"><button    id="signin" >Sign In</button>   </a> 
            <a href ="support.php"><button id ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>
        <div id="formArea">
            <form class="formX" method="post" action="forgotPswrd2.php">
                <h1>Forgot Password</h1>
                <?php echo $email ?>
                <?php include('errors.php'); ?>
                <div class="input-group">
                    <label>Enter your recovery code</label>
                    <input placeholder="Your Recovery Code" type="text" placeholder="Recovery Code" name="recIn" required/>
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
                    <button type="submit" class="btn" name="forgot2Send">Confirm</button>
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
