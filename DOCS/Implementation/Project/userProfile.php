<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php session_start() ;
 include 'dbconnect.php';
$user = $_SESSION['username'];
$sql = "select * from user where uname = '$user'";
$sql2 = "select * from bookings where customer_uname = '$user'";
$query = mysqli_query($conn, $sql);
$query2 = mysqli_query($conn, $sql2);
$arr = mysqli_fetch_assoc($query);
$arr2 = mysqli_fetch_assoc($query2);
$firstname = $arr['fname'];
$lastname = $arr['lname'];
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>PROFILE</title>
    
</head>
<body>
<div class="top">
             <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
            <a href="#"><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <a href ="support.php"><button id ="support"> Support</button> </a>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>   
</div>
        
<div id="fullProfile">
    <div id="personalInfos">
        <p><?php echo $_SESSION['username'] ?></p>
        <label>First Name : </label><?php echo $firstname ?> <br><br>
        <label>Last Name : </label> <?php echo $lastname ?>
    </div>
    <div id='profileButtons'>
        <button>Edit Profile</button> <br><br>
        <button>Account Settings</button>
    </div>
    <div class='stats' id="favRest">
        <h4>Favorite Restaurants</h4>
    </div>
    <div class='stats' id="bookings">
        <h4>My Bookings</h4>
    </div>
</div>  
</body>