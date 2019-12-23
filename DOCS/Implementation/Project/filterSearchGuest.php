<?php
session_start(); 
include("dbconnect.php");

$sql = "SELECT * FROM restaurant_owner ";

if (isset($_SESSION['username'])) { // checkıng if a user is logged in or not
    $viewerUname = $_SESSION['username']; // session username
    $sql1 = "SELECT * FROM restaurant_owner WHERE uname= '$viewerUname'"; // SELECTING EVERYTING FROM RESTAURANT USER TABLE WHERE USERNAME IS THE SESSION USERNAME
    $sql2 = "SELECT * FROM admin WHERE uname= '$viewerUname'"; // SELECTING EVERYTING FROM ADMIN TABLE WHERE USERNAME IS THE SESSION USERNAME
    $query11 = mysqli_query($conn, $sql1);
    $query12 = mysqli_query($conn, $sql2);
    
    if(mysqli_num_rows($query11) > 0 || mysqli_num_rows($query12)>0){ // CHECK IF THE VIEWER IS AN ADMIN OR RESTAURANT OWNER OR NOT
        header('location:index.php');
    }
}

//cuisine filters
$cuisinearray = array();
if (isset($_POST['filterSubmit'])) {

    if (isset($_POST['filter'])) { // CHECKS IF CHECKBOXES THAT NAMED FILTER IS EMPTY OR NOT
        $sql .= 'WHERE cuisines LIKE '; // SETTING THE QUERY FOR THE FILTERING
        $cuisines = $_POST['filter'];
        foreach ($_POST['filter'] as $cuisines) {
            $cuisinearray[] = "'%" . $cuisines . "%'";
        }
        $states = implode(" OR cuisines LIKE ", $cuisinearray); // IMPLODE PUTS THE FIRST STRING IN BETWEEN THE INDEXES OF THE CUISINE ARRAY
        $sql .= $states;
    }
}


//seating filters
$seatingarray = array();
if (isset($_POST['filterSubmit'])) {

    if (isset($_POST['filter1'])) { // CHECKS IF CHECKBOXES THAT NAMED FILTER1 IS EMPTY OR NOT
        if (!isset($_POST['filter'])) {  // CHECKS IF CHECKBOXES THAT NAMED FILTER IS EMPTY OR NOT AND SETS THE QUERY IF ITS EMPTY ADDS WHERE IF NOT EMPTY ADDS AND
            $sql .= 'WHERE seating_options LIKE ';
        } else {
            $sql .= ' AND seating_options LIKE ';
        }

        $seating = $_POST['filter1'];
        foreach ($_POST['filter1'] as $seating) {
            $seatingarray[] = "'%" . $seating . "%'";
        }
        $states1 = implode(" OR seating_options LIKE ", $seatingarray);
        $sql .= $states1;
    }
}

//price filters
$pricearray = array();
if (isset($_POST['filterSubmit'])) {

    if (isset($_POST['filter2'])) { // CHECKS IF CHECKBOXES THAT NAMED FILTER2 IS EMPTY OR NOT
        if (!isset($_POST['filter']) && !isset($_POST['filter1'])) {   // CHECKS IF CHECKBOXES THAT NAMED FILTER AND FILTER1 IS EMPTY OR NOT AND SETS THE QUERY IF ITS EMPTY ADDS WHERE IF NOT EMPTY ADDS AND
            $sql .= 'WHERE price = ';
        } else {
            $sql .= ' AND price = ';
        }

        $price = $_POST['filter2'];
        foreach ($_POST['filter2'] as $price) {
            $pricearray[] = "'" . $price . "'";
        }
        $states2 = implode(" OR price LIKE ", $pricearray);
        $sql .= $states2;
    }
}


//stars filter
$starsarray = array();
if (isset($_POST['filterSubmit'])) {

    if (isset($_POST['filter3'])) { // CHECKS IF CHECKBOXES THAT NAMED FILTER3 IS EMPTY OR NOTr 
        if (!isset($_POST['filter']) && !isset($_POST['filter1']) && !isset($_POST['filter2'])) { // CHECKS IF CHECKBOXES THAT NAMED FILTER, FILTER1 AND FILTER 2 IS EMPTY OR NOT AND SETS THE QUERY IF ITS EMPTY ADDS WHERE IF NOT EMPTY ADDS AND
            $sql .= 'WHERE stars = ';
        } else {
            $sql .= ' AND stars = ';
        }

        $stars = $_POST['filter3'];
        foreach ($_POST['filter3'] as $stars) {
            $starsarray[] = "'" . $stars . "'";
        }
        $states3 = implode(" OR stars LIKE ", $starsarray);
        $sql .= $states3;
    }
}

$result = mysqli_query($conn, $sql); // WORKS THE QUERY THAT HAS BEEN SET
?>

<html>

    <link rel="stylesheet" type="text/css" href="style.css"></link>
    <script src="scripts.js"></script>
    <body>
        <div class="container" id="fullC">

            <div class="top">
            <?php if (isset($_SESSION['success'])): // IF A USER IS LOGGED IN SHOW USER HEADER?>

                <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
                <a href='userProfile.php?varname=<?php echo $_SESSION['username']?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <a href ="support.php"><button id ="support"> Support</button> </a>
                <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>

            <?php endif ?>
            <?php if (!isset($_SESSION['success'])): // IF A USER IS NOT LOGGED IN SHOW GUEST HEADER ?>

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
<!--                            THE CHECKBOXES THAT ARE NAMED FILTER-->
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
                        <!--                            THE CHECKBOXES THAT ARE NAMED FILTER1-->
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
                        <!--                            THE CHECKBOXES THAT ARE NAMED FILTER2-->
                            <tr><input type="checkbox" id="selectAll" onclick="checkAll('chk2')" name="filter2" value="All">All</input><br></tr>
                            <tr><input type="checkbox" id="chk2" name="filter2[]" value="1">Cheap</input><br></tr>
                            <tr><input type="checkbox" id="chk2" name="filter2[]" value="2">Average</input><br>  </tr>
                            <tr><input type="checkbox" id="chk2" name="filter2[]" value="3">Expensive</input><br></tr>
                        </table>
                    </div>
                    <div class="rankOptions">
                        <table>
                            <tr><p>Rank Options</p></tr>
                        <!--                            THE CHECKBOXES THAT ARE NAMED FILTER3-->
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
<!--                PRINTING THE SEARCH RESULTS AFTER FILTERING-->
                <table id="searchResults">
                    <?php
                    echo "<tr><th style=width:30%;> Restaurant Name </th><th style=width:40%;> Adress </th><th style=width:20%;> Phone Number </th></tr> <br>";

                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $resta_name = $row['uname'];
                        echo "<tr>

                    <td > <a href='restaurantProfile.php?varname=$resta_name'>" . $row['rest_name'] . "</a> </td>" //REDIRECTS TO THE RESTAURANT PROFILE THAT IS BEEN CHOOSEN TO BOOK
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

