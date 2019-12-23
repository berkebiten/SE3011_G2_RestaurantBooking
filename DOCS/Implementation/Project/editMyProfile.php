<link rel="stylesheet" href="style.css"></link>
<?php
include 'editMyProfileProcess.php';
if (isset($_SESSION['username'])) {
    //CHECK IF THE USER IS RESTAURANTOWNER, IF IT IS NOT GO TO ERROR PAGE.
    $usercheck2 = $_SESSION['username'];
    $sql3 = "select uname from restaurant_owner where uname='$usercheck2'";
    $queryR = mysqli_query($conn, $sql3);
    $isOwnerViewing = false;
    if (mysqli_num_rows($queryR) > 0) {
        $isOwnerViewing = true;
    }
    if (!$isOwnerViewing) {
        header('location:errorPage.php');
        //END OF CHECKING.
    }
}
//GET THE USERNAME, AND FOR THAT USERNAME SELECT THE DATABASE ATTRIBUTES
$uname = $_GET['varname'];
$sql45 = "select * from restaurant_owner where uname='$uname'";
$query2 = mysqli_query($conn, $sql45);
$editArray = mysqli_fetch_array($query2, MYSQLI_ASSOC);
$fname = $editArray['fname'];
$lname = $editArray['lname'];
$restName = $editArray['rest_name'];
$location = $editArray['location'];
$phone = $editArray['phoneNo'];
$cap = $editArray['cap'];
$description = $editArray['description'];
$payment = $editArray['payment'];
$additional = $editArray['additional'];
$address = $editArray['address'];
$startTime = $editArray['startTime'];
$endTime = $editArray['endTime'];
$cuisines = $editArray['cuisines'];
$seating_options = $editArray['seating_options'];
$price = $editArray['price'];
$email = $editArray['email'];
//END OF ATTRIBUTES
//HOLD CUISINES AND SEATING OPTIONS IN VARIABLE TO REACH THEM LATER.
$checkedQ = mysqli_query($conn, "SELECT * FROM restaurant_owner WHERE uname='$uname'");
$checkedArray = mysqli_fetch_array($checkedQ, MYSQLI_ASSOC);
$checked = $checkedArray['cuisines'];
$checked1 = $checkedArray['seating_options'];
//END OF HOLDING
?>
<body>
    <div class="top">


        <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
        <a href='restaurantProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <a href ="support.php"><button id ="support"> Support</button> </a>
        <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>


    </div>
    <div class="container" id="fullC">
        <div id='formArea'>
            <form class='formX' method='post' action='editMyProfile.php?varname=<?php echo $uname ?>'>
            <?php include('errors.php'); ?>
                <div class="input-group">
                    <label for="fname">First Name</label>
                    <input class="input" type="text" placeholder="Enter First Name"name="fname" value="<?php echo $fname ?>"></input>
                </div>
                <div class="input-group">
                    <label for="lname">Last Name</label>
                    <input class="input" type="text"  placeholder="Enter Last Name"name="lname" value="<?php echo $lname ?>"></input>
                </div>
                <div class="input-group">
                    <label for="rName">Restaurant Name</label>
                    <input class="input" type="text" value="<?php echo $restName ?>" name="rName"></input>
                </div>
                <div class="input-group">
                    <label for="location">Location</label>
                    <input class="input" type="text" value="<?php echo $location ?>" name="location"></input>
                </div>
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input class="input" type="text" value="<?php echo $phone ?>" name="phone"></input>
                </div>
                <div class="input-group">
                    <label for="capacity">Capacity</label>
                    <input class="input" type="text" value="<?php echo $cap ?>" name="capacity"></input>
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea rows="8" cols="50" class="tArea" name="description"><?php echo $description ?></textarea>
                </div>
                <div class="input-group">
                    <label for="payment">Payment</label>
                    <input class="input" type="text" value="<?php echo $payment ?>" name="payment"></input>
                </div>
                <div class="input-group">
                    <label for="additional">Additional</label>
                    <input class="input" type="text" value="<?php echo $additional ?>" name="additional"></input>
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <input class="input" type="text" value="<?php echo $address ?>" name="address"></input>
                </div>

                <div class="input-group">
                    <label>Opening Time</label>
                    <select class="input" type="time" name="startTime" required>
                        <option value="<?php echo $startTime ?>" selected hidden><?php echo $startTime ?></option>
                        <option value="06:00:00">06:00</option>
                        <option value="07:00:00">07:00</option>
                        <option value="08:00:00">08:00</option>
                        <option value="09:00:00">09:00</option>
                        <option value="10:00:00">10:00</option>
                        <option value="11:00:00">11:00</option>
                        <option value="12:00:00">12:00</option>
                        <option value="13:00:00">13:00</option>
                        <option value="14:00:00">14:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="16:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>
                        <option value="18:00:00">18:00</option>
                        <option value="19:00:00">19:00</option>
                        <option value="20:00:00">20:00</option>
                        <option value="21:00:00">21:00</option>
                        <option value="22:00:00">22:00</option>
                        <option value="23:00:00">23:00</option>
                        <option value="24:00:00">24:00</option>              
                    </select>
                </div>
                <div class="input-group">
                    <label>Closing Time</label>
                    <select class="input" type="time" name="endTime" required>
                        <option value="<?php echo $endTime ?>"selected hidden><?php echo $endTime ?></option>
                        <option value="06:00:00">06:00</option>
                        <option value="07:00:00">07:00</option>
                        <option value="08:00:00">08:00</option>
                        <option value="09:00:00">09:00</option>
                        <option value="10:00:00">10:00</option>
                        <option value="11:00:00">11:00</option>
                        <option value="12:00:00">12:00</option>
                        <option value="13:00:00">13:00</option>
                        <option value="14:00:00">14:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="16:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>
                        <option value="18:00:00">18:00</option>
                        <option value="19:00:00">19:00</option>
                        <option value="20:00:00">20:00</option>
                        <option value="21:00:00">21:00</option>
                        <option value="22:00:00">22:00</option>
                        <option value="23:00:00">23:00</option>
                        <option value="24:00:00">24:00</option> 
                    </select>
                </div>
                <div class="cuisines">
                    <table>
                        <div class="input-group">
                            <tr><label>Cuisines</label></tr><br>
                        </div>
