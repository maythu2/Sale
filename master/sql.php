<?php 
include("confs/config.php"); 
ini_set('display_errors', 1);
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
// to retrieve user name
$id = $_SESSION['id'];
$sql = "SELECT u.username,u.group_id,g.group_name 
		FROM db_user u
		LEFT JOIN db_group g ON u.group_id = g.group_id 
		WHERE u.user_id= '$id' ";

$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);

// to retrieve class 
$sql = "SELECT * FROM class_master";
$class = mysqli_query($conn,$sql);

?>