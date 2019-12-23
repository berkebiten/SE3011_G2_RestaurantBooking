<link rel="stylesheet" href="style.css"></link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></link>
<script src="scripts.js"></script>
<?php
include('dbconnect.php');
session_start();
$isMyProfile = false;
if (isset($_SESSION['username'])) {

    $usercheck2 = $_SESSION['username'];
    $sql = "select * from restaurant_owner where uname = '$usercheck2'";
    $sql2 = "select uname from user where uname='$usercheck2'";
    $sql3 = "select uname from admin where uname='$usercheck2'";
    $query6 = mysqli_query($conn, $sql);
    $queryU = mysqli_query($conn, $sql2);
    $queryA = mysqli_query($conn, $sql3);
    $isMyProfile = false;
    $isUserViewing = false;
    $isAdminViewing = false;
    $isARestaurantViewing = false;

    if (mysqli_num_rows($query6) > 0) {
        $isARestaurantViewing = true;
    }
    if (mysqli_num_rows($queryU) > 0) {
        $isUserViewing = true;
    }
    if (mysqli_num_rows($queryA) > 0) {
        $isAdminViewing = true;
    }


    $vuname = $_GET['varname'];
    if ($usercheck2 == $vuname) {
        $isMyProfile = true;
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
$commentQuery = mysqli_query($conn, "select * from review where rest_uname='$uname'");
$sqlB = "select * from image where rest_uname= '$uname'";
$restImg = mysqli_query($conn, $sqlB);
$count2 = mysqli_num_rows($restImg);
?>

<?php include('replyProcess.php'); ?>
<html>
    <head>
        <style>
            .checked {
                color: #FFE100;
            }
            .checked2{
                color:#7BFF00;
            }
        </style>
        <meta charset="UTF-8">
    <title>RESTAURANT</title>
</head>
<body>
<div class="container" id="fullC">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="top">
            <a href = "SignOut.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
            <?php if ($isAdminViewing): ?>
                <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <?php endif ?>
            <?php if ($isUserViewing): ?>
                <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <?php endif ?>
            <?php if ($isARestaurantViewing): ?>
                <a href='restaurantProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <?php endif ?>
            <a href ="support.php"><button id ="support"> Support</button> </a>
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
        <?php if (isset($_SESSION['success']) && $isARestaurantViewing == false && $isAdminViewing == false): ?>
            <?php echo "<a href='bookingForm.php?varname=$uname'><button>Make a Reservation</button></a>" ?>
            <?php
            $sqlFavorites = "select * from favorites where customer_uname='$usercheck2' and rest_uname='$uname'";
            $favoritesQ = mysqli_query($conn, $sqlFavorites);
            $countF = mysqli_num_rows($favoritesQ);
            if($countF>0){
                     echo '⭐';
            }else {
                     echo "<a href='addFavorite.php?varname=$uname'><button>Add Favorites</button></a>";
                }
            ?>
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
            <div id="infos">
                <font face="Century Gothic" size="4"><h3>Address</h3> <?php echo $address ?></font>
                <font face="Century Gothic" size="4"><h3>Hours of operation</h3> <?php echo date('g:i A', strtotime($start)), '-', date('g:i A', strtotime($end)) ?></font>>
                <font face="Century Gothic" size="4"><h3>Payment Options </h3> <?php echo $payment ?></font>
                <font face="Century Gothic" size="4"><h3>Additional </h3> <?php echo $additional ?></font>
                <font face="Century Gothic" size="4"><h3>Phone number </h3> <?php echo $phoneNo ?> </font>
            </div>
        </div>
        <div id="secondPart">
            <div class="slideshow-container">
<?php while ($imgArr = mysqli_fetch_array($restImg, MYSQLI_ASSOC)) : ?>
                    <div class="mySlides fade">
                        <img class="restPics" src="restaurantImages/<?php echo $_GET['varname'] ?>/<?php echo $imgArr['name'] ?>">

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
            if ($isMyProfile) {
                echo "<a href='img.php?varname=$uname'>Upload a photo </a>";
            }
            ?>
        </div>
    </div>
    <div class="reviewHeader">
        <h2>REVIEWS</h2>
    </div>


    <div class="reviews">
<?php while ($row = mysqli_fetch_array($commentQuery, MYSQLI_ASSOC)): ?>
            <div class="commentCard">
                <div class='starNPrice'>
                    <?php
                    $starCount = $row['star'];
                    $priceCount = $row['price'];
                    $cs = 0;
                    $cp = 0;
                    while ($cs < $starCount) {
                        echo "<span class='fa fa-star checked'></span>";
                        $cs++;
                    }
                    if ($starCount < 3) {
                        $es = 0;
                        while ($es < (3 - $starCount)) {
                            echo "<span class='fa fa-star'></span>";
                            $es++;
                        }
                    }
                    echo "<br>";
                    while ($cp < $priceCount) {
                        echo "<span class='fa fa-usd checked2'></span>";
                        $cp++;
                    }
                    if ($priceCount < 3) {
                        $ep = 0;
                        while ($ep < (3 - $priceCount)) {
                            echo "<span class='fa fa-usd'></span>";
                            $ep++;
                        }
                    }
                    ?>
                </div>
                <div class="comment">
                    <p> <?php echo $row['customer_uname'] . ": " . $row['text']; ?> </p>
                </div>

    <?php if (!empty($row['reply'])): ?>
                    <div class="replyRest">
                        <p> <?php echo $row['rest_uname'] . ": " . $row['reply']; ?> </p>
                    </div>

                <?php endif ?>
    <?php if (empty($row['reply']) && $isMyProfile): ?>
                    <form class="replyComment" method="post" action="restaurantProfile.php?varname=<?php echo $_GET['varname'] ?>">
                        <input type="number" class="invs" name='reviewId' value="<?php echo $row['reviewId'] ?>" />
                        <textarea rows="3" cols="50" class="rArea" name="reply" required></textarea>
                        <button type="submit" class="btn" name="drop_reply">Submit</button>
                    </form>
            <?php endif ?>
            </div>
<?php endwhile ?>
    </div>
</div>
</body>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);
</script>
</html>