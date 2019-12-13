<link rel="stylesheet" href="style.css"></link>
<?php

include("dbconnect.php");
include('loginProcess.php') 
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Submit Page</title>

</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <a href = "index.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
        <button id="profile" ><?php echo $_SESSION['username'] ?></button>
        <a href ="supportUser.php"><button id ="support"> Support</button> </a>
        <a href="user.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
        <div class="formArea">
            <form class="formX" method="post" action="submitRequest.php">
                <h1>Submit a Request</h1>
                <?php include('errors.php'); ?>
                   <select class="select-css" name ="category">
            <option>Category</option>
            <option>Apples</option>
            <option>Bananas</option>
            <option>Grapes</option>
            <option>Oranges</option>
        </select>
                 <textarea rows="8" cols="50" class="tArea" name="description" ></textarea>
        <br><br>
   
         <button type="submit" id="subsub" name="sub_request">Submit</button>
            </form>
        </div>

    
    <!--    <h1 id ="supportHeader">Submit a Request Ticket</h1>
     
    <div class ="submitReq">
        <br>
        <select class="select-css" name ="category">
            <option>Category</option>
            <option>Apples</option>
            <option>Bananas</option>
            <option>Grapes</option>
            <option>Oranges</option>
        </select>
        <textarea class ="tArea" rows="8" cols="50" name="tArea"  required/>
Description Here.
        </textarea> 
        <br><br>
         <a href ="supportUser.php"><button id ="subsub" name="sub_request">Submit</button> </a>
        


    </div>-->
</div>
</body>
</html>

