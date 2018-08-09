<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "bbs";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die("unable to connect to database.");

if (!$conn) {

die("Connection failed: " . mysqli_connect_error());

}
mysqli_select_db($conn,$dbname) or die ("Unable to select");

?>