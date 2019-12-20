<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
session_start();
include 'dbconnect.php';
$vname = $_GET['varname'];
$user = $_SESSION['username'];
$sql = "select * from user where uname = '$user'";
$sql2 = "select * from bookings where customer_uname = '$user'";
$sql3 = "select uname from admin where uname='$user'";
$query = mysqli_query($conn, $sql);
$query2 = mysqli_query($conn, $sql2);
$queryA = mysqli_query($conn, $sql3);
$arr = mysqli_fetch_assoc($query);
$arr2 = mysqli_fetch_assoc($query2);
$firstname = $arr['fname'];
$lastname = $arr['lname'];
$isAdminViewing = false;
$isMyProfile = false;

if ($user == $vname) {
    $isMyProfile = true;
}
if (mysqli_num_rows($queryA) > 0) {
    $isAdminViewing = true;
}

if (!$isMyProfile && !$isAdminViewing) {
    header('location:errorPage.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>PROFILE</title>

</head>
<body>
<div class="top">
    <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
    <?php if ($isAdminViewing): ?>
        <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
    <?php else: ?>
        <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
<?php endif ?>
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
        <table id="adminSearchTable">
            <thead>
                <tr class="head">
                    <th style="width:60%;">Restaurant Name</th>
                    <th style="width:40%;">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlB = "select * from bookings where customer_uname= '$vname'";
                $queryB = mysqli_query($conn, $sqlB);
                while ($row = mysqli_fetch_array($queryB, MYSQLI_ASSOC)) {
                    $rest_uname = $row['restaurant_uname'];
                    $sqlR = "select * from restaurant_owner where uname='$rest_uname'";
                    $restName = mysqli_query($conn, $sqlR);
                    $rowR = mysqli_fetch_array($restName, MYSQLI_ASSOC);
                    echo "<tr> <td>" . $rowR['rest_name'] . "</td>"
                    . "<td> " . $row['date'] . " </td> </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>  
</body>