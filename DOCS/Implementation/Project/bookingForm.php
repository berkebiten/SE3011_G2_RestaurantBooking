<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
include('session.php');
?>
<html>
    <style>
        .input{
            display:block;
        }
        #form{
            margin-left :500px; ;
            margin-top :100px; ;

        }
    </style>
    
    <body>
    <div id="form">
        <form method="post" action="book.php">            
            <label for="lname">Restaurant Name</label>
            <input class="input" type="text" name="rName" ></input>
            <br>
            <label for="lname">Date</label>
            <input class="input" type="date" name="date" ></input>
            <br>
            <label for="lname">Time</label>
            <input class="input" type="time" name="time"></input>
            <br>
            <label for="lname">Phone</label>
            <input class="input" type="text" name="phoneNo"></input>
            <br>
            <label for="lname">First Name</label>
            <input class="input" type="text" name="fname"></input>
            <br>
            <label for="lname">Last Name</label>
            <input class="input" type="text"  name="lname"></input>
            <br>
            <label for="lname">Email</label>
            <br>
            <input class="input" type="text"  name="email"></input>
            <br>
            <label for="lname">Party Size</label>
            <input class="input" type="text"  name="party"></input>
            <br>
            <input type="submit" id="search" value="BOOK">
        </form>  
    </div>
</body>
</html>

