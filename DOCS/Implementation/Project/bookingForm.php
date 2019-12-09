<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
include('session.php');
?>
<html>
    <body>
        <div class="container" id="fullC">
            <div class="formArea">
                <form class="formX" method="post" action="book.php">
                    <h1>Booking</h1>
                    <div class="input-group">
                        <label for="rName">Restaurant Name</label>
                <input class="input" type="text" value="" placeholder="" name="rName" readonly></input>
                    </div>
                    <div class="input-group">
                        <label for="date">Date</label>
                <input onclick="dateConstraint()" class="input" id="bookingDate" type="date" name="date" reqired></input>
                    </div>
                    <div class="input-group">
                        <label for="time">Time</label>
                <input class="input" id="bookingTime" type="time" name="time" required></input>
                    </div>
                    <div class="input-group">
                        <label for="phoneNo">Phone</label>
                <input class="input" type="text" placeholder="Enter Phone Number" name="phoneNo" required></input>
                    </div>
                    <div class="input-group">
                        <label for="fname">First Name</label>
                <input class="input" type="text" placeholder="Enter First Name"name="fname" required></input>
                    </div>
                    <div class="input-group">
                        <label for="lname">Last Name</label>
                <input class="input" type="text"  placeholder="Enter Last Name"name="lname" required></input>
                    </div>
                    <div class="input-group">
                        <label>Email</label>
                        <input placeholder="Your Email Address" type="email" name="email" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
                    </div>
                    <div class="input-group">
                        <label for="lname">Party Size</label>
                <input class="input" type="text" placeholder="Enter Party Size" name="party" required></input>
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn" name="reg_user">Register</button>
                    </div>
                    <p>
                        Already a member? <a href="signIn.php">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
        <!--    <div id="form">
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
            </div>-->
    </body>
</html>

