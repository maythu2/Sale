<?php
include("confs/auth.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include("confs/config.php");
ini_set('display_errors', 1);

// for insert product
if(isset($_REQUEST))
{
	if (isset($_POST['item_code'])) {

		$item_code=$_POST['item_code'];

		$sale_price=$_POST['sale_price'];

		$class_code=$_POST['class_name'];

		$item_name=$_POST['item_name'];

		$sql="UPDATE product_master 
			  SET  class_code= '$class_code',item_name='$item_name', sales_price='$sale_price' 
			  WHERE item_code= '$item_code' ";

		$result=mysqli_query($conn,$sql);
		echo $result;
	}else{
		$sale_price=$_POST['sale_price'];

		$class_code=$_POST['class_name'];

		$item_name=$_POST['item_name'];

		$sql="INSERT INTO  product_master(class_code,item_name, sales_price,delete_flag) 
			VALUES ('$class_code','$item_name','$sale_price','0') ";

		$result=mysqli_query($conn,$sql);
		echo $result;
	}
}
// for delete product
if (isset($_POST['del_id'])) {
	$del_id = $_POST['del_id'];

	$sql = "UPDATE product_master 
			SET delete_flag='1'
			WHERE item_code = $del_id";

	$result = mysqli_query($conn,$sql);

	echo $result;
}
?>