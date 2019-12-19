<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
include('dbconnect.php');
session_start();
if (isset($_SESSION['username'])) {
    
    $usercheck2 = $_SESSION['username'];
    $sql = "select * from restaurant_owner where uname = '$usercheck2'";
    $query6 = mysqli_query($conn, $sql);
    $isMyProfile=false;

    if (mysqli_num_rows($query6) > 0) {
        $isMyProfile=true;
    }
    
    
    $isARestaurantViewing = false;
    $vuname = $_GET['varname'];
    if($usercheck2 == $vuname){
        $isARestaurantViewing=true;
    }
}
$uname = $_GET['varname'];
$sql = "SELECT * FROM restaurant_owner WHERE uname='$uname'";
$query = mysqli_query($conn, $sql);
$restArray = mysqli_fetch_assoc($query);
$rest_name = $restArray['rest_name'];
$description = $restArray['description'];
$payment = $restArray['payment'];
$additional = $restArray['additional'];
$phoneNo = $restArray['phoneNo'];
$address = $restArray['address'];
$start = $restArray['startTime'];
$end = $restArray['endTime'];
$count = mysqli_num_rows($query);
if ($count == 0) {
    header('location:errorPage.php');
}
$restImg = mysqli_query($conn, "SELECT * FROM image WHERE rest_uname='$uname'");
$imgArr = mysqli_fetch_assoc($restImg);
$count2 = mysqli_num_rows($restImg);
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>RESTAURANT</title>
</head>
<body>
<div class="container" id="fullC">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="top">
            <a href = "SignOut.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
            <button id="profile" ><?php echo $_SESSION['username'] ?></button>
            <a href ="supportUser.php"><button id ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>
    <?php endif ?>
    <?php if (!isset($_SESSION['success'])): ?>
        <div class="top">
            <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
            <a href="signUp.php"><button id="signup" >Sign Up</button></a>
            <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>
            <a href ="support.php"><button class ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>
    <?php endif ?>
    <div>
        <font  face="Century Gothic" size="8"><?php echo $rest_name ?></font>
        <?php if (isset($_SESSION['success']) && $isARestaurantViewing==false): ?>
        <?php echo "<a href='bookingForm.php?varname=$uname'><button>Make a Reservation</button></a>" ?>
        <?php endif ?>
        
        <?php if (isset($_SESSION['success']) && $isMyProfile == true): ?>
        <?php echo "<a href='editMyProfile.php?varname=$uname'><button>EditProfile</button></a>" ?>
        <?php endif ?>
    </div>
    <div id="full">
        <div id="firstPart">
            <div id="description">
                <br>
                <font face="Century Gothic" size="4"><?php echo $description ?></font>
            </div>

            <div id="menu">
                MENU
            </div>
        </div>
        <div id="secondPart">
            <div class="slideshow-container">

                <?php while ($imgArr = mysqli_fetch_array($restImg, MYSQLI_ASSOC)) : ?>
                    <div class="mySlides fade">
                        <img class="restPics" src="restaurantImages/<?php echo $uname ?>/<?php echo $imgArr['name'] ?>">
                            <div class="text"><?php echo $count2 ?></div>
                    </div>
                <?php endwhile; ?> 
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>

            <?php
            echo "<a href='img.php?varname=$uname'>Upload a photo </a>";
            ?>

            <div id="infos">
                <font face="Century Gothic" size="4"><h3>Address</h3> <?php echo $address ?></font>
                <font face="Century Gothic" size="4"><h3>Hours of operation</h3> <?php echo date('g:i A', strtotime($start)), '-', date('g:i A', strtotime($end)) ?></font>>
                <font face="Century Gothic" size="4"><h3>Payment Options </h3> <?php echo $payment ?></font>
                <font face="Century Gothic" size="4"><h3>Additional </h3> <?php echo $additional ?></font>
                <font face="Century Gothic" size="4"><h3>Phone number </h3> <?php echo $phoneNo ?> </font>
            </div>
        </div>
    </div>
    <div id="reviews">
        <h2>REVIEWS</h2>
    </div>
</div>
</body>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);
</script>
</html>