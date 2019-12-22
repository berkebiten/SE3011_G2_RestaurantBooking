<!DOCTYPE html>
<link href="style.css" rel="stylesheet" ></link>

<script src="scripts.js" type="text/javascript"></script>
<?php
include('accountsProcess.php');
include("dbconnect.php");
if (!isset($_SESSION['success'])) {
    header('location: index.php');
} else {
    $username = $_SESSION['username'];
    $query = mysqli_query($conn, "select * from restaurant_owner where uname = '$username'");
    $counta = mysqli_num_rows($query);
    if ($counta != 1) {
        header("location:index.php");
    }
    $restArray = mysqli_fetch_assoc($query);
    $rest_name = $restArray['rest_name'];
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>RESTAURANT OWNER</title>
    </head>
    <body>
        <div class=container id="fullC">
            <div class="top">
                <?php $resta_name = $_SESSION['username']; ?>
                <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
                <a href = "restaurantProfile.php?varname=<?php echo $resta_name ?>"><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <a href ="support.php"><button id ="support"> Support</button> </a>
                <a href="RestaurantOwner.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
            </div>  
            <div class="wholepanel">
                <div class="adminpanel">
                    <ul>
                        <h1> Restaurant Menu </h1>
                        <li><a onclick="openBookings()">View Bookings of My Restaurant</a></li>
                        <li><a href="#news">View Reviews</a></li>
                        <li><?php echo "<a href='accountSettings.php?varname=$username'><button class='btn' name='accountSettings'>Account Settings</button></a>" ?></li>
                        <li><a href="#about">Support</a></li>
                    </ul>
                </div>
            </div>
            <div class="functions">
                <div class="adminsearchpart" id="viewBookings">

                    <div class="old_ie_wrapper">
                        <table id="adminSearchTable">
                            <thead>
                                <tr class="head">
                                    <th style="width:15%;">Customer</th>
                                    <th style="width:9%;">Party Size</th>
                                    <th style="width:15%;">Date</th>
                                    <th style="width:12%;">Start</th>
                                    <th style="width:12%;">End</th>
                                    <th style="width:13%;">Name</th>
                                    <th style="width:13%;">Surname</th>
                                    <th style="width:14%;">Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $vari = $_SESSION['username'];
                                $query1 = mysqli_query($conn, "select * from bookings where restaurant_uname = '$vari'");
                                


                                while ($bookArr = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {

                                    echo "<tr> <td>" . $bookArr['customer_uname'] . "</td>"
                                    . "<td> " . $bookArr['party'] . " </td> "
                                    . "<td> " . $bookArr['date'] . "</td>"
                                    . "<td> " . $bookArr['start_time'] . "</td>"
                                    . "<td> " . $bookArr['end_time'] . " </td> "
                                    . "<td> " . $bookArr['fname'] . "</td>"
                                    . "<td> " . $bookArr['lname'] . "</td>"
                                    . "<td> " . $bookArr['phoneNo'] . "</td> </tr>";
                                    
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
