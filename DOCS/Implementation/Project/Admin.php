<!DOCTYPE html>
<link href="style.css" rel="stylesheet" ></link>
<script src="scripts.js" type="text/javascript"></script>
<?php
include('session.php');
include("dbconnect.php");
?>

<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN PANEL</title>


</head>
<body>

<div class=container>
    <div class="top">
        <a href = "index.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
        <button id="profile" ><?php echo $_SESSION['username'] ?></button>
        <a href="Admin.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
    <div class="wholepanel">


        <div class="adminpanel">

            <ul>
                <h1> Admin Panel </h1>
                <li><a href="#home">View Request Tickets</a></li>
                <li><a href="#news">View Restaurant Signups</a></li>
                <li><a href="#contact">Ban User</a></li>
                <li><a href="#about">Warn User</a></li>
                <li><a onclick="openAdminSearch()">Search</a></li>
            </ul>
        </div>
        <div class="functions">
            <div class="searchfunction">

                <!--<div  class="adminsearchpart" id="adminsearch">
                        <p>SEARCH</p>
                                    
                        <input type="text" class="searchinputs" name="entry" placeholder="Restaurant or User Name.."></input>
                        <input type="button" id="searchButton" value="SEARCH">
                                    
                </div>-->

                <div class="adminsearchpart" id="adminsearch">
                    <input type="text" id="adminsearchinput" onkeyup="searchFilterFunction()" placeholder="Search for usernames.." title="Type in a username">
                        <div class="old_ie_wrapper">
                            <table id="adminSearchTable">
                                <thead>
                                    <tr class="head">
                                        <th style="width:60%;">Username</th>
                                        <th style="width:40%;">Acc_Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                                    
                                    $query = mysqli_query($conn, "select uname from restaurant_owner ");
                                    $query2 = mysqli_query($conn, "select uname from user ");
                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        $rest_uname = $row['uname'];
                                        echo "<tr> <td><a href='restaurantProfile.php?varname=$rest_uname'> " . $row["uname"] . "</a></td>"
                                        . "<td> " . "Restaurant Owner" . " </td> </tr>";
                                    }
                                    while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
                                        echo "<tr> <td> " . $row2["uname"] . " </td>"
                                        . "<td> " . "User" . " </td> </tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                </div>
  <div class="adminsearchpart" id="viewTickets">
                    <input type="text" id="adminsearchinput" onkeyup="searchFilterFunction()" placeholder="Search for usernames.." title="Type in a username">
                        <div class="old_ie_wrapper">
                            <table id="adminSearchTable">
                                <thead>
                                    <tr class="head">
                                        <th style="width:60%;">Username</th>
                                    
                                        <th style="width:40%">Category</th>
                                        <th style="width:20%">Date</th>
                                        <th style="width:20%">Is Responded</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                                    
                                    $query = mysqli_query($conn, "select uname, category,date, isResponded from ticket  ");         
                                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                        $isResponded= $row["isResponded"];
                                        if($isResponded ==0){
                                            $isResponded = "No";
                                        } else if ($isResponded ==1){
                                            $isResponded =="Yes";
                                        }
                                        
                                        echo "<tr> <td> " . $row["uname"] . " </td>"
                                        . "<td> " . $row["category"] . " </td>"
                                     . "<td> " . $row["date"] . " </td>"
                                           . "<td> " . $isResponded . " </td> </tr>"; 
                                    }
                                   
                                    ?>

                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

