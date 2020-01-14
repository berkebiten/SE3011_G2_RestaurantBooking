<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<?php include('bootstrapinclude.php') ?>
<?php

session_start();
session_destroy();//DESTROYS ALL OF THE SESSION'S VARIABLES
header('location:index.php');
?>

