<?php
include('accountsProcess.php');


if (!isset($_SESSION['success'])) {//REDIRECTS THE USER TO THE INDEX IF VIEWER IS A GUEST
    header('location:index.php');
}

//INITIALIZING VARIABLES AND DETERMINING THE USER TYPE
$username = $_SESSION['username'];
$usercheck2 = $_SESSION['username'];
$sql = "select * from restaurant_owner where uname = '$usercheck2'";
$sql2 = "select uname from user where uname='$usercheck2'";
$sql3 = "select uname from admin where uname='$usercheck2'";
$query6 = mysqli_query($conn, $sql);
$queryU = mysqli_query($conn, $sql2);
$queryA = mysqli_query($conn, $sql3);
$isMyProfile = false;
$isUserViewing = false;
$isAdminViewing = false;

$isARestaurantViewing = false;

if (mysqli_num_rows($query6) > 0) {//IF VIEWER IS A RESTAURANT
    $isARestaurantViewing = true;
}
if (mysqli_num_rows($queryU) > 0) {//IF VIEWER IS A USER
    $isUserViewing = true;
}
if (mysqli_num_rows($queryA) > 0) {//IF VIEWER IS AN ADMIN
    $isAdminViewing = true;
}
if ($isARestaurantViewing || $isAdminViewing) {// REDIRECTS THE VIEWER TO THE ERRORPAGE IF VIEWER IS AN ADMIN OR RESTAURANT OWNER 
    header('location: errorPage.php');
}
?>

<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
}
?>
<html>
    <head>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <script src="scripts.js"></script>
        <?php include('bootstrapinclude.php') ?>
    </head>


    <body>
    <div class="container" id="fullC">
        <div class="top">
            <a href="SignOut.php"><button  id="signout">Sign Out </button></a>
            <!-- PROFILE BUTTON NAVIGATION DYNAMISM RELATED TO ACCOUNT TYPE !-->
            <?php if ($isAdminViewing): ?>
                <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <?php endif ?>
            <?php if ($isUserViewing): ?>
                <a href='userProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <?php endif ?>
            <?php if ($isARestaurantViewing): ?>
                <a href='restaurantProfile.php?varname=<?php echo $_SESSION['username'] ?>'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
            <?php endif ?>

            <?php if (!$isAdminViewing): ?>
                <a href ="support.php"><button id ="support"> Support</button></a>
            <?php endif ?>
            <div class="dropdown">
                <a href="notifications.php" class="notification">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <?php if ($unreadCount > 0): ?>
                        <span class = "badge"><?php echo $unreadCount;
                        ?></span>
                    <?php endif ?>
                </a>
                <div class="dropdown-content">
                    <p style="font-weight:bold;font-size:20px;"> Notifications </p>
                    <?php
                    $whilecount = 1;
                    while ($row = mysqli_fetch_array($queryUnread, MYSQLI_ASSOC)):
                        $date_sent = $row['date_sent'];
                        $date_sent = date("m/d/y H:m", strtotime($date_sent));
                        $text = $row['text'];
                        $link = $row['link'];
                        ?>
                        <a href="notificationRedirect.php?varname=<?php echo $row['id']; ?>">

                            <div style="width:100%;" class="notificationCard">
                                <p style="color:black;font-size:12px;"><?php echo $date_sent ?></p><p><?php echo $text; ?><p><i class="fa fa-circle" aria-hidden="true"></i>
                            </div>
                        </a>

                        <?php $whilecount++;
                    endwhile
                    ?>
                    <?php
                    while ($row = mysqli_fetch_array($queryRead, MYSQLI_ASSOC)):
                        $text = $row['text'];
                        $link = $row['link'];
                        ?>
                        <a href="notificationRedirect.php?varname=<?php echo $date_sent ?>">

                            <div style="background-color:#388CF2;color:white;border-color:white;width:100%;" class="notificationCard">
                                <p style="color:white;font-size:12px;"><?php echo $row['date_sent'] ?></p><p><?php echo $text; ?><p><i class="fa fa-check-circle" aria-hidden="true"></i>
                            </div>

                        </a>

                        <?php $whilecount++;
                    endwhile
                    ?>
                    <a style="font-weight:bold;" href="notifications.php">See All</a>
                </div>
            </div>
            <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>
        <div id="formArea">
            <h1>ACCOUNT SETTINGS</h1>
            <div class="centerForms">
                <div class="changePassword" id="formArea" >
                    <form class="formX1" method="post" action="accountSettings.php">
                        <h1>Change Password</h1>
<?php include('errors.php'); ?>
                        <div class="input-group">
                            <label>Current Password</label>
                            <input placeholder="Current Password" type="password" name="current_password" required/>
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
                            <input placeholder="Re-enter your new password" type="password"  name="password_2" required/>
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn" name="changePassword">Confirm</button>
                        </div>
                    </form>
                </div>

                <div class="changeEmail" id="formArea" >
                    <form class="formX1" method="post" action="accountSettings.php">
                        <h1>Change Email</h1>
<?php include('errors.php'); ?>
                        <div class="input-group">
                            <label>Current Email</label>
                            <input placeholder="Current email" type="email" name="current_email" value="<?php echo $current_email ?>" pattern="[a-z0-9._%+-]+@gmail\.com$"  title="Your email must be gmail type."  required/>

                            <br><br>
                        </div>
                        <div class="input-group">    
                            <label><b>New Email</b></label>
                            <input placeholder="Your new email" type="email"  name="email_1" value="<?php echo $email_1 ?>"  pattern="[a-z0-9._%+-]+@gmail\.com$"  title="Your email must be gmail type."  required/>
                            <div class="help_text">
                                <style>
                                    .fa-info-circle a{
                                        color:#E0AE43;
                                    }
                                    .fa-info-circle a:hover{
                                        color:darksalmon;
                                    }
                                </style>
                                <i class="fa fa-info-circle" style="color:black;" aria-hidden="true">  Your new e-mail must be gmail type. </i>

                            </div>
                        </div>
                        <div class="input-group">    
                            <label><b>Confirm Email</b></label>
                            <input placeholder="Re-enter your new Email" type="email"  name="email_2" value="<?php echo $email_2 ?>"  pattern="[a-z0-9._%+-]+@gmail\.com$"  title="Your email must be gmail type."   required/>
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn" name="changeEmail">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="feedback">
            <?php include('feedbacks.php') ?>
<?php if (count($feedbacks) > 0) : ?>
                <?php $fp = false; ?>
                <script> openFeedback();</script>
                <button onclick="window.location.href = 'userProfile.php?varname=<?php echo $_SESSION['username']; ?>'">OK</button>
<?php endif ?>
        </div>
    </div>
</body>
</html>




