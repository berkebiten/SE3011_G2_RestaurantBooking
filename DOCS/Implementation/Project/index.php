<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
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
        header('location:Admin.php');//REDIRECTS THE ADMIN TO THE ADMIN PANEL
    }
    //IF THE VIEWER IS A RESTAURANT OWNER
    if (mysqli_num_rows($query) > 0) {
        header('location:RestaurantOwner.php');//REDIRECTS THE RESTAURANT TO THE RESTAURANT PANEL
    }
}

//CALCULATES THE 3 MOST BOOKED RESTAURANTS 
$sqlMost = "SELECT restaurant_uname, COUNT(*) FROM bookings GROUP BY restaurant_uname ORDER BY COUNT(*) DESC LIMIT 3";
$queryMost = mysqli_query($conn, $sqlMost);
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
            <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
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
                        <h4>Location: <?php echo $location ?></h4>
                        <h4>Phone: <?php echo $phoneNo ?></h4>
                    </div>
                </div>

                
            </div>
        <?php endwhile ?>


    </div>

</div>

</body>
</html>

