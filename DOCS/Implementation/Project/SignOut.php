<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
session_start();
$_SESSION['username'] = null; 
header("Location: index.php");

?>

