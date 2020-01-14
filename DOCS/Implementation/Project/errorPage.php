<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
include('dbconnect.php');
session_start();
if (isset($_SESSION['username'])) {
    $usercheck2 = $_SESSION['username'];
    $sql = "select * from restaurant_owner where uname = '$usercheck2'";
    $sql2 = "select uname from user where uname='$usercheck2'";
    $sql3 = "select uname from admin where uname='$usercheck2'";
    $query6 = mysqli_query($conn, $sql);
    $queryU = mysqli_query($conn, $sql2);
    $queryA = mysqli_query($conn, $sql3);
    $isUserViewing = false ;
    $isAdminViewing = false ;
    $isARestaurantViewing = false;
    
    if (mysqli_num_rows($query6) > 0) {
        $isARestaurantViewing=true;
    }
    if (mysqli_num_rows($queryU) > 0) {
        $isUserViewing = true ;
    }
    if (mysqli_num_rows($queryA) > 0) {
        $isAdminViewing = true ;
    }
    
}
?>
<body>
        <div class="top">
            <?php if (!isset($_SESSION['success'])): ?>
            <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
            <a href="signUp.php"><button id="signup" >Sign Up</button></a>
            <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>
            <a href ="support.php"><button class ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
            <?php else: ?>
            <a href = "SignOut.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
            <?php if($isAdminViewing): ?>
            <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <?php endif ?>
            <?php if($isUserViewing): ?>
            <a href='userProfile.php?varname=<?php echo $_SESSION['username']?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <?php endif ?>
            <?php if($isARestaurantViewing):?>
            <a href='restaurantProfile.php?varname=<?php echo $_SESSION['username']?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <?php endif ?>
            <a href ="support.php"><button id ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
             <?php endif ?>
        </div>
<img src='img/error.jpg'></img>
</body>
