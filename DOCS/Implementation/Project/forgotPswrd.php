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
            <form class="formX" method="post" action="forgotPswrd.php">
                <h1>Forgot Password</h1>
                <?php include('errors.php'); ?>

                <div class="input-group">
                    <label>Email</label>
                    <input placeholder="Your Account's email address" type="email" name="email" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
                </div>

                <div class="input-group">
                    <button type="submit" class="btn" name="forgotSend">Send</button>
                </div>

            </form>
        </div>
        <div id="feedback">
            <?php include('feedbacks.php') ?>
            <?php if (count($feedbacks) > 0) : ?>
                <script> openFeedback();</script>
                <button onclick="window.location.href = 'forgotPswrd2.php'">I'M READY</button>
            <?php endif ?>
        </div>
    </div>
</body>
</html>
