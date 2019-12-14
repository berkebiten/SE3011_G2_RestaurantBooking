<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php session_start() ?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>SUPPORT PAGE</title>
    

</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <?php if (isset($_SESSION['success'])): ?>

            <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
            <a href="#"><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
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
    <?php if (isset($_SESSION['success'])): ?>
        <div class ="buttonsQA">
            <a href ="myRequestTickets.php"><button id ="myrequest">My Request Tickets</button> </a>
            <a href="submitRequest.php"><button    id="subrequest" >Submit Request Ticket</button>   </a>

        </div>
    <?php endif ?>
    <h1 id ="supportHeader">F.A.Q</h1>
    <div class="supportQA">
        <p id ="question1">Question 1: </p> <p id ="question">Sorumu sordum cevap bekliyorum.</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer"> Al kardeşim buyur sana cevap.</p>
        <br><br>
        <p id ="question1">Question 2: </p> <p id ="question">SDASCKJSHDFKCHASDCKFJHSAC</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer">ASDFCJHSADKFCSHDCKHAKCDHSAJKC</p>
        <br><br>
        <p id ="question1">Question 3: </p> <p id ="question">SDASCKJSHDFKCHASDCKFJHSAC</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer">ASDFCJHSADKFCSHDCKHAKCDHSAJKC</p>
        <br><br>
        <p id ="question1">Question 4: </p> <p id ="question">SDASCKJSHDFKCHASDCKFJHSAC</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer">ASDFCJHSADKFCSHDCKHAKCDHSAJKC</p>
        <br><br>
        <p id ="question1">Question 5: </p> <p id ="question">SDASCKJSHDFKCHASDCKFJHSAC</p>
        <br><br>
        <p id ="answer1">Answer: </p> <p id ="answer">ASDFCJHSADKFCSHDCKHAKCDHSAJKC</p>
    </div>

</div>
</body>
</html>



