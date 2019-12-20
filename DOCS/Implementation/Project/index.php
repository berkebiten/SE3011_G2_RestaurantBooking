<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
session_start();
include('dbconnect.php');
if (isset($_SESSION['username'])) {
    $usercheck = $_SESSION['username'];
    $sql = "select * from restaurant_owner where uname = '$usercheck'";
    $query = mysqli_query($conn, $sql);
    $sql2 = "select * from admin where uname = '$usercheck'";
    $query2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($query2) > 0) {
        header('location:Admin.php');
    }
    if (mysqli_num_rows($query) > 0) {
        header('location:RestaurantOwner.php');
    }
}
?>


<html>
    <head>
        <meta charset="UTF-8">
    <title>HOMEPAGE</title>
</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <?php if (isset($_SESSION['success'])): ?>

            <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
            <a href='userProfile.php?varname=<?php echo $_SESSION['username']?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <a href ="support.php"><button id ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>

        <?php endif ?>
        <?php if (!isset($_SESSION['success'])): ?>

            <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
            <a href="signUp.php"><button id="signup" >Sign Up</button></a>
            <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>
            <a href ="support.php"><button class ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>

        <?php endif ?>
    </div>
    <h1>FIND YOUR RESTAURANT</h1>

    <div  class="searchpart">
        <form class="searchForm" action="searchResultGuest.php" method="post">
<!--            <select class="searchinputs" required>
                <option value="0"> Party Size </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <input onclick="dateConstraint()" type="date" name="date" class="searchinputs" required/>-->
            <input type="text" class="searchinputs" name="rName" placeholder="Restaurant Name or Location.." required/>
            <input type="submit" id="searchButton" value="SEARCH">
        </form>  
    </div>


    <h2>MOST POPULAR LOCATIONS</h2>

    <div class="mostpopular">  
        <a href="restpage.asp">
            <img src="img/kadikoy.jpg" style="width:275px;height:200px;border:0;">
        </a>
        <a href="restpage.asp">
            <img src="img/uskudar.jpg" style="width:275px;height:200px;border:0;">
        </a>

        <a href="restpage.asp">
            <img src="img/besiktas.jpg" style="width:275px;height:200px;border:0;">
        </a><br></br>
        <a href="restpage.asp">
            <img src="img/eminonu.jpg" style="width:275px;height:200px;border:0;">
        </a>
        <a href="restpage.asp">
            <img src="img/sariyer.jpg" style="width:275px;height:200px;border:0;">
        </a>
        <a href="restpage.asp">
            <img src="img/eyup.jpg" style="width:275px;height:200px;border:0;">
        </a>
    </div>

</div>

<!--<div class="form-popup" id="signIn">
    <form method="post" class="form-container" action="signIn.php">
        <h3>Sign In</h3>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="  Enter Username" name="username" required/>
        <br><br>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="  Enter Password" name="psw" required/>
        <span class="forgotpsw"> <a href="forgotPsw.php" onclick="openForm4()">Forgot password?</a></span>
        <br><br>
        <button type="submit" class="btn">Login</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>


<div class = "form-popup" id="signxp">
    <form method="post" class="form-container" >
        <h3>Sign Up</h3>
        <label for="fname">First Name</label>
        <input placeholder="Enter first name" type="text" name="fname" required/>
        <br><br>
        <label for="lname">Last Name</label>
        <input placeholder="Enter last name" type="text" name="lname" required/>
        <br><br>
        <label for="uname">Username</label>
        <input placeholder="Enter username" type="text" name="uname" pattern=".{6,30}" title="between 6 and 30 characters" required/>
        <br><br>
        <label for="email">E-Mail</label>
        <input placeholder="Enter email" type="email" name="email"  required/>
        <br><br>
        <label for="psw">Password</label>
        <input placeholder="Enter password" type="password" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
               title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
        <button type="button" id="cancel" onclick="closeForm()">Cancel</button>
        <input type="submit" id = "ca" value="Create Account">
    </form>
</div>

<div class="form-popup" id="restSignUp">
    <form method="post" class="form-container" action="restSignUp.php"> <h3>Restaurant Sign Up</h3>
        <label for="fname">First Name</label>
        <input placeholder="Enter first name" class="rSign" type="text" name="fname" required/>
        <br><br>
        <label for="lname">Last Name</label>
        <input placeholder="Enter last name" class="rSign" type="text" name="lname" required/>
        <br><br>
        <span></span>
        <label for="uname">Username</label>
        <input placeholder="Enter username" type="text" name="uname" pattern=".{6,30}" title="between 6 and 30 characters" required/>
        <br><br>
        <label for="uname">Restaurant Name</label>
        <input placeholder="Enter restaurant name" class="rSign" type="text" name="rname" required/>
        <br><br>
        <label for="email">E-Mail</label>
        <input placeholder="Enter email" class="rSign" type="email" name="email" required/>
        <br><br>
        <label for="psw">Password</label>
        <input placeholder="Enter password" class="rSign" type="password" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
               title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
        <label for="uname">Phone No</label>
        <input placeholder="Enter phone no" class="rSign" type="text" name="phone" required/>
        <br><br>
        <label for="uname">Adress</label>
        <input placeholder="Enter address" class="rSign" type="text" name="adress" required/>
        <br><br>
        <label for="cap">Restaurant Capacity</label>
        <input placeholder="Capacity" class="rSign" type="number" name="cap" min="1" required/>
        <br><br>
        <button type="button" id="cancel" onclick="closeForm()">Cancel</button>
        <input type="submit" id = "ca" value="Create Account">
    </form>

</div>

<div class = "form-popup" id="forgotpsw">
    <form method="post" class="form-container">
        <label for="cap">Enter your recovery code and your password will reset.</label>
        <input type="text" placeholder="Recovery Code"></input>
        <button type="button" id="cancel" onclick="closeForm()">Cancel</button>
        <button type="button" id="ca">Send</button>
    </form>
</div>-->
</body>
</html>

