<?php

include("confs/auth.php");
session_start();
include("confs/config.php");
ini_set('display_errors', 1);

// for insert product
if(isset($_REQUEST))
{
	if (isset($_POST['class_code'])) {

		$class_code=$_POST['class_code'];

		$class_name=$_POST['class_name'];

		$sql="UPDATE class_master 
			  SET  class_name='$class_name'
			  WHERE class_code= '$class_code' ";

		$result=mysql_query($sql);
		echo $result;
	}else{
		if (isset($_POST['class_name'])) {

			$class_name=$_POST['class_name'];

			$sql="INSERT INTO  class_master(class_name,delete_flag) 
				VALUES ('$class_name','0') ";

			$result=mysql_query($sql);
			echo $result;
		}

	}
}
// for delete classification
if (isset($_POST['del_id'])) {
	$del_id = $_POST['del_id'];

	$sql = "UPDATE class_master 
			SET delete_flag='1'
			WHERE class_code = '$del_id'";

	$result = mysql_query($sql);

	echo $result;
}
?>