<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
session_start();
unset($_SESSION['username']); 
header("Location: index.php");

?>

