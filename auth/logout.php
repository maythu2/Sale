<?php
	session_start();
	unset($_SESSION['auth']);
	unset($_SESSION['id']);
	unset($_SESSION['middle']);
	header("location: ../index.php");
?>