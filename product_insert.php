<?php
include("confs/auth.php");
include("master.php");
include("master/sql.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);
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
	.error {
		font: normal 10px arial;
		padding: 3px;
		margin: 3px;
		background-color: #ffc;
		border: 1px solid #c00;
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
					<label >商品名 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control item_name required" name="item_name" value="">
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
					<a href="#" class="btn btn-outline-dark insert" style="width:80px;height:40px;font-size:11px;">
					登録<br>
					(Insert)</a>
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
							if (mysqli_num_rows($class) > 0) {

							while($row = mysqli_fetch_assoc($class)) {
						?>
						<option value= " <?php echo $row['class_code'] ?>"><?php echo $row['class_name'] ?></option>
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
					  <input type="text" class="form-control sale_price" name="sale_price" >
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$( ".insert" ).click(function() {
		var sale_price = $('.sale_price').val();
		var item_name = $('.item_name').val();
		var classification_name = $('.classification_name').val();
        $.ajax({
            type:'post',
            url:'product_in.php',
            datatype:'json',
            data:{
                sale_price:sale_price,
                item_name:item_name,
                class_name:classification_name,
            },
            success:function(result){
            	console.log(result);
               if (result==1) {
               	alert("successfully save");
               	window.location.href = "product_master.php";
               };
                
            }
        })
	});
</script>