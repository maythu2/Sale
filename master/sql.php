<?php 
include("confs/config.php"); 
ini_set('display_errors', 1);
session_start();

// to retrieve user name
$id = $_SESSION['id'];
$sql = "SELECT u.username,u.group_id,g.group_name 
		FROM db_user u
		LEFT JOIN db_group g ON u.group_id = g.group_id 
		WHERE u.user_id= '$id' ";

$result = mysql_query($sql,$conn);
$user = mysql_fetch_assoc($result);

// to retrieve class 
$sql = "SELECT * FROM class_master";
$class = mysql_query($sql,$conn);

?>