<link href="style.css" rel="stylesheet" ></link>
<script src="scripts.js" type="text/javascript"></script>

<?php
session_start();
include("dbconnect.php");
if (isset($_SESSION['success'])) {
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
    if ($isAdminViewing) {
        header('location:index.php');
    }
} else {
    header('location:signIn.php');
}
?>
<html>

    <head>
        <meta charset="UTF-8">
    <title>View My Tickets</title>

</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
        <?php if ($isUserViewing): ?>
            <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <?php endif ?>
        <?php if ($isARestaurantViewing): ?>
            <a href='restaurantProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <?php endif ?>
        <a href ="support.php"><button id ="support"> Support</button> </a>
        <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>

    <div class="adminsearchpart" id="viewMyTickets">
        <div class="old_ie_wrapper">
            <table id="viewTicketsTable">
                <thead>
                    <tr class="head">
                        <th style="width:40%;">Category</th>
                        <th style="width:30%">Date</th>
                        <th style="width:15%">Is Responded</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $username = $_SESSION['username'];
                    $query = mysqli_query($conn, "select category,date,isResponded,ticketId from ticket where isResponded=0 AND user_uname= '$username'");
                    $query2 = mysqli_query($conn, "select category,date,isResponded,ticketId from ticket where isResponded=0 AND rest_uname='$username'");
                    $query3 = mysqli_query($conn, "select category,date,isResponded, ticketId from ticket where isResponded=1 AND user_uname='$username'");
                    $query4 = mysqli_query($conn, "select category,date,isResponded,ticketId from ticket where isResponded=1 AND rest_uname='$username'");
                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        $ticketId = $row['ticketId'];
                        echo "<tr> <td><a href='viewTickets.php?varname=$ticketId'>" . $row['category'] . "</td>"
                        . "<td> " . $row['date'] . " </td> "
                        . "<td>" . "No" . "</td> </tr>";
                    }
                    while ($row = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {
                        $ticketId = $row['ticketId'];
                        echo "<tr><td> <a href='viewTickets.php?varname=$ticketId'>" . $row['category'] . "</td>"
                        . "<td> " . $row['date'] . " </td> "
                        . "<td>" . "Yes" . "</td> </tr>";
                    }
                    //REST_UNAME EKLENECEK
                    while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
                        $ticketId = $row2['ticketId'];
                        echo "<tr> <td><a href='viewTickets.php?varname=$ticketId'>" . $row2['category'] . "</td>"
                        . "<td> " . $row2['date'] . " </td> "
                        . "<td>" . "No" . "</td></tr>";
                    }
                    while ($row2 = mysqli_fetch_array($query4, MYSQLI_ASSOC)) {
                        $ticketId = $row2['ticketId'];
                        echo "<tr> <td><a href='viewTickets.php?varname=$ticketId'> " . $row2['category'] . "</td>"
                        . "<td> " . $row2['date'] . " </td> "
                        . "<td>" . "Yes" . "</td></tr>";
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </div>
</div>
</body>
</html>