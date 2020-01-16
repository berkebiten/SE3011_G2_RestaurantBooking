<?php include('loginProcess.php') ?>
<?php if (isset($_SESSION['username'])) {//REDIRECTS THE USER TO INDEX IF THE USER ALREADY LOGGED IN
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Sign Up</title>
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
            <form class="formX" method="post" action="signUp.php">
                <h1>Sign Up</h1>
                <?php include('errors.php'); ?>
                <div class="input-group">
                    <label>First Name</label>
                    <input placeholder="Your First Name" type="text" name="fname" value="<?php echo $fname; ?>" required/>
                </div>
                <div class="input-group">
                    <label>Last Name</label>
                    <input placeholder="Your Last Name" type="text" name="lname" value="<?php echo $lname; ?>" required/>
                </div>
                <div class="input-group">
                    <label>Username</label>
                    <input placeholder="Pick a username" type="text" name="username" value="<?php echo $username; ?>" pattern= ".{6,30}" title="between 6 and 30 characters" required/>
                </div>
                <div class="input-group">
                    <label>Email</label>
                    <input placeholder="Your Email Address" type="email" name="email" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@gmail\.com$"  title="Your email must be gmail type." required/>
                                 <div class="help_text">
                    <style>
                        .fa-info-circle a{
                          color:#E0AE43;
                        }
                        .fa-info-circle a:hover{
                            color:darksalmon;
                        }
                    </style>
                    <i class="fa fa-info-circle" style="color:black;" aria-hidden="true">  Your e-mail must be gmail type. </i>
                    
                </div>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input placeholder="Enter Your Password" type="password" name="password_1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}" 
                           title="Must contain at least one number and one uppercase and lowercase letter, and between 8-50 characters" 
                           required/>
                               <div class="help_text">
                    <style>
                        .fa-info-circle a{
                          color:#E0AE43;
                        }
                        .fa-info-circle a:hover{
                            color:darksalmon;
                        }
                    </style>
                    <i class="fa fa-info-circle" style="color:black;" aria-hidden="true">  Your password must contain atleast one number and one uppercase and lowercase letter, and between 8-50 characters. </i>
                    
                </div>
                </div>
                <div class="input-group">
                    <label>Confirm password</label>
                    <input placeholder="Re-Enter Your Password" type="password" name="password_2" required/>
                </div>
                <div class="input-group">
                    <button type="submit" class="btn" name="reg_user">Register</button>
                </div>
                <p>
                    Already a member? <a href="signIn.php">Sign in</a>
                </p>
            </form>
        </div>
        <div id="feedback">
            <?php include('feedbacks.php') ?>
            <?php if (count($feedbacks) > 0) : ?>
                <script> openFeedback();</script>
                <button onclick="window.location.href='signIn.php'">OK</button>
            <?php endif ?>
        </div>
    </div>
</body>
</html>
