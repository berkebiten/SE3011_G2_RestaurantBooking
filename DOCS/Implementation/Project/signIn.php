<?php /*
  include ("dbconnect.php");
  session_start();
  $username = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'username'));
  $passwrd = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'psw'));
  $passwrd= md5($passwrd);
  if (($username == "") or ( $passwrd == "")) {
  exit();
  } else {
  $query = mysqli_query($conn, "select * from admin where uname = '$username' and psw = '$passwrd'");
  $query2 = mysqli_query($conn, "select * from user where uname = '$username' and psw = '$passwrd'");
  $query3 = mysqli_query($conn, "select * from restaurant_owner where uname = '$username' and psw = '$passwrd'");
  $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

  $count = mysqli_num_rows($query);
  $count2 = mysqli_num_rows($query2);
  $count3 = mysqli_num_rows($query3);

  if ($count == 1) {
  $_SESSION['username'] = $username;
  header("location:Admin.php");
  } else if ($count2 == 1) {
  $_SESSION['username'] = $username;
  header("location:user.php");
  } else if ($count3 == 1) {
  $_SESSION['username'] = $username;
  header("location:RestaurantOwner.php");
  } else {
  $error = "Your Login Name or Password is invalid";
  echo $error;
  }
  }
 */ ?>
<?php include('loginProcess.php') ?>
<?php if (isset($_SESSION['username'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>

<html>
    <head>
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <div class="container" id="fullC">
        <div class="top">
            <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
            <a href="signUp.php"><button id="signup" >Sign Up</button></a>
            <a href="signIn.php"><button    id="signin" >Sign In</button></a>
            <a href ="support.php"><button id ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>
        <div class="formArea">
            <form class="formX" method="post" action="signIn.php">
                <h1>Sign In</h1>
                <?php include('errors.php'); ?>
                <div class="input-group">
                    <label>Username</label>
                    <input placeholder="Username" type="text" name="username" >
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input placeholder="Password" type="password" name="password">
                </div>
                <div class="input-group">
                    <button type="submit" class="btn" name="login_user">Sign In</button>
                </div>
                <p>
                    Not a member yet? <a href="signUp.php">Sign up</a>
                </p>
                <p>
                    <a href="forgotPswrd.php">Forgot password?</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>


