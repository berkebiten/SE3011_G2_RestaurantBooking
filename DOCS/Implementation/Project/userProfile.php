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
$email = $arr['email'];
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
        <label>First Name: <?php echo $firstname ?> </label><br><br>
        <label>Last Name:  <?php echo $lastname ?></label> <br><br>
        <label>Email:  <?php echo $email ?></label>
    </div>
    <div id='profileButtons'>
        <button>Edit Profile</button> <br><br>
        <button>Account Settings</button>
    </div>
    <div class='stats' id="favRest">
        <h4>Favorite Restaurants</h4>
    </div>
    <div class='stats' id="bookings">
        <h4>Upcoming Bookings</h4>
        <?php if($isMyProfile): ?>
        <a style ="float:right; margin-right:6%;" href='viewMyBookings.php?varname=<?php echo $vname?>'>See all bookings</a><br>
        <?php endif ?> 
        <table id="viewMyBookingsTable">
            <thead>
                <tr class="head">
                    <th style="width:40%;">Restaurant Name</th>
                    <th style="width:40%;">Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $date = date("Y-m-d");
                $time = date("H:i:s");
                $sqlB = "select * from bookings where customer_uname= '$vname' and date>='$date'";
                $queryB = mysqli_query($conn, $sqlB);
                while ($row = mysqli_fetch_array($queryB, MYSQLI_ASSOC)) {
                    $id= $row['bookingId'];
                    $rest_uname = $row['restaurant_uname'];
                    $sqlR = "select * from restaurant_owner where uname='$rest_uname'";
                    $restName = mysqli_query($conn, $sqlR);
                    $rowR = mysqli_fetch_array($restName, MYSQLI_ASSOC);
                    
                    if(($date==$row['date'] && $time<$row['start_time']) || $date < $row['date'] ){
                    echo "<tr> <td>" . $rowR['rest_name'] . "</td>"
                    . "<td> " . $row['date'] . " </td> <td>  <a href='editBook.php?varname=$id'><button>Edit</button></a> "
                            . "<br><br><button onclick=\"if (confirm('Are you sure want to cancel your booking?')) window.location.href='cancelBook.php?varname=$id';\">Cancel</button></td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>  
</body>