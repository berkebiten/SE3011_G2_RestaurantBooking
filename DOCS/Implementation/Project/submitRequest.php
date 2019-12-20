<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
include("dbconnect.php");
include('loginProcess.php');
if (isset($_SESSION['username'])) {
    $usercheck2 = $_SESSION['username'];
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
}
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Submit Page</title>

</head>
<body>
<div class="container" id="fullC">

    <div class="top">
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
        <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
    <div id="formArea">
        <form class="formX" method="post" action="submitRequest.php">
            <h1>Submit a Request</h1>
            <?php include('errors.php'); ?>
            <select class="select-css" name ="category">
                <option>Category</option>
                <option>Apples</option>
                <option>Bananas</option>
                <option>Grapes</option>
                <option>Oranges</option>
            </select>
            <h3>Description</h3>
            <textarea rows="8" cols="50" class="tArea" name="description" ></textarea>
            <br><br>
            
            <button type="submit" id="subsub" name="sub_request">Submit</button>
        </form>
    </div>
    <div id="feedback">
        <?php include('feedbacks.php') ?>
        <?php if (count($feedbacks) > 0) : ?>
            <script> openFeedback();</script>
            <button onclick="window.location.href = 'viewMyTickets.php'">OK</button>
        <?php endif ?>
    </div>
</div>
</body>
</html>

