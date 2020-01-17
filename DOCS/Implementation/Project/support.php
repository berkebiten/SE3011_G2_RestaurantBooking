<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
session_start();
include 'dbconnect.php';
if (isset($_SESSION['username'])) {
    $usercheck2 = $_SESSION['username'];
    //We check the type of the user and if it is admin, we turn it back to index.php, if it is not, operation continues.
    $sql = "select * from restaurant_owner where uname = '$usercheck2'";
    $sql2 = "select uname from user where uname='$usercheck2'";
    $sql3 = "select uname from admin where uname='$usercheck2'";
    $query6 = mysqli_query($conn, $sql);
    $queryU = mysqli_query($conn, $sql2);
    $queryA = mysqli_query($conn, $sql3);
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

    if ($isAdminViewing) {
        header('location:index.php');
    }
}
?>
<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>SUPPORT PAGE</title>


</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <!--        ACCORDING TO USER TYPE, SEND TO ITS RELATED HOMEPAGE.-->
<?php if (isset($_SESSION['success'])): ?>

            <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
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

<?php endif ?>
        <!--            END OF USER TYPE CHECK.-->
        <!--    IF THE SESSION IS UNSUCCESFUL, GO TO SHOW GUESTPAGE-->
<?php if (!isset($_SESSION['success'])): ?>

            <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
            <a href="signUp.php"><button id="signup" >Sign Up</button></a>
            <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>
            <a href ="support.php"><button id ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>

<?php endif ?>
        <!--            END OF GUESTPAGE-->
    </div>
    <!--    IF THE USER LOGGED IN, SHOW THE BUTTONS.-->
<?php if (isset($_SESSION['success'])): ?>
        <div class ="buttonsQA">
            <a href ="viewMyTickets.php"><button id ="myrequest">My Request Tickets</button></a><br>
            <a href="submitRequest.php"><button id="subrequest" >Submit Request Ticket</button></a>
        </div>
<?php endif ?>
    <!--END OF THE LOGGED IN USER-->
    <h1 style="color:#388CF2;">F.A.Q</h1>
    <div class="supportQA">
        <p id ="question1">Question 1: </p> <p id ="question">I'm not getting any emails.What's wrong?</p><br>

        <p id ="answer1">Answer: </p> <p id ="answer">Your email should be a gmail as defined in sign up page. We will add e-mail feature for other email domains soon.</p><br>

        <p id ="question1">Question 2: </p> <p id ="question">I sent an application for my restaurant but i can't sign in to my restaurant account.</p><br>

        <p id ="answer1">Answer: </p> <p id ="answer">We inspect restaurant applications before accepting or declining them. When decision about your application is made you will get an email about the result. </p><br>

        <p id ="question1">Question 3: </p> <p id ="question">Where can i change my password?</p><br>

        <p id ="answer1">Answer: </p> <p id ="answer">You can change your password from your Account Settings. It's in profile for Regular Users and in restaurant panel for Restaurant Owners.</p><br>

        <p id ="question1">Question 4: </p> <p id ="question">Where can i change my email?</p><br>

        <p id ="answer1">Answer: </p> <p id ="answer">You can change your email from your Account Settings. It's in profile for Regular Users and in restaurant panel for Restaurant Owners.</p><br>

        <p id ="question1">Question 4: </p> <p id ="question">Where can i change my username?</p><br>

        <p id ="answer1">Answer: </p> <p id ="answer">You can not change your username for now. And we don't plan to add this feature in near future.</p><br>


    </div>

</div>
</body>
</html>



