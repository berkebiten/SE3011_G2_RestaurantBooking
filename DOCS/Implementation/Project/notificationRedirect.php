<?php
include("dbconnect.php");
$ticketID = (int)$_GET['varname'];
echo $ticketID;
$sqlTicket = "SELECT * FROM notification where id= $ticketID ";
$queryTicket = mysqli_query($conn, $sqlTicket);
$ticketArr = mysqli_fetch_assoc($queryTicket);

$link = $ticketArr['link'];
if ($link == '#') {
    $link = "notifications.php";
}
$num = 1;
$sqlUpdate = "UPDATE notification SET isRead=$num WHERE id=$ticketID";
$queryUpdate = mysqli_query($conn, $sqlUpdate);
header('location:' . $link);
?>

