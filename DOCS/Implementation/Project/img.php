<link rel="stylesheet" href="style.css"/>
<?php include('bootstrapinclude.php') ?>
<script src="scripts.js"></script>
<?php
include('dbconnect.php');
session_start();
$isMyProfile = false;
if (isset($_SESSION['username'])) {
//CHECKS WHAT TYPE OF USER IT IS
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
    //IF VARIABLE FROM QUERY EQUALS TO VARNAME RETURN TRUE
}
//GET ATTRIBUTES FROM DATABASE AND PUT THEM INTO VARIABLE
$uname2 = $_GET['varname'];
$sql = "SELECT * FROM restaurant_owner WHERE uname='$uname2'";
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
//END OF ADDING
//IF THERE IS NO USER WITH THAT UNAME IN DATABASE GO TO ERROR PAGE.
if ($count == 0) {
    header('location:errorPage.php');
}
//SELECTING REVIEW AND IMAGES FROM DATABASE
$commentQuery = mysqli_query($conn, "select * from review where rest_uname='$uname2'");
$sqlB = "select * from image where rest_uname= '$uname2'";
$restImg = mysqli_query($conn, $sqlB);
$count2 = mysqli_num_rows($restImg);
?>

<?php
$uname = $_GET['varname'];
//IF THE FOLDER DOES NOT EXIST FOR RESTAURANT OWNER CREATE IT
if (!file_exists("restaurantImages/$uname")) {
    mkdir("restaurantImages/$uname");
}
?>
<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
}
?>
<!DOCTYPE html>
<html>
    <body>
        <!--    UPLOAD IMAGE FORM-->
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
                <div class="dropdown">
                <a href="notifications.php" class="notification">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <?php if ($unreadCount > 0): ?>
                        <span class = "badge"><?php echo $unreadCount;
                        ?></span>
                    <?php endif ?>
                </a>
                <div class="dropdown-content">
                    <p style="font-weight:bold;font-size:20px;"> Notifications </p>
                    <?php
                    $whilecount = 1;
                    while ($row = mysqli_fetch_array($queryUnread, MYSQLI_ASSOC)):
                        $date_sent = $row['date_sent'];
                        $date_sent = date("m/d/y H:m", strtotime($date_sent));
                        $text = $row['text'];
                        $link = $row['link'];
                        ?>
                        <a href="notificationRedirect.php?varname=<?php echo $row['id']; ?>">

                            <div style="width:100%;" class="notificationCard">
                                <p style="color:black;font-size:12px;"><?php echo $date_sent ?></p><p><?php echo $text; ?><p><i class="fa fa-circle" aria-hidden="true"></i>
                            </div>
                        </a>

                        <?php $whilecount++; endwhile?>
                    <?php
                    while ($row = mysqli_fetch_array($queryRead, MYSQLI_ASSOC)):
                        $text = $row['text'];
                        $link = $row['link'];
                        ?>
                        <a href="notificationRedirect.php?varname=<?php echo $date_sent ?>">

                            <div style="background-color:#388CF2;color:white;border-color:white;width:100%;" class="notificationCard">
                                <p style="color:white;font-size:12px;"><?php echo $row['date_sent'] ?></p><p><?php echo $text; ?><p><i class="fa fa-check-circle" aria-hidden="true"></i>
                            </div>

                        </a>

                        <?php $whilecount++; endwhile ?>
                    <a style="font-weight:bold;" href="notifications.php">See All</a>
                </div>
            </div>
                <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
            </div>
        <?php endif ?>
        <?php if (!isset($_SESSION['success'])): //IF USER IS NOT SIGNED IN GO TO GUEST HOMEPAGE?>
            <div class="top">
                <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
                <a href="signUp.php"><button id="signup" >Sign Up</button></a>
                <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>
                <a href ="support.php"><button class ="support"> Support</button> </a>
                <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
            </div>
        <?php endif ?>
        <form class="formX" action="upload.php?varname=<?php echo $uname ?>" method="post" enctype="multipart/form-data">
            <h1>Select Image</h1>
            <br></br>
            <input style="margin:auto;" type="file" name="fileToUpload" id="fileToUpload"/>
            <br></br>
            <button type="submit" name="submit">Upload Image</button
        </form>
    </div>
</body>
</html>
