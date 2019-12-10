<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<html>
    <head>
        <meta charset="UTF-8">
    <title>SUPPORT PAGE</title>

</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <a href = "index.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
        <button id="profile" ><?php echo $_SESSION['username'] ?></button>
        <a href ="supportUser.php"><button id ="support"> Support</button> </a>
        <a href="user.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
    <h1 id ="supportHeader">Submit a Request Ticket</h1>
    <div class ="submitReq">
        <br>
        <select class="select-css">
            <option>Category</option>
            <option>Apples</option>
            <option>Bananas</option>
            <option>Grapes</option>
            <option>Oranges</option>
        </select>
        <textarea class ="tArea" rows="8" cols="50">
Description Here.
        </textarea>
        <br><br>
         <a href ="x.php"><button id ="subsub">Submit</button> </a>
        


    </div>
</div>
</body>
</html>

