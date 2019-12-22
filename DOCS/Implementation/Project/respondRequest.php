<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php 
include('respondProcess.php'); 
if (isset($_SESSION['username'])) {
    $usercheck2 = $_SESSION['username'];
     $sql3 = "select uname from admin where uname='$usercheck2'";
       $queryA = mysqli_query($conn, $sql3);
        $isAdminViewing = false;
        if (mysqli_num_rows($queryA) > 0) {
        $isAdminViewing = true;
    }
      if(!$isAdminViewing){
        header('location:errorPage.php');
    }
}
?>
    <?php
$ticketId = $_GET['varname'];
$sql = "SELECT * FROM ticket WHERE ticketId='$ticketId'";
$query = mysqli_query($conn, $sql);
$ticketArray = mysqli_fetch_assoc($query);
$user_uname = $ticketArray['user_uname'];
$rest_uname = $ticketArray['rest_uname'];
$category = $ticketArray['category'];
$description = $ticketArray['description'];
$isResponded = $ticketArray['isResponded'];
$respond = $ticketArray['respond'];
$admin_uname = $ticketArray['admin_uname'];
$date = $ticketArray['date'];
$count = mysqli_num_rows($query);
if ($count == 0) {
    header('location:errorPage.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
    <title>Respond Page</title>

</head>
<body>
<div class="container" id="fullC">

    <div class="top">
        <a href="SignOut.php"><button  id="signout">Sign Out </button></a>

        <a href='Admin.php'><button id="profile" ><?php echo $_SESSION['username'] ?></button></a>
        <a href="Admin.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
    <div id="formArea">
        <form class="formX" method="post" action="respondRequest.php?varname=<?php echo $ticketId ?>">
            <h1>Respond to Request</h1>
            <?php include('errors.php'); ?>
             <h3>Category : <?php echo $category ?></h3>
            <h3>Description</h3>
            <textarea placeholder ="<?php echo $description ?>"rows="8" cols="50" class="tArea" name="description" readonly></textarea>
            <h3>Answer</h3>
        <?php if ($isResponded == 0): ?>
                <textarea rows="8" cols="50" class="tArea" name="answer" required/></textarea>
                <button type="submit" id="subsub" name="respond_request">Submit</button>
            <?php endif ?>
            <?php if($isResponded == 1):?>
                <textarea placeholder ="<?php echo $respond ?>"rows="8" cols="50" class="tArea" name="answer" readonly></textarea>
            <?php endif ?>
             
        </form>

    </div>
    <div id="feedback">
        <?php include('feedbacks.php') ?>
        <?php if (count($feedbacks) > 0) : ?>
            <script> openFeedback();</script>
            <button onclick="window.location.href = 'Admin.php'">OK</button>
        <?php endif ?>
    </div>
</div>
</body>
</html>
