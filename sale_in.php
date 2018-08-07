<?php
include("confs/auth.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include("confs/config.php");
ini_set('display_errors', 1);

// for insert sale data
if(isset($_REQUEST))
{
	$date=$_POST['date'];
	echo $date;

	$customer_id=$_POST['customer_id'];

	$total_amount=$_POST['total_amount'];

	$comment=$_POST['comment'];

	$sql="INSERT INTO  sales_list(customer_id,total_amount, sales_date,comment) 
		VALUES ('$customer_id','$total_amount','$date','$comment') ";

	$result=mysqli_query($conn,$sql);
	echo $result;

}

?>