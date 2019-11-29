<?php
include('session.php');
include("dbconnect.php");
$rName = filter_input(INPUT_POST, 'rName');
$query = mysqli_query($conn, "select * from restaurant_owner where rest_name='$rName' or address='$rName'");
?>



<html>

    <link rel="stylesheet" type="text/css" href="style.css"></link>
        <script src="scripts.js"></script>
        <body>
        <div class="container" id="fullC">

            <div class="top">
                <button onclick="openForm2()"  id="rsignup">Restaurant Sign Up</button>
                <button onclick="openForm3()"  id="signup" >Sign Up</button>
                <button onclick="openForm()"   id="signin" >Sign In</button>         
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
                               <td> 
                                    <button onclick='openForm()'>Sign In</button>
                                     </td></tr> <br>";
                    }
                    echo "</table>";
                    ?>
                </table>
            </div>
            <div class="panky" style="margin-left:50%;">
                <iframe src="https://giphy.com/embed/WopNGhTAbEw6zXHxVD" width="427" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
            </div>
        </div>

    </body>
    <div class="form-popup" id="signIn">
    <form method="post" class="form-container" action="signIn.php">
        <h3>Sign In</h3>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="  Enter Username" name="username" required/>
        <br><br>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="  Enter Password" name="psw" required/>
        <span class="forgotpsw"> <a href="#" onclick="openForm4()">Forgot password?</a></span>
        <br><br>
        <button type="submit" class="btn">Login</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>
</html>
