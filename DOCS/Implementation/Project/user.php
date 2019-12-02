<!DOCTYPE html>
<?php
include('session.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>USER</title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>
    <div class="container" id="fullC">

        <div class="top">
            <a href = "index.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
            <button id="profile" ><?php echo $_SESSION['username'] ?></button>
            <a href="user.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>

        <h1>FIND YOUR RESTAURANT</h1>

        <div  class="searchpart">
            <form class="searchForm" action="searchResultUser.php" method="post">
                <select class="searchinputs" required>
                    <option value="0"> Party Size </option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <input type="date" name="date" class="searchinputs" required/>
                <input type="text" class="searchinputs" name="rName" placeholder="Restaurant Name or Location.." required/>
                <input type="submit" id="searchButton" value="SEARCH">
            </form>  
        </div> 
        <h2>MOST POPULAR LOCATIONS</h2>

        <div class="mostpopular">  
            <a href="restpage.asp">
                <img src="img/kadikoy.jpg" style="width:275px;height:200px;border:0;">
            </a>
            <a href="restpage.asp">
                <img src="img/uskudar.jpg" style="width:275px;height:200px;border:0;">
            </a>

            <a href="restpage.asp">
                <img src="img/besiktas.jpg" style="width:275px;height:200px;border:0;">
            </a><br></br>
            <a href="restpage.asp">
                <img src="img/eminonu.jpg" style="width:275px;height:200px;border:0;">
            </a>
            <a href="restpage.asp">
                <img src="img/sariyer.jpg" style="width:275px;height:200px;border:0;">
            </a>
            <a href="restpage.asp">
                <img src="img/eyup.jpg" style="width:275px;height:200px;border:0;">
            </a>
        </div>
    </div>
</body>
</html>
