<link href="style.css" rel="stylesheet" ></link>
<script src="scripts.js" type="text/javascript"></script>

<?php
session_start();
include("dbconnect.php");

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
        <button id="profile" ><?php echo $_SESSION['username'] ?></button>
        <a href ="support.php"><button id ="support"> Support</button> </a>
        <a href="user.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
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
                            $query = mysqli_query($conn, "select category,date,isResponded from ticket where isResponded=0 ");
                            $query2 = mysqli_query($conn, "select category,date,isResponded from ticket where isResponded=1 ");
                            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

                                echo "<tr> <td>" . $row['category'] . "</td>"
                                . "<td> " . $row['date'] . " </td> "
                            . "<td>" . "No" . "</td> </tr>";
                               
                            }
                            //REST_UNAME EKLENECEK
                            while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
                                  echo "<tr> <td>" . $row['category'] . "</td>"
                                . "<td> " . $row['date'] . " </td> "
                                . "<td>" . $row['No'] . "</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
    </div>
</body>
</html>