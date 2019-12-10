<?php /*
  include("dbconnect.php");
  function generateRandomString($length = 8) {
  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }
  $fname = filter_input(INPUT_POST, 'fname');
  $lname = filter_input(INPUT_POST, 'lname');
  $username = filter_input(INPUT_POST, 'uname');
  $password = filter_input(INPUT_POST, 'psw');
  $email = filter_input(INPUT_POST, 'email');
  $recCode = generateRandomString();


  $query = mysqli_query($conn, "select * from user where uname='$username' or email='$email'");
  $count = mysqli_num_rows($query);
  if ($count != 0) {
  echo "<script> alert('Registration Completed.'); </script> ";
  } else {
  $password = md5($password);
  $ekle = mysqli_query($conn, "insert into user values ('$username','$fname' , '$lname' ,'$email', '$password', '$recCode')");
  header("location:returnHP.php");
  } */
?>

<?php include('loginProcess.php') ?>
<!DOCTYPE html>
<html>
    <head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
        <div class="formArea">
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
                    <input placeholder="Your Email Address" type="email" name="email" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
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
                    <button type="submit" class="btn" name="reg_user">Register</button>
                </div>
                <p>
                    Already a member? <a href="signIn.php">Sign in</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
