<?php
include("confs/auth.php");
include("master.php");
include("master/sql.php");
session_start();
ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);
$edit_id = $_GET['id'];
$sql = "SELECT * FROM customer_master WHERE customer_id= '$edit_id' AND delete_flag !='1' ";
$result = mysql_query($sql,$conn);
$customer = mysql_fetch_assoc($result);
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
					<input type="text" class="form-control customer_id" name="customer_id" value="<?php echo $customer['customer_id'] ?>">
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
					<label >顧客名 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control customer_name" name="customer_name" value="<?php echo $customer['customer_name'] ?>">
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >TEL :</label>
				</div>
				<div class="col-md-4"> 
					<input type="text" class="form-control tel" name="tel" value="<?php echo $customer['tel'] ?>">
				</div>
			</div>
		</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >住所 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control address" name="address"  value="<?php echo $customer['address'] ?> ">
				</div>
			</div>
		</div>
		
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$( ".update" ).click(function() {
		var customer_id = $('.customer_id').val();
		var address = $('.address').val();
		var customer_name = $('.customer_name').val();
		var tel = $('.tel').val();
        $.ajax({
            type:'post',
            url:'customer_in.php',
            datatype:'json',
            data:{
            	customer_id:customer_id,
                address:address,
                customer_name:customer_name,
                tel:tel,
            },
            success:function(result){
               if (result==1) {
               	alert("successfully edit");
               	window.location.href = "customer_master.php";
               };
                
            }
        })
	});
</script>