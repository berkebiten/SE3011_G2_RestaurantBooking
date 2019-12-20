<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php session_start(); 
include 'dbconnect.php';
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
    
    if($isAdminViewing){
        header('location:index.php');
    }
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
        <?php if (isset($_SESSION['success'])): ?>

            <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
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
        <?php if (!isset($_SESSION['success'])): ?>

            <a href="restSignUp.php"><button  id="rsignup">Restaurant Sign Up</button></a>
            <a href="signUp.php"><button id="signup" >Sign Up</button></a>
            <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>
            <a href ="support.php"><button class ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>

        <?php endif ?>
    </div>
    <?php if (isset($_SESSION['success'])): ?>
        <div class ="buttonsQA">
            <a href ="viewMyTickets.php"><button id ="myrequest">My Request Tickets</button> </a>
            <a href="submitRequest.php"><button    id="subrequest" >Submit Request Ticket</button>   </a>

        </div>
    <?php endif ?>
    <h1 id ="supportHeader">F.A.Q</h1>
    <div class="supportQA">
        <p id ="question1">Question 1: </p> <p id ="question">Sorumu sordum cevap bekliyorum.</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer"> Al kardeşim buyur sana cevap.</p>
        <br><br>
        <p id ="question1">Question 2: </p> <p id ="question">SDASCKJSHDFKCHASDCKFJHSAC</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer">ASDFCJHSADKFCSHDCKHAKCDHSAJKC</p>
        <br><br>
        <p id ="question1">Question 3: </p> <p id ="question">SDASCKJSHDFKCHASDCKFJHSAC</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer">ASDFCJHSADKFCSHDCKHAKCDHSAJKC</p>
        <br><br>
        <p id ="question1">Question 4: </p> <p id ="question">SDASCKJSHDFKCHASDCKFJHSAC</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer">ASDFCJHSADKFCSHDCKHAKCDHSAJKC</p>
        <br><br>
        <p id ="question1">Question 5: </p> <p id ="question">SDASCKJSHDFKCHASDCKFJHSAC</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer">ASDFCJHSADKFCSHDCKHAKCDHSAJKC</p>
    </div>

</div>
</body>
</html>



