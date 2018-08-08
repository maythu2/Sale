<?php
session_start();
include("../confs/config.php");

ini_set('display_errors', 1);

$user_id = $_POST['id'];
$password = $_POST['password'];

$sql = "SELECT * FROM db_user WHERE user_id = '$user_id' and pw = '$password'";

$result = mysql_query($sql,$conn);

$row = mysql_fetch_assoc($result);

if(isset($row['user_id'])) {
	if ($row['admin'] == 1) {
		$_SESSION['auth'] = true;
		$_SESSION['middle'] = $row['admin'];
		$_SESSION['id'] = $row['user_id'];
		header("location: ../main_menu.php");
	}else{

		$_SESSION['auth'] = true;
		$_SESSION['middle'] = $row['admin'];
		$_SESSION['id'] = $row['user_id'];
		header("location: ../main_menu.php");
	}
	
}else {
	header("location: ../index.php");
}
?>
