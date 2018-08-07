<?php
include("confs/auth.php");
include("master.php");
include("master/sql.php");
session_start();
ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);
$edit_id = $_GET['id'];
$sql = "SELECT * FROM product_master WHERE item_code= '$edit_id' AND delete_flag !='1' ";
$result = mysql_query($sql,$conn);
$product = mysql_fetch_assoc($result);
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
		font-size: 13px;
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
					<label >コード :</label>
				</div>
				<div class="col-md-4"> 
					<input type="text" class="form-control item_code" name="item_code" value="<?php echo $product['item_code'] ?>">
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
					<a href="#" class="btn btn-outline-dark update" style="width:80px;height:40px;font-size:11px;">
					更新<br>
					(Update)</a>
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >商品名 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control item_name" name="item_name" value="<?php echo $product['item_name'] ?>">
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >分類 :</label>
				</div>
				<div class="col-md-4"> 
					<select class="custom-select classification_name">
						<option>-</option>
						<?php 
							if (mysql_num_rows($class) > 0) {

							while($row = mysql_fetch_assoc($class)) {
						?>
						<option value= "<?php echo $row['class_code'] ?>" <?php if($product['class_code'] == $row['class_code']): ?> selected="selected"<?php endif; ?>><?php echo $row['class_name'] ?></option>
						<?php    
						    }

							} else {
							    echo "0 results";
							}
						?>
					</select>
				</div>
			</div>
		</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >価格 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control sale_price" name="sale_price"  value="<?php echo $product['sales_price'] ?> ">
				</div>
			</div>
		</div>
		
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$( ".update" ).click(function() {
		var item_code = $('.item_code').val();
		var sale_price = $('.sale_price').val();
		var item_name = $('.item_name').val();
		var classification_name = $('.classification_name').val();
        $.ajax({
            type:'post',
            url:'product_in.php',
            datatype:'json',
            data:{
            	item_code:item_code,
                sale_price:sale_price,
                item_name:item_name,
                class_name:classification_name,
            },
            success:function(result){
               if (result==1) {
               	alert("successfully edit");
               	window.location.href = "product_master.php";
               };
                
            }
        })
	});
</script>