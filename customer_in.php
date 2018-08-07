<?php
include("confs/auth.php");
session_start();
include("confs/config.php");
ini_set('display_errors', 1);
// for insert customer
if(isset($_REQUEST))
{
	if (isset($_POST['customer_id'])) {

		$customer_id=$_POST['customer_id'];

		$customer_name=$_POST['customer_name'];

		$address=$_POST['address'];

		$tel=$_POST['tel'];

		$sql="UPDATE customer_master 
			  SET  customer_name='$customer_name', address='$address',tel='$tel' 
			  WHERE customer_id= '$customer_id' ";

		$result=mysql_query($sql);
		echo $result;
	}else{
		$customer_name=$_POST['customer_name'];

		$address=$_POST['address'];

		$tel=$_POST['tel'];

		$sql="INSERT INTO  customer_master(customer_name,address,tel,delete_flag) 
			VALUES ('$customer_name','$address','$tel','0') ";

		$result=mysql_query($sql);

		echo $result;
	}
}
// for delete customer
if (isset($_POST['del_id'])) {
	$del_id = $_POST['del_id'];

	$sql = "UPDATE customer_master 
			SET delete_flag='1'
			WHERE customer_id = $del_id";

	$result = mysql_query($sql);

	echo $result;
}
?>