<!DOCTYPE html>
<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php
include('banProcess.php');
include('dbconnect.php');
if (!isset($_SESSION['success'])) {
    header('location:errorPage.php');
}
$varname = $_GET['varname'];
$usercheck2 = $_SESSION['username']; // SESSION USERNAME
$sql3 = "select uname from admin where uname='$usercheck2'"; //SELECTING USERNAME FROM THE ADMIN TABLE WHERE THE USERNAME IS THE SESSION USERNAME
$queryA = mysqli_query($conn, $sql3);
$isAdminViewing = false;
if (mysqli_num_rows($queryA) > 0) {
    $isAdminViewing = true;
}
?>
<?php
if (isset($_SESSION['username'])) {
    include('notificationCounter.php');
}
?>
<?php if ($isAdminViewing) : // CHECK IF THE VIEWER IS AN ADMIN OR NOT ?>
    <html>
        <body>
        <div class="container" id="fullC">
            <div class="top">
                <a href = "SignOut.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
                <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>

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

                            <?php
                            $whilecount++;
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

                            <?php
                            $whilecount++;
                        endwhile
                        ?>
                        <a style="font-weight:bold;" href="notifications.php">See All</a>
                    </div>
                </div>
                <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
            </div>
            <div id="formArea">
    <?php echo "<form class='formX' method='post' action='banWarnForm.php?varname=$varname'>" ?>
    <?php include('errors.php') ?>
                <div class="input-group">
                    <label>Username</label>
                    <input class="input" type="text" value="<?php echo $varname ?>" placeholder="<?php echo $rest_name //SEE THE RESTAURANT NAME BUT CAN ONLY READ         ?>" name="uname" readonly></input>
                </div>

                <label>Reason</label><br>
                <textarea class="tArea" name="reason" style="width:155%;"></textarea>

                <div class="input-group">
                    <select class="input" name="type">
                        <option value="Ban">Ban</option>
                        <option value="Warn">Warn</option>
                    </select>
                </div>
                <div class="input-group">
                    <?php
                    echo "<a href='banProcess.php?varname=$varname'><button type='submit' class='btn' name='ban'>Submit</button></a>";
                    ?>
                </div>
            </div>
            <div id="feedback">
    <?php include('feedbacks.php') ?>
                <?php if (count($feedbacks) > 0) : ?>
                    <script> openFeedback();</script>
                    <button onclick="window.location.href = ''">OK</button>
        <?php endif ?>
            </div>
        </div>
    <?php endif ?>
    <?php if (!$isAdminViewing) : ?>
        <?php header('location:errorPage.php'); ?>
<?php endif ?>

