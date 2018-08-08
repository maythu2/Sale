<?php
include("master.php");
include("confs/auth.php");
include("master/sql.php");
session_start();
include("confs/config.php");
ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);

$sale_id=$_GET['id'];

$sql= "SELECT s.customer_id,s.total_amount,s.comment,s.sales_date,c.customer_name 
	   FROM sales_list s
	   LEFT JOIN customer_master c ON c.customer_id=s.customer_id
	   WHERE s.sales_number=$sale_id";
$result = mysql_query($sql,$conn);
$sales = mysql_fetch_assoc($result);

$query= "SELECT d.item_code,p.item_name,c.class_name,d.price,d.quantity 
	   FROM sales_d d
	   LEFT JOIN product_master p ON p.item_code=d.item_code
	   LEFT JOIN class_master c ON c.class_code=p.class_code
	   WHERE d.sub_number=$sale_id";
$products = mysql_query($query);
?>
<html>
<head>
	<title></title>
	<style type="text/css">
	.container{
		 margin-top: 50px;
		 width: 800;
	}
	.card-footer{
		background-color: rgba(0, 0, 0, 0);
	}
	thead{
		font-size: 12px;
	}
	.qty,.price,.total_qty,.total_amount,.amount{
		border-color: white;
    	border-style: none;
    	width: 60px;
	}
	.sales_date,.customer_id,.comment,.sale_id{
		border-color: white;
    	border-style: none;
    	border-bottom: 1px solid;
    	border-radius: 0px;
	}
	
	</style>
</head>
<body>
<div class="container">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-md-10">
					<h6>User : <?php echo $user['username'] ?>[<?php  echo $user['group_name'] ?>]</h6>
				</div>
				<div class="col-md-2">
					<a href="#"> 閉じる(Close)</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-2"> 
					<label >売上 NO:</label>
				</div>
				<div class="col-md-4"> 
					<input type="text" class="form-control sale_id" value="<?php echo $sale_id ?>">
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >顧客ID:</label>
				</div>
				<div class="col-md-4"> 
					<input type="text" class="form-control customer_id" value="<?php echo $sales["customer_id"] ?>:<?php echo $sales["customer_name"] ?>">
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >売上日 :</label>
				</div>
				<div class="col-md-4">
					 <input type="text" class="form-control sales_date" value="<?php echo $sales["sales_date"] ?>">
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >備考 :</label>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control comment" value="<?php echo $sales["comment"] ?>">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<table class="table table-bordered">
				<thead>
				<tr>
				  <th scope="col">コード(Code)</th>
				  <th scope="col">商品名(Product Name)</th>
				  <th scope="col">分類(Class)</th>
				  <th scope="col">価格(Price)</th>
				  <th scope="col">売上数量(Quantity)</th>
				  <th scope="col">売上金額(Amount)</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						if (mysql_num_rows($products) > 0) {

						while($row = mysql_fetch_assoc($products)) {
					?>	
					<tr class="products">
					  	<th scope="row"><?php echo $row["item_code"] ?></th>
					  	<td><?php echo $row["item_name"] ?></td>
					  	
					  	<td><?php echo $row['class_name'] ?></td>
					  	
					  	<td><input type="text" class="price" value="<?php echo $row["price"] ?>"></td>
					  	<td>
						  	<input type="text" class="qty" value="<?php echo $row["quantity"] ?>">
					  	</td>
					  	<td><input type="text" class="amount" value="<?php echo $row["price"]*$row["quantity"] ?>"></td>
					</tr>
					<?php    
					    }

						} else {
						    echo "0 results";
						}
					?>
					<tr>
						<td colspan="4" style="text-align:center;"> TOTAL</td>
						<td colspan="1"><input type="text" class="total_qty" value="0"></td>
						<td colspan="1"><input type="text" class="total_amount" value="0"></td>
					</tr>
				</tbody>
			</table>
	  	</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
		var sum=0;
    	$('.qty').each(function(){
		    sum += +$(this).val();                           
		    });
    	$('.total_qty').val(sum);
		var amounts=0;
		$('.amount').each(function(){
		    amounts += +$(this).val();                           
		    });
    	$('.total_amount').val(amounts);  
	});

</script>
