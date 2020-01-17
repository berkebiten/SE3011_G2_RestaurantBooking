<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
session_start();
include('dbconnect.php');

if (isset($_SESSION['username'])) {//IF THE VIEWER IS NOT A GUEST
    $usercheck = $_SESSION['username'];
    //QUERY THAT CHECKS IF THE VIEWER IS A RESTAURANT OWNER
    $sql = "select * from restaurant_owner where uname = '$usercheck'";
    $query = mysqli_query($conn, $sql);
    //QUERY THAT CHECKS IF THE VIEWER IS AN ADMIN
    $sql2 = "select * from admin where uname = '$usercheck'";
    $query2 = mysqli_query($conn, $sql2);

    //IF THE VIEWER IS AN ADMIN
    if (mysqli_num_rows($query2) > 0) {
        header('location:Admin.php'); //REDIRECTS THE ADMIN TO THE ADMIN PANEL
    }
    //IF THE VIEWER IS A RESTAURANT OWNER
    if (mysqli_num_rows($query) > 0) {
        header('location:RestaurantOwner.php'); //REDIRECTS THE RESTAURANT TO THE RESTAURANT PANEL
    }
}

//CALCULATES THE 3 MOST BOOKED RESTAURANTS 
$sqlMost = "SELECT restaurant_uname, COUNT(*) FROM bookings GROUP BY restaurant_uname ORDER BY COUNT(*) DESC LIMIT 3";
$queryMost = mysqli_query($conn, $sqlMost);
?>

<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8"/>
    <title>HOMEPAGE</title>
</head>
<body>
<div class="container" id="fullC">


    <?php if (isset($_SESSION['success'])): ?>
        <div class="top">
            <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
            <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
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

                        <?php $whilecount++;
                    endwhile
                    ?>
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

                        <?php $whilecount++;
                    endwhile
                    ?>
                    <a style="font-weight:bold;" href="notifications.php">See All</a>
                </div>
            </div>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px;"></a>

        </div>
<?php endif ?>
<?php if (!isset($_SESSION['success'])): ?>
        <div class="top">
            <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
            <a href="signUp.php"><button id="signup" >Sign Up</button></a>
            <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>
            <a href ="support.php"><button id ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px;"></a>
        </div>
<?php endif ?>


<h1>FIND YOUR RESTAURANT</h1>

<div  class="searchpart">
    <form class="searchForm" action="searchResultGuest.php" method="post">
        <input type="text" class="searchinputs" name="rName" placeholder="Restaurant Name or Location.." required/>
        <input type="submit" id="searchButton" value="SEARCH">
    </form>  
</div>


<h2>MOST POPULAR RESTAURANTS</h2>

<div class="mostpopular">
    <?php $count = 0; ?>
    <!-- PUTS THE 3 MOST BOOKED RESTAURANT'S CARDS IN HOMEPAGE!-->
        <?php while ($arrMost = mysqli_fetch_array($queryMost, MYSQLI_ASSOC)): ?>
        <div class="cardPlace" > 
            <?php
            $sql9 = "select * from restaurant_owner where uname='" . $arrMost['restaurant_uname'] . "'";
            $query19 = mysqli_query($conn, $sql9);
            $arr19 = mysqli_fetch_array($query19, MYSQLI_ASSOC);
            $restaurantName = $arr19['rest_name'];
            $location = $arr19['location'];
            $capacity = $arr19['cap'];
            $phoneNo = $arr19['phoneNo'];
            $description = $arr19['description'];
            ?>

            <div class="restaurantCard">
                <a href="restaurantProfile.php?varname=<?php echo $arrMost['restaurant_uname'] ?>"><h2><?php echo $restaurantName ?></h2></a>
                <div class="cardContainer">
                    <h4><?php echo $description ?></h4>
                    <h4><b>Location:</b> <?php echo $location ?></h4>
                    <h4><b>Phone:</b> <?php echo $phoneNo ?></h4>
                </div>
            </div>


        </div>
<?php endwhile ?>


</div>

</div>
</body>
</html>

