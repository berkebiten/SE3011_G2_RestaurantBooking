<?php
include("dbconnect.php");
$username44 = $_SESSION['username'];
$sqlNoti = "SELECT * FROM notification WHERE toName = '$username44' ORDER BY date_sent DESC " ;
$sqlUnread = "SELECT * FROM notification WHERE toName = '$username44' and isRead = 0 ORDER BY date_sent DESC";
$sqlRead = "SELECT * FROM notification WHERE toName = '$username44' and isRead = 1 ORDER BY date_sent DESC";
$queryNoti = mysqli_query($conn, $sqlNoti);
$queryUnread = mysqli_query($conn, $sqlUnread);
$queryRead = mysqli_query($conn, $sqlRead);
$unreadCount = mysqli_num_rows($queryUnread);

?>