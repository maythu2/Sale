<?php
include("master.php");
include("confs/auth.php");
include("master/sql.php");
session_start();
include("confs/config.php");
ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);
$sql = "SELECT * FROM customer_master";
$customer = mysql_query($sql,$conn);

$sql = "SELECT * FROM product_master";
$product = mysql_query($sql,$conn);

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
					<a href="auth/logout.php"> (Logout)</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-2"> 
					<label >顧客名 :</label>
				</div>
				<div class="col-md-4"> 
					<select class="custom-select">
						<option>-</option>
						<?php 
							if (mysql_num_rows($customer) > 0) {

							while($row = mysql_fetch_assoc($customer)) {
						?>
						<option value= " <?php echo $row['customer_id'] ?>"><?php echo $row['customer_name'] ?></option>
						<?php    
						    }

							} else {
							    echo "0 results";
							}
						?>
					</select>
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
					<a href="./sale_product_insert.php" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
					登録<br>
					(Insert)</a>
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >売上日 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control" id="date">
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >備考 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control">
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
					if (mysql_num_rows($product) > 0) {

					while($row = mysql_fetch_assoc($product)) {
				?>	
				<tr>
				  	<th scope="row"><?php echo $row['item_code'] ?></th>
				  	<td><?php echo $row['item_name'] ?></td>
				  	<?php 
					if (mysql_num_rows($class) > 0) {

					while($row = mysql_fetch_assoc($class)) {
					?>	
				  	<td><?php   echo $row['class_name'] ?></td>
				  	<?php    
				    }

					} else {
					    echo "0 results";
					}
					?>
				  	<td>Otto111</td>
				  	<td><a href="" style="text-decoration: none">削除</a></td>
				  	<td><a href="" style="text-decoration: none">更新</a></td>
				</tr>
				<?php    
				    }

					} else {
					    echo "0 results";
					}
				?>
				</tbody>
			</table>
	  	</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
$(function() {
    $( "#date" ).datepicker();
});
</script>