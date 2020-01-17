
<?php

session_start();

include("dbconnect.php");
$feedbacks = array();
$errors = array();
if (isset($_POST['respond_request'])) { //STARTS WHEN CLICK THE SUBMIT BUTTON
//ENTER YOUR ANSWER TO TEXTAREA
    $textArea = mysqli_real_escape_string($conn, $_POST['answer']);
    $username = $_SESSION['username'];

    if (empty($textArea)) { //IF IT IS EMPTY PUSH ERROR
        array_push($errors, "Answer is required");
    }
    //IF THERE ARE NO ERROR, THEN UPDATE THE TICKET DATABASE'S RESPOND ATTRIBUTE TO TEXTAREA
    if (count($errors) == 0) {
        $ticketId = $_GET['varname'];
        $query31 = "UPDATE ticket SET respond='$textArea', admin_uname='$username', isResponded=1 WHERE ticketId='$ticketId'";
        mysqli_query($conn, $query31);
        $sql32 = "SELECT rest_uname, user_uname FROM ticket WHERE ticketId='$ticketId'";
        $query32 = mysqli_query($conn,$sql32);
        $array32 = mysqli_fetch_array($query32, MYSQLI_ASSOC);
        $sender=$array32['user_uname'];
        if($array32['user_uname']==NULL){
            $sender = $array32['rest_uname'];
        }else{
            $sender= $array32['user_uname'];
        }
        $notification2SQL = "insert into notification(toName,text,link,isRead) values('$sender','Your RequestTicket#$ticketId has been answered. Click to see the ticket.' ,'viewTickets.php?varname=$ticketId' ,0)";
        $queryNoti2 = mysqli_query($conn, $notification2SQL);
        //PUSH FEEDBACK
        array_push($feedbacks, "Your response has been sent.");
        array_push($feedbacks, "You will be redirected to your Admin panel when you click 'OK' button.");
    }
}
?>
