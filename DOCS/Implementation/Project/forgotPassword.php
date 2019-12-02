<?php
include("dbconnect.php");
$recoveryCode = filter_input(INPUT_POST, 'recCode');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$rpassword = filter_input(INPUT_POST, 'rpassword');
$passwrd= md5($passwrd);

$sql =mysqli_query($conn,"select * from user where email='$email' and recCode = '$recoveryCode' ");
$count = mysqli_num_rows($sql);
if ($count==1 && $password == $rpassword) {
    header("location:returnHP.php");
   
 $sql2 =mysqli_query($conn,"UPDATE user SET psw = '$password'  WHERE (email = '$email')");
 
        header("location:returnHP.php");
        
}
else if ($count ==1 && $password != $rpassword){
    echo "<script> alert('The account has already been registered.:)'); </script> "; 
   
}
else {
         echo "<font size='3'>Wrong E-Mail or Recovery Code.</font> ";

    //header("location:returnHP.php");
}
?>

