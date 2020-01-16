<!DOCTYPE html>
<link href="style.css" rel="stylesheet" ></link>
<?php include('bootstrapinclude.php') ?>
<script src="scripts.js" type="text/javascript"></script>
<?php
include('accountsProcess.php');
include("dbconnect.php");
if (!isset($_SESSION['success'])) {
    header('location: index.php'); //IF THERE IS NO SESSION REDIRECT TO INDEX
} else { //IF SESSION EXISTS BUT THE VIEWER IS NOT ADMIN REDIRECT TO INDEX
    $username = $_SESSION['username'];
    $query = mysqli_query($conn, "select * from admin where uname = '$username'");
    $counta = mysqli_num_rows($query);
    if ($counta != 1) {
        header("location:index.php");
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN PANEL</title>


</head>
<body>

<div class=container id="fullC">
    <div class="top">
        <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
        <button id="profile" ><?php echo $_SESSION['username'] ?></button>
        <a href="Admin.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
    <div class="wholepanel">
        <div class="adminpanel">
            <ul>
                <h1> Admin Panel </h1>
                <li><a onclick="openViewTickets()">View Request Tickets</a></li>
                <li><a onclick="openRestSignUps()">View Restaurant Signups</a></li>
                <li><a onclick="openAdminSearch()">Search</a></li>
                <li><a onclick="openAccountSettings2()">Account Settings</a></li>
            </ul>
        </div>
        <div class="functions">

            <div class="adminsearchpart" id="adminsearch">
                <input type="text" id="adminsearchinput" onkeyup="searchFilterFunction()" placeholder="Search for usernames.." title="Type in a username"/>
                <div class="old_ie_wrapper">
                    <table id="adminSearchTable">
                        <thead>
                            <tr class="head">
                                <th style="width:60%;">Username</th>
                                <th style="width:40%;">Acc_Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //PRINTS ALL THE REGISTERED USERS 
                            $query = mysqli_query($conn, "select * from restaurant_owner ");
                            $query2 = mysqli_query($conn, "select * from user ");
                            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                $rest_uname = $row['uname'];
                                if ($row['isBanned'] == 1) {
                                    echo "<tr> <td><a href='restaurantProfile.php?varname=$rest_uname'> " . $row["uname"] . "</a></td>"
                                    . "<td> " . "Restaurant Owner" ."</td><td>". "<a href='banWarnForm.php?varname=$rest_uname'><button>Unban</button></a>" . " </td> </tr>";
                                } else {
                                    echo "<tr> <td><a href='restaurantProfile.php?varname=$rest_uname'> " . $row["uname"] . "</a></td>"
                                    . "<td> " . "Restaurant Owner" ."</td><td>". "<a href='banWarnForm.php?varname=$rest_uname'><button>Ban/Warn</button></a>" . " </td> </tr>";
                                }
                            }
                            while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
                                $user_uname = $row2['uname'];
                                if ($row2['isBanned'] == 1) {
                                    echo "<tr> <td><a href='userProfile.php?varname=$user_uname'> " . $row2["uname"] . "</a></td>"
                                    . "<td> " . "User" . " </td> <td>" . "<a href='banWarnForm.php?varname=$user_uname'><button>Unban</button></a>" . "</td></tr>";
                                } else {
                                    echo "<tr> <td><a href='userProfile.php?varname=$user_uname'> " . $row2["uname"] . "</a></td>"
                                    . "<td> " . "User" . " </td> <td>" . "<a href='banWarnForm.php?varname=$user_uname'><button>Ban/Warn</button></a>" . "</td></tr>";
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>


            <div class="adminsearchpart" id="viewTickets">
                <div class="old_ie_wrapper">
                    <table id="viewTicketsTable">
                        <thead>
                            <tr class="head">
                                <th>Username</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Is Responded</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //PRINTS ALL THE TICKETS
                            $query = mysqli_query($conn, "select user_uname,category,date,isResponded,ticketId from ticket where isResponded=0 AND user_uname is not null ");
                            $query2 = mysqli_query($conn, "select rest_uname,category,date,isResponded, ticketId from ticket where isResponded=0 AND rest_uname is not null");
                            $query3 = mysqli_query($conn, "select user_uname,category,date,isResponded, ticketId from ticket where isResponded=1 AND user_uname is not null");
                            $query4 = mysqli_query($conn, "select rest_uname,category,date,isResponded, ticketId from ticket where isResponded=1 AND rest_uname is not null");

                            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {//FIRST PRINT NOT RESPONDED TICKETS SENT BY USERS
                                $ticketId = $row['ticketId'];

                                echo "<tr> <td> <a href='respondRequest.php?varname=$ticketId'>" . $row['user_uname'] . "</td>"
                                . "<td> " . $row['category'] . " </td> "
                                . "<td>" . $row['date'] . "</td>"
                                . "<td>" . "No" . "</td> </tr>";
                            }
                            while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {//SECOND PRINT NOT RESPONDED TICKETS SENT BY RESTAURANT OWNERS
                                $ticketId = $row2['ticketId'];
                                echo "<tr> <td><a href='respondRequest.php?varname=$ticketId'>" . $row2['rest_uname'] . "</td>"
                                . "<td> " . $row2['category'] . " </td> "
                                . "<td>" . $row2['date'] . "</td>"
                                . "<td>" . "No" . "</td> </tr>";
                            }
                            while ($row = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {//THIRD PRINT RESPONDED TICKETS SENT BY USERS
                                $ticketId = $row['ticketId'];
                                echo "<tr> <td><a href='respondRequest.php?varname=$ticketId'>" . $row['user_uname'] . "</td>"
                                . "<td> " . $row['category'] . " </td> "
                                . "<td>" . $row['date'] . "</td>"
                                . "<td>" . "Yes" . "</td> </tr>";
                            }
                            while ($row2 = mysqli_fetch_array($query4, MYSQLI_ASSOC)) {//FINALLY PRINT RESPONDED TICKETS SENT BY USERS
                                $ticketId = $row2['ticketId'];
                                echo "<tr> <td><a href='respondRequest.php?varname=$ticketId'>" . $row2['rest_uname'] . "</td>"
                                . "<td> " . $row2['category'] . " </td> "
                                . "<td>" . $row2['date'] . "</td>"
                                . "<td>" . "Yes" . "</td> </tr>";
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>

            <div class="adminsearchpart" id="viewRestSignUps">
                <div class="old_ie_wrapper">
                    <table id="viewRestSignUps">
                        <thead>
                            <tr class="head">
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Restaurant Name</th>
                                <th>E-mail</th>
                                <th>Location</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Capacity</th>
                                <th>Accept</th>
                                <th>Decline</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "Select * from rest_signup"); //FIND THE RESTAURANT SIGNUP APPLICATIONS

                            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {//PRINT THE RESTAURANT SIGNUP APPLICATIONS
                                $uname = $row['uname'];

                                echo "<tr> <td>" . $row['uname'] . "</td>"
                                . "<td> " . $row['fname'] . " </td> "
                                . "<td>" . $row['lname'] . "</td>"
                                . "<td> " . $row['rest_name'] . " </td> "
                                . "<td>" . $row['email'] . "</td>"
                                . "<td>" . $row['location'] . "</td>"
                                . "<td> " . $row['phoneNo'] . " </td> "
                                . "<td>" . $row['address'] . "</td>"
                                . "<td> " . $row['startTime'] . " </td> "
                                . "<td>" . $row['endTime'] . "</td>"
                                . "<td>" . $row['cap'] . "</td>"
                                . "<td> <a href='acceptProcess.php?varname=$uname'><button type='submit' class='btn' name='booking'>Accept</button></a></td>"
                                . "<td> <a href='declineProcess.php?varname=$uname'><button type='submit' class='btn' name='booking'>Decline</button></a></td>"
                                . "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="adminsearchpart" id="accountSettings">

                <div class="changePassword" id="formArea" >
                    <form class="formX1" method="post" action="Admin.php">
                        <h1>Change Password</h1>
                        <?php include('errors.php'); ?>
                        <div class="input-group">
                            <label>Current Password</label>
                            <input placeholder="Current Password" type="password" name="current_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}" 
                                   title="Must contain at least one number and one uppercase and lowercase letter, and between 8-50 characters" required/>
                            <br><br>
                        </div>
                        <div class="input-group">    
                            <label><b>New Password</b></label>
                            <input placeholder="Your new password" type="password"  name="password_1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}" 
                                   title="Must contain at least one number and one uppercase and lowercase letter, and between 8-50 characters" required/>
     <div class="help_text">
                                <style>
                                    .fa-info-circle a{
                                        color:#E0AE43;
                                    }
                                    .fa-info-circle a:hover{
                                        color:darksalmon;
                                    }
                                </style>
                                <i class="fa fa-info-circle" style="color:black;" aria-hidden="true">  Your new password must contain atleast one number and one uppercase and lowercase letter, and between 8-50 characters. </i>

                            </div>

                        </div>
                        <div class="input-group">    
                            <label><b>Confirm Password</b></label>
                            <input placeholder="Re-enter your new password" type="password"  name="password_2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}" 
                                   title="Must contain at least one number and one uppercase and lowercase letter, and between 8-50 characters" required/>
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn" name="changePassword">Confirm</button>
                        </div>
                    </form>
                </div>

                <div class="changeEmail" id="formArea" >
                    <form class="formX1" method="post" action="Admin.php">
                        <h1>Change Email</h1>
                        <?php include('errors.php'); ?>
                        <div class="input-group">
                            <label>Current Email</label>
                            <input placeholder="Current email" type="email" name="current_email" value="<?php echo $current_email ?>" pattern="[a-z0-9._%+-]+@gmail\.com$" required/>
                            <br><br>
                        </div>
                        <div class="input-group">    
                            <label><b>New Email</b></label>
                            <input placeholder="Your new email" type="email"  name="email_1" value="<?php echo $email_1 ?>" pattern="[a-z0-9._%+-]+@gmail\.com$" required/>
                  <div class="help_text">
                    <style>
                        .fa-info-circle a{
                          color:#E0AE43;
                        }
                        .fa-info-circle a:hover{
                            color:darksalmon;
                        }
                    </style>
                    <i class="fa fa-info-circle" style="color:black;" aria-hidden="true">  Your e-mail must be gmail type.</i>
                    
                </div>

                        </div>
                        <div class="input-group">    
                            <label><b>Confirm Email</b></label>
                            <input placeholder="Re-enter your new Email" type="email"  name="email_2" value="<?php echo $email_2 ?>" pattern="[a-z0-9._%+-]+@gmail\.com$" required/>
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn" name="changeEmail">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--            FEEDBACKS-->
            <div id="feedback">
                <?php include('feedbacks.php') ?>
                <?php if (count($feedbacks) > 0) : ?>
                    <script> openFeedback();</script>
                    <button onclick="window.location.href = 'Admin.php'">OK</button>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

