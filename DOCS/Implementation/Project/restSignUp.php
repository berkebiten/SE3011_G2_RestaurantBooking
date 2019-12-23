<?php

?>

<?php include('loginProcess.php') ?>
<?php
if (isset($_SESSION['username'])) {//REDIRECTS THE USER TO INDEX IF THE USER ALREADY LOGGED IN
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Restaurant Sign Up</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="scripts.js"></script>
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
                <form class="formX" method="post" action="restSignUp.php">
                    <h1>Restaurant Sign Up</h1>
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
                        <label>Restaurant Name</label>
                        <input placeholder="Your Restaurant's Name" type="text" name="rest_name" value="<?php echo $rest_name; ?>" required/>
                    </div>
                    <div class="input-group">
                        <label>Email</label>
                        <input placeholder="Your Restaurant's Email Address" type="email" name="email" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@gmail\.com$" required/>
                    </div>
                    <div class="input-group">
                        <label>Capacity</label>
                        <input placeholder="Your Restaurant's Seat Capacity" type="number" name="rest_cap" value="<?php echo $rest_cap; ?>" required/>
                    </div>
                    <div class="input-group">
                        <label>Location</label>
                        <input placeholder="Your Restaurant's Location" type="text" name="rest_loc" value="<?php echo $rest_loc; ?>" required/>
                    </div>
                    <div class="input-group">
                        <label>Address</label>
                        <input placeholder="Your Restaurant's Address" type="text" name="rest_address" value="<?php echo $rest_address; ?>" required/>
                    </div>
                    <div class="input-group">
                        <label>Opening Time</label>
                        <select class="input" type="time" name="rest_start" value="<?php $rest_start ?>" required>
                            <option value="06:00:00">06:00</option>
                            <option value="07:00:00">07:00</option>
                            <option value="08:00:00">08:00</option>
                            <option value="09:00:00">09:00</option>
                            <option value="10:00:00">10:00</option>
                            <option value="11:00:00">11:00</option>
                            <option value="12:00:00">12:00</option>
                            <option value="13:00:00">13:00</option>
                            <option value="14:00:00">14:00</option>
                            <option value="15:00:00">15:00</option>
                            <option value="16:00:00">16:00</option>
                            <option value="17:00:00">17:00</option>
                            <option value="18:00:00">18:00</option>
                            <option value="19:00:00">19:00</option>
                            <option value="20:00:00">20:00</option>
                            <option value="21:00:00">21:00</option>
                            <option value="22:00:00">22:00</option>
                            <option value="23:00:00">23:00</option>
                            <option value="24:00:00">24:00</option>              
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Closing Time</label>
                        <select class="input" type="time" name="rest_end" value="<?php $rest_end ?>" required>
                            <option value="06:00:00">06:00</option>
                            <option value="07:00:00">07:00</option>
                            <option value="08:00:00">08:00</option>
                            <option value="09:00:00">09:00</option>
                            <option value="10:00:00">10:00</option>
                            <option value="11:00:00">11:00</option>
                            <option value="12:00:00">12:00</option>
                            <option value="13:00:00">13:00</option>
                            <option value="14:00:00">14:00</option>
                            <option value="15:00:00">15:00</option>
                            <option value="16:00:00">16:00</option>
                            <option value="17:00:00">17:00</option>
                            <option value="18:00:00">18:00</option>
                            <option value="19:00:00">19:00</option>
                            <option value="20:00:00">20:00</option>
                            <option value="21:00:00">21:00</option>
                            <option value="22:00:00">22:00</option>
                            <option value="23:00:00">23:00</option>
                            <option value="24:00:00">24:00</option> 
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Phone Number</label>
                        <input placeholder="Your Restaurant's Phone Number" type="text" name="rest_phone" value="<?php echo $rest_phone; ?>" required/>
                    </div>
                    <div class="input-group">
                        <label>Password</label>
                        <input placeholder="Enter Your Password" type="password" name="password_1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}" 
                               title="Must contain at least one number and one uppercase and lowercase letter, and between 8-50 characters" 
                               required/>
                    </div>
                    <div class="input-group">
                        <label>Confirm password</label>
                        <input placeholder="Re-Enter Your Password" type="password" name="password_2" required/>
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn" name="reg_rest">Register</button>
                    </div>
                    <p>
                        Already a member? <a href="signIn.php">Sign in</a>
                    </p>
                </form>
            </div>
            <div  id="feedback">
                <?php include('feedbacks.php') ?>
                <?php if (count($feedbacks) > 0) : ?>
                    <script> openFeedback();</script>
                    <button onclick="window.location.href = 'signIn.php'" >OK</button>
                <?php endif ?>
            </div>
        </div>
    </body>
</html>
