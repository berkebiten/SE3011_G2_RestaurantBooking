<?php
include('session.php');
include("dbconnect.php");
$rName = filter_input(INPUT_POST, 'rName');
$query = mysqli_query($conn, "select * from restaurant_owner where rest_name='$rName' or address='$rName'");
?>



<html>

    <link rel="stylesheet" type="text/css" href="style.css"></link>
        <script src="scripts.js"></script>F
        <body>
        <div class="container" id="fullC">

            <div class="top">
            <a href = "index.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
            <button id="profile" ><?php echo $_SESSION['username'] ?></button>
            <a href="returnHP.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>      
            <div class="results">
                <table id="searchResults">
                    <?php
                    echo "<tr><th style=width:30%;> Restaurant Name </th><th style=width:40%;> Adress </th><th style=width:20%;> Phone Number </th><th style=width:10%;>  </th></tr> <br>";
                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        echo "<tr> <td> " . $row["rest_name"] . " </td>"
                        . "<td> " . $row["address"] . " </td>"
                        . "<td> " . $row["phoneNo"] . " </td>
                               <td> <form action='bookingForm.php' method='post'>
                                    <button>Book</button>
                                    </form> </td></tr> <br>";
                    }
                    echo "</table>";
                    ?>
                </table>
            </div>
        </div>

    </body>
</html>