<!--MARKS THE CHECKBOX VALUES LIKE CUISINES AND SEATINGOPTIONS, IF THEY ARE NOT FALSE THEN SHOW IT WITH MARK, ELSE THEN DONT MARK IT-->
                        <?php if (strpos($checked, "Mediterranean Food") !== false): ?> 
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Mediterranean Food" checked>Mediterranean Food</input><br></tr>
                      <?php else: ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Mediterranean Food">Mediterranean Food</input><br></tr>
                        <?php endif ?>

                        <?php if (strpos($checked, "Turkish Food") !== false): ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Turkish Food" checked>Turkish Food</input><br>  </tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Turkish Food">Turkish Food</input><br>  </tr>
                        <?php endif ?>

                        <?php if (strpos($checked, "French Food") !== false): ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="French Food" checked>French Food</input><br></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="French Food">French Food</input><br></tr>
                        <?php endif ?>

                        <?php if (strpos($checked, "International") !== false): ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="International" checked>International</input><br></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="International">International</input><br></tr>
                        <?php endif ?>

                        <?php if (strpos($checked, "Grid&Steak") !== false): ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Grid&Steak" checked>Grid&Steak</input><br></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Grid&Steak">Grid&Steak</input><br></tr>
                        <?php endif ?>

                        <?php if (strpos($checked, "Fish") !== false): ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Fish" checked>Fish</input><br></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Fish">Fish</input><br></tr>
                        <?php endif ?>

                        <?php if (strpos($checked, "Aegean Food") !== false): ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Aegean Food" checked>Aegean Food</input><br></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Aegean Food">Aegean Food</input><br></tr>
                        <?php endif ?>

                        <?php if (strpos($checked, "Black Sea Food") !== false): ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Black Sea Food" checked>Black Sea Food</input><br></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Black Sea Food">Black Sea Food</input><br></tr>
                        <?php endif ?>

                        <?php if (strpos($checked, "Middle East Food") !== false): ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Middle East Food" checked>Middle East Food</input><br></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk" name="filter[]" value="Middle East Food">Middle East Food</input><br></tr>
                        <?php endif ?>     

                    </table>
                </div>

                <div class="seatingOptions">
                    <table>
                        <div class="input-group">
                            <tr><label>Seating Options</label></tr><br>
                        </div>
                        <?php if (strpos($checked1, "Bar") !== false): ?>
                            <tr><input type="checkbox" id="chk1" name="filter1[]" value="Bar" checked >Bar</input></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk1" name="filter1[]" value="Bar">Bar</input></tr>
                        <?php endif ?>
                        <?php if (strpos($checked1, "High Top") !== false): ?>
                            <tr><input type="checkbox" id="chk1" name="filter1[]" value="High Top" checked>High Top</input>  </tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk1" name="filter1[]" value="High Top">High Top</input>  </tr>
                        <?php endif ?>
                        <?php if (strpos($checked1, "Standard") !== false): ?>
                            <tr><input type="checkbox" id="chk1" name="filter1[]" value="Standard" checked >Standard</input></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk1" name="filter1[]" value="Standard">Standard</input></tr>
                        <?php endif ?>
                        <?php if (strpos($checked1, "Outdoor") !== false): ?>
                            <tr><input type="checkbox" id="chk1" name="filter1[]" value="Outdoor" checked >Outdoor</input></tr>
                        <?php else: ?>
                            <tr><input type="checkbox" id="chk1" name="filter1[]" value="Outdoor">Outdoor</input></tr>
                        <?php endif ?>
                    </table>
<!--                    END OF MARKING-->
                </div>

<!--//PRESS THE BUTTON AND DO THE OPERATIONS ON HREF LINK-->
                <a href='editMyProfileProcess.php?varname=<?php echo $uname ?>'><button type='submit' class='btn' name='editRestaurant'>Edit</button></a> 
<!--                END OF OPERATION-->
            </form>   
        </div>
        <div  id="feedback">
            <?php include('feedbacks.php') ?>
            <?php if (count($feedbacks) > 0) : ?>
<!--            //SHOW THE FEEDBACK AND GO TO RESTAURANT PROFILE PAGE-->
                <script> openFeedback();</script>
                <button onclick="window.location.href = 'restaurantProfile.php?varname=<?php echo $uname ?>'" >OK</button>
            <?php endif ?>
        </div>
    </div>
</body>
