<?php
//function generateRandomString($length = 8) {
//    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
//}
//include("dbconnect.php");
//include ("guestHP.php");
//$fname = filter_input(INPUT_POST, 'fname');
//$lname = filter_input(INPUT_POST, 'lname');
//$username = filter_input(INPUT_POST, 'uname');
//$password = filter_input(INPUT_POST, 'psw');
//$email = filter_input(INPUT_POST, 'email');
//$phoneNo = filter_input(INPUT_POST, 'phone');
//$adress = filter_input(INPUT_POST, 'adress');
//$rname = filter_input(INPUT_POST, 'rname');
//$cap = filter_input(INPUT_POST, 'cap');
//$recCode = generateRandomString();
//
//
//$query = mysqli_query($conn, "select * from restaurant_owner where uname='$username'");
//$count = mysqli_num_rows($query);
//
//if (($username == "") or ( $fname == "") or ( $lname == "") or ( $password == "") or ( $email == "") or ( $rname == "")
//        or ( $adress == "") or ( $phoneNo == "")) {
//    echo "<br>Please fill the inputs";
//    exit();
//} else if ($count != 0) {
//    echo "<font size='3'>The user has already registered </font> ";
//} else {
//    $password = md5($password); 
//    $ekle = mysqli_query($conn, "insert into restaurant_owner values ('$username','$fname' , '$lname' ,'$rname', '$email', '$password', '$adress','$phoneNo' , '$cap', '$recCode')");
//
//    if ($ekle) {
//        echo "<br>Registration completed.";
//    } else {
//        echo "couldn't inserted into db";
//        exit();
//    }
//}
?>

<?php include('loginProcess.php') ?>
<!DOCTYPE html>
<html>
    <head>
    <title>Restaurant Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
    <div class="container" id="fullC">
        <div class="top">
            <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
            <a href="signUp.php"><button id="signup" >Sign Up</button></a>
            <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>      
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>
        <div class="formArea">
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
                    <input placeholder="Your Restaurant's Email Address" type="email" name="email" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
                </div>
                <div class="input-group">
                    <label>Capacity</label>
                    <input placeholder="Your Restaurant's Seat Capacity" type="number" name="rest_cap" value="<?php echo $rest_cap; ?>" required/>
                </div>
                <div class="input-group">
                    <label>Address</label>
                    <input placeholder="Your Restaurant's Location" type="text" name="rest_loc" value="<?php echo $rest_loc; ?>" required/>
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
    </div>
</body>
</html>
