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
<?php if ($isAdminViewing) : // CHECK IF THE VIEWER IS AN ADMIN OR NOT ?>
    <html>
        <body>
        <div class="container" id="fullC">
            <div class="top">
                <a href = "SignOut.php"><button action = "SignOut.php" id="signout">Sign Out </button></a>
                <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
                <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
            </div>
            <div id="formArea">
                <?php echo "<form class='formX' method='post' action='banProcess.php?varname=$varname'>" ?>
                <?php include('errors.php') ?>
                <div class="input-group">
                    <label>Username</label>
                    <input class="input" type="text" value="<?php echo $varname ?>" placeholder="<?php echo $rest_name //SEE THE RESTAURANT NAME BUT CAN ONLY READ     ?>" name="uname" readonly></input>
                </div>
                <div class="input-group">
                    <label>Reason</label><br>
                    <textarea class="input" name="reason"></textarea>
                </div>
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

