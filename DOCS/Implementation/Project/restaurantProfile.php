<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<html>
<head>
    <meta charset="UTF-8">
<title>RESTAURANT</title>
</head>
<body>
<div class="top">
    <button onclick="openForm2()"  id="rsignup">Restaurant Sign Up</button>
    <button onclick="openForm3()"  id="signup" >Sign Up</button>
    <button onclick="openForm()"   id="signin" >Sign In</button>         
    <a href="RestaurantOwner.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
</div>
<h1 style="text-align : center">RESTAURANT NAME</h1>
<div id="full">
<div id="firstPart">
    <div id="description">
        <br>
        <p>20% discount on the total bill between 2 pm – 6 pm!
With Istanbul at your feet, the City Lights Bar is the perfect spot to unwind while 
enjoying the finest wines, personalised cocktails, delicious appetisers and the most delectable 
of desserts. Immerse yourself in the energising nightlife of City Lights and be captivated 
by the rhythm of the music.</p>
    </div>
 
    <div id="menu">
        MENU
    </div>
</div>
<div id="secondPart">
   <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img class="restPics" src="img/1.jpg">
                <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img class="restPics" src="img/2.jpg">
                <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img class="restPics" src="img/3.jpg">
                <div class="text">Caption Three</div>
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>
    <div id="infos">
        <p class="infos"><h3>Address</h3> Seyrantepe mah. Çalışkan sok. no:24/11</p>
    <p class="infos"><h3>Hours of operation</h3> Daily 2:00 pm–2:00 am</p>
        <p class="infos"><h3>Payment Options </h3> AMEX, Diners Club, MasterCard, Visa</p>
        <p class="infos"><h3>Additional </h3> Bar/Lounge, Beer, Cocktails, Corkage Fee, Dancing, 
            Entertainment, Full Bar, Outdoor Smoking Area, View, Wheelchair Access, Wine</p>
        <p class="infos"><h3>Phone number </h3> 0537 923 59 86 </p>
    </div>
</div>
</div>
<div id="reviews">
    <h2>REVIEWS</h2>
</div>
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


<div class = "form-popup" id="signUp">
    <form method="post" class="form-container" action="signUp.php">
        <h3>Sign Up</h3>
        <label for="fname">First Name</label>
        <input placeholder="Enter first name" type="text" name="fname" required/>
        <br><br>
        <label for="lname">Last Name</label>
        <input placeholder="Enter last name" type="text" name="lname" required/>
        <br><br>
        <label for="uname">Username</label>
        <input placeholder="Enter username" type="text" name="uname" required/>
        <br><br>
        <label for="email">E-Mail</label>
        <input placeholder="Enter email" type="email" name="email"  required/>
        <br><br>
        <label for="psw">Password</label>
        <input placeholder="Enter password" type="password" name="psw" required/>
        <button type="button" id="cancel" onclick="closeForm()">Cancel</button>
        <input type="submit" id = "ca" value="Create Account">
    </form>
</div>

<div class="form-popup" id="restSignUp">
    <form method="post" class="form-container" action="restSignUp.php"> <h3>Restaurant Sign Up</h3>
        <label for="fname">First Name</label>
        <input placeholder="Enter first name" class="rSign" type="text" name="fname" required/>
        <br><br>
        <label for="lname">Last Name</label>
        <input placeholder="Enter last name" class="rSign" type="text" name="lname" required/>
        <br><br>
        <label for="uname">Username</label>
        <input placeholder="Enter username" class="rSign" type="text" name="uname" required/>
        <br><br>
        <label for="uname">Restaurant Name</label>
        <input placeholder="Enter restaurant name" class="rSign" type="text" name="rname" required/>
        <br><br>
        <label for="email">E-Mail</label>
        <input placeholder="Enter email" class="rSign" type="email" name="email" required/>
        <br><br>
        <label for="psw">Password</label>
        <input placeholder="Enter password" class="rSign" type="password" name="psw" required/>
        <label for="uname">Phone No</label>
        <input placeholder="Enter phone no" class="rSign" type="text" name="phone" required/>
        <br><br>
        <label for="uname">Adress</label>
        <input placeholder="Enter address" class="rSign" type="text" name="adress" required/>
        <br><br>
        <label for="cap">Restaurant Capacity</label>
        <input placeholder="Capacity" class="rSign" type="number" name="cap" min="1" required/>
        <br><br>
        <button type="button" id="cancel" onclick="closeForm()">Cancel</button>
        <input type="submit" id = "ca" value="Create Account">
    </form>
</div>

<div class = "form-popup" id="forgotpsw">
    <form method="post" class="form-container">
        <label for="cap">Enter your recovery code and your password will reset.</label>
        <input type="text" placeholder="Recovery Code"></input>
        <button type="button" id="cancel" onclick="closeForm()">Cancel</button>
        <button type="button" id="ca">Send</button>
    </form>
</div>
</body>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);
</script>
</html>