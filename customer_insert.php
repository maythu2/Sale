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
					  <input type="text" class="form-control customer_name" name="customer_name" value="">
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
					<label >TEL :</label>
				</div>
				<div class="col-md-4"> 
					<input type="text" class="form-control tel" id="tel" name="tel" > 
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
					<a href="customer_master.php" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
					後ろ<br>
					(Back)</a>
				</div>
			</div>
		</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >住所 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control address" name="address" >
				</div>
			</div>
		</div>
		
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$(window).load(function(){
	   var phones = [{ "mask": "0#-###-####"}, { "mask": "0#-###-####"}];
	    $('#tel').inputmask({ 
	        mask: phones, 
	        greedy: false, 
	        definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
	});
	$( ".insert" ).click(function() {
		var address = $('.address').val();
		var customer_name = $('.customer_name').val();
		var tel = $('.tel').val();
		if (true) {};
        $.ajax({
            type:'post',
            url:'customer_in.php',
            datatype:'json',
            data:{
                address:address,
                customer_name:customer_name,
                tel:tel,
            },
            success:function(result){
               if (result==1) {
               	alert("successfully save");
               	// window.location.href = "customer_master.php";
               };
                
            }
        })
	});
</script>