<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php
session_start();
session_destroy();
header('location:index.php');
?>

