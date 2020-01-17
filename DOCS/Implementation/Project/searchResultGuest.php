<?php
session_start();
include("dbconnect.php");
//FIND THE RESTAURANTS ACCORDING TO SEARCH INPUT
$rName = filter_input(INPUT_POST, 'rName');
$query = mysqli_query($conn, "SELECT * FROM restaurant_owner WHERE rest_name LIKE '%$rName%' OR location LIKE '%$rName%'");

//ADMINS AND RESTAURANT OWNERS NOT ALLOWED TO SEARCH
if (isset($_SESSION['username'])) {
    $viewerUname = $_SESSION['username'];
    $sql1 = "SELECT * FROM restaurant_owner WHERE uname= '$viewerUname'";
    $sql2 = "SELECT * FROM admin WHERE uname= '$viewerUname'";
    $query11 = mysqli_query($conn, $sql1);
    $query12 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($query11) > 0 || mysqli_num_rows($query12) > 0) {
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

    <link rel="stylesheet" type="text/css" href="style.css"></link>
    <script src="scripts.js"></script>
    <?php include('bootstrapinclude.php') ?>
    <body>
    <div class="container" id="fullC">

        <div class="top">
            <!--                APPROPRIATE HEADER FOR THE USER-->
            <?php if (isset($_SESSION['success'])): ?>
                <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
                <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
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

                            <?php $whilecount++;
                        endwhile ?>
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

        <?php $whilecount++;
    endwhile ?>
                        <a style="font-weight:bold;" href="notifications.php">See All</a>
                    </div>
                </div>
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
        <!--FILTER PART-->
        <div class="filters">            
            <form action="filterSearchGuest.php" method="post">
                <div class="cuisineOptions">
                    <table>
                        <tr><p>Cuisines</p></tr>
                        <tr><input type="checkbox" id="selectAll" onclick="checkAll('chk')" name="filter" value="All">All</input><br></tr>
                        <tr><input type="checkbox" id="chk" name="filter[]" value="Mediterranean Food">Mediterranean Food</input><br></tr>
                        <tr><input type="checkbox" id="chk" name="filter[]" value="Turkish Food">Turkish Food</input><br>  </tr>
                        <tr><input type="checkbox" id="chk" name="filter[]" value="French Food">French Food</input><br></tr>
                        <tr><input type="checkbox" id="chk" name="filter[]" value="International">International</input><br></tr>
                        <tr><input type="checkbox" id="chk" name="filter[]" value="Grid&Steak">Grid&Steak</input><br></tr>
                        <tr><input type="checkbox" id="chk" name="filter[]" value="Fish">Fish</input><br></tr>
                        <tr><input type="checkbox" id="chk" name="filter[]" value="Aegean Food">Aegean Food</input><br></tr>
                        <tr><input type="checkbox" id="chk" name="filter[]" value="Black Sea Food" >Black Sea Food</input><br>  </tr>
                        <tr><input type="checkbox" id="chk" name="filter[]" value="Middle East Food" >Middle East Food</input><br> 
                    </table>
                </div>
                <div class="seatingOptions">
                    <table>
                        <tr><p>Seating Options</p></tr>
                        <tr><input type="checkbox" id="selectAll" onclick="checkAll('chk1')" name="filter1" value="All">All</input><br></tr>
                        <tr><input type="checkbox" id="chk1" name="filter1[]" value="Bar">Bar</input><br></tr>
                        <tr><input type="checkbox" id="chk1" name="filter1[]" value="High Top">High Top</input><br>  </tr>
                        <tr><input type="checkbox" id="chk1" name="filter1[]" value="Standard">Standard</input><br></tr>
                        <tr><input type="checkbox" id="chk1" name="filter1[]" value="Outdoor">Outdoor</input><br></tr>
                    </table>
                </div>
                <div class="priceOptions">
                    <table>
                        <tr><p>Price Options</p></tr>
                        <tr><input type="checkbox" id="selectAll" onclick="checkAll('chk2')" name="filter2" value="All">All</input><br></tr>
                        <tr><input type="checkbox" id="chk2" name="filter2[]" value="1">Cheap</input><br></tr>
                        <tr><input type="checkbox" id="chk2" name="filter2[]" value="2">Average</input><br></tr>
                        <tr><input type="checkbox" id="chk2" name="filter2[]" value="3">Expensive</input><br></tr>
                    </table>
                </div>
                <div class="rankOptions">
                    <table>
                        <tr><p>Rank Options</p></tr>
                        <tr><input type="checkbox" id="selectAll" onclick="checkAll('chk3')" name="filter3" value="All">All</input><br></tr>
                        <tr><input type="checkbox" id="chk3" name="filter3[]" value="3">3</input><br></tr>
                        <tr><input type="checkbox" id="chk3" name="filter3[]" value="2">2</input><br></tr>
                        <tr><input type="checkbox" id="chk3" name="filter3[]" value="1">1</input><br></tr>
                    </table>
                </div>
                <input type="submit" name="filterSubmit" value="Submit"></input>
            </form>
        </div>
        <div class="results">
            <table id="searchResults">
                <?php
                echo "<tr><th style=width:30%;> Restaurant Name </th><th style=width:40%;> Adress </th><th style=width:20%;> Phone Number </th></tr> <br>";
                //PRINT THE SEARCH RESULT
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $resta_name = $row['uname'];
                    echo "<tr>

                    <td > <a href='restaurantProfile.php?varname=$resta_name'>" . $row['rest_name'] . " </a> </td>"
                    . "<td> " . $row["location"] . " </td>"
                    . "<td> " . $row["phoneNo"] . " </td>"
                    . "</tr> <br>";
                }
                echo "</table>";
                ?>
            </table>
        </div>
    </body>
</html>
