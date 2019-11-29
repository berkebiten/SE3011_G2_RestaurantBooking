<!DOCTYPE html>
<link href="style.css" rel="stylesheet" ></link>

<script src="scripts.js" type="text/javascript"></script>
<?php
include('session.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
    <title>ADMIN PANEL</title>


</head>
<body>


<div class=container>
    <div class="top">
        <a href = "index.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
        <button id="profile" ><?php echo $_SESSION['username'] ?></button>
        <a href="returnHP.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
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
            <div  class="adminsearchpart" id="adminsearch">
                <input type="text" class="searchinputs" placeholder="Restaurant or User Name.."></input>
                <input type="button" id="searchButton" value="SEARCH">

            </div> 
        </div>
    </div>

</div>




</body>
</html>
