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

	$customer_id=$_POST['customer_id'];

	$total_amount=$_POST['total_amount'];

	$comment=$_POST['comment'];


	$sql="INSERT INTO  sales_list(customer_id,total_amount, sales_date,comment) 
		VALUES ('$customer_id','$total_amount','$date','$comment') ";

	$result=mysqli_query($conn,$sql);

	$sales_list_id = mysqli_insert_id($conn);

	$query = 'INSERT INTO sales_detail(sales_number,sub_number,item_code,price,quantity,customer_id,sales_date) VALUES';

	foreach($_POST['products'] as $key=>$value) {
		if ($value['qty'] != 0) {
			$key+=1;
			$query .= "('".$sales_list_id."','".$key."', '".$value['item_code']."', '".$value['price']."', '".$value['qty']."','".$customer_id."','".$date."'),";
		}
	}
	
	$mysql = rtrim($query, ',');

	$result = mysqli_query($conn,$mysql);
	if ($result) {
		echo $result;
	}else{
		echo mysqli_error($conn);
	}

}

?>