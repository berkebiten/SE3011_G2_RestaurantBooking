<?php
session_start();
include("dbconnect.php");
$rName = filter_input(INPUT_POST, 'rName');
$query = mysqli_query($conn, "SELECT * FROM restaurant_owner WHERE rest_name LIKE '%$rName%' OR location LIKE '%$rName%'");

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

<html>

    <link rel="stylesheet" type="text/css" href="style.css"></link>
    <script src="scripts.js"></script>
    <body>
        <div class="container" id="fullC">

            <div class="top">
                <?php if (isset($_SESSION['success'])): ?>

                    <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
                    <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
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
                            <tr><input type="checkbox" id="chk1" name="filter1[]" value="Standart">Standard</input><br></tr>
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
                            <tr><input type="checkbox" id="chk3" name="filter3[]" value="5">5</input><br></tr>
                            <tr><input type="checkbox" id="chk3" name="filter3[]" value="4">4</input><br></tr>
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
