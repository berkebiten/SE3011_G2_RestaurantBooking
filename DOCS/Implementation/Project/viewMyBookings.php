<link rel="stylesheet" href="style.css"></link>
<?php
session_start();
include 'dbconnect.php';
$vname = $_GET['varname']; 
$user = $_SESSION['username'];
$sql = "select * from user where uname = '$user'";
$query = mysqli_query($conn, $sql);
$arr = mysqli_fetch_assoc($query);
$isMyProfile = false;

if ($user == $vname) {
    $isMyProfile = true;
}


if (!$isMyProfile) {
    header('location:errorPage.php');
}
?>
<body>
    <div class="top">
    <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
        <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
    <a href ="support.php"><button id ="support"> Support</button> </a>
    <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>   
</div>
<div id='formArea'>
    <table id="viewMyBookingsTable">
            <thead>
                <tr class="head">
                    <th style="width:50%;">Restaurant Name</th>
                    <th style="width:40%;">Date</th>
                    <th style="width:40%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $date = date("Y-m-d");
                $time = date("H:i:s");
                $sqlB = "select * from bookings where customer_uname= '$vname'";
                $queryB = mysqli_query($conn, $sqlB);
                while ($row = mysqli_fetch_array($queryB, MYSQLI_ASSOC)) {
                    $rest_uname = $row['restaurant_uname'];
                    $sqlR = "select * from restaurant_owner where uname='$rest_uname'";
                    $restName = mysqli_query($conn, $sqlR);
                    $rowR = mysqli_fetch_array($restName, MYSQLI_ASSOC);
                    $id = $row['bookingId'];
                    if(($date==$row['date'] && $time<$row['start_time']) || $date < $row['date'] ){
                    echo "<tr> <td>" . $rowR['rest_name'] . "</td>"
                    . "<td> " . $row['date'] . " </td> <td> <a href='editBook.php?varname=$id'><button>Edit</button></a> "
                            . "<br><br><button onclick=\"if (confirm('Are you sure want to cancel your booking?')) window.location.href='cancelBook.php?varname=$id';\">Cancel</button></td></tr>";
                    }else {
                       echo "<tr> <td>" . $rowR['rest_name'] . "</td>"
                    . "<td> " . $row['date'] .  " </td><td> <button >Review</button> </td></tr>"; 
                    }
                }
                ?>
            </tbody>
        </table>
</div>
        <div id="feedback">
            <?php include('feedbacks.php') ?>
            <?php if (count($feedbacks) > 0) : ?>
                <script> openFeedback();</script>
                <button onclick="window.location.href='cancelBooking.php?varname=<?php$id?>'">OK</button>
            <?php endif ?>
        </div>
        </body>
       