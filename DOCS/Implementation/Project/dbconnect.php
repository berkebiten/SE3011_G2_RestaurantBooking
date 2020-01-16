<?php
include('bootstrapinclude.php');
$dbname = "rbsdb"; // database name
$conn = mysqli_connect("localhost", "root",""); //establishing connection with the database 
if (!$conn) {
    die('not connected:'.mysqli_error()); // it is the error that is given after a failed database connection
}
$b = mysqli_select_db($conn, $dbname); // selecting the database schema
if (!$b) {
    die("db couldn't retrieved".mysqli_error($dbname)); // its the error that is given after a failed retrieval of a database schema
}

?>
<?php