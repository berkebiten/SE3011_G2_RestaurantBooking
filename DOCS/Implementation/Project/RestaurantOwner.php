<!DOCTYPE html>
<link href="style.css" rel="stylesheet" ></link>

<script src="scripts.js" type="text/javascript"></script>
<?php
include('session.php');
?> 

<html>
    <head>
        <meta charset="UTF-8">
    <title>RESTARURANT OWNER</title>
</head>
<body>

<div class=container>
            <div class="top">
                <a href = "index.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
                <a href = "restaurantProfile.php"><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <a href ="supportUser.php"><button id ="support"> Support</button> </a>
                <a href="user.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
            </div>  
    <div class="wholepanel">
        <div class="adminpanel">

            <ul>
                <h1> Restaurant Menu </h1>
                <li><a href="#home">View Bookings of My Restaurant</a></li>
                <li><a href="#news">View Reviews</a></li>
                <li><a href="#contact">Account Settings</a></li>
                <li><a href="#about">Support</a></li>
            </ul>
        </div>
        <div class="functions">
                <!-- Functions will be here !-->

        </div>
    </div>
</div>
</body>
</html>
