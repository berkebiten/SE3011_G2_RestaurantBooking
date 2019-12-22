
<?php
session_start();

include("dbconnect.php");
$feedbacks = array();
$errors = array();
if (isset($_POST['respond_request'])) {

    $textArea = mysqli_real_escape_string($conn, $_POST['answer']);
    $username = $_SESSION['username'];

    if (empty($textArea)) {
        array_push($errors, "Answer is required");
    }
    if (count($errors) == 0) {
        $ticketId = $_GET['varname'];
         $query31= "UPDATE ticket SET respond='$textArea', admin_uname='$username', isResponded=1 WHERE ticketId='$ticketId'";
        mysqli_query($conn, $query31);
          array_push($feedbacks, "Your response has been sent.");
        array_push($feedbacks, "You will be redirected to your Admin panel when you click 'OK' button.");
    }
}
?>
