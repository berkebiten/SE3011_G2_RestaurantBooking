<?php
$dbname = "rbsdb";
$conn = mysqli_connect("localhost", "root","");
if (!$conn) {
    die('not connected:'.mysqli_error());
}
$b = mysqli_select_db($conn, $dbname);
if (!$b) {
    die("db couldn't retrieved".mysqli_error($dbname));
}

?>
<?php