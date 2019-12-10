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
    <div class ="buttonsQA">
        <a href ="myRequestTickets.php"><button id ="myrequest">My Request Tickets</button> </a>
          <a href="submitRequest.php"><button    id="subrequest" >Submit Request Ticket</button>   </a>
        
        </div>
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





