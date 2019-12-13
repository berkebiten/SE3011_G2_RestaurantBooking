<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
include('dbconnect.php');
include('session.php');
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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>RESTAURANT</title>
    </head>
    <body>
        <div class="top">
                <a href = "index.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
                <a href = "userProfile.php"><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <a href ="supportUser.php"><button id ="support"> Support</button> </a>        
            <a href="RestaurantOwner.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>
        <div>
            <font  face="Century Gothic" size="8"><?php echo $rest_name ?></font>
            <?php echo "<a href='bookingForm.php?varname=$uname'><button>Make a Reservation</button></a>" ?>
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

                    <div class="mySlides fade">
                        <div class="numbertext">1 / 3</div>
                        <img class="restPics" src="restaurantImages/rest1/1.jpg">
                        <div class="text">Caption Text</div>
                    </div>

                    <div class="mySlides fade">
                        <div class="numbertext">2 / 3</div>
                        <img class="restPics" src="img/2.jpg">
                        <div class="text">Caption Two</div>
                    </div>

                    <div class="mySlides fade">
                        <div class="numbertext">3 / 3</div>
                        <img class="restPics" src="img/3.jpg">
                        <div class="text">Caption Three</div>
                    </div>

                    <!-- Next and previous buttons -->
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
    </body>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);
    </script>
</html>