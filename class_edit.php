<?php
include("confs/auth.php");
include("master.php");
include("master/sql.php");
session_start();
ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);
$edit_id = $_GET['id'];
$sql = "SELECT * FROM class_master WHERE class_code= '$edit_id' AND delete_flag !='1' ";
$result = mysql_query($sql,$conn);
$classification = mysql_fetch_assoc($result);
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
					<input type="text" class="form-control class_code" name="class_code" value="<?php echo $classification['class_code'] ?>">
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
					<a href="#" class="btn btn-outline-dark update" style="width:80px;height:40px;font-size:11px;">
					登録<br>
					(Update)</a>
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >分類名 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control class_name" name="class_name" value="<?php echo $classification['class_name'] ?>">
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$( ".update" ).click(function() {
		var class_code = $('.class_code').val();
		var class_name = $('.class_name').val();

        $.ajax({
            type:'get',
            url:'class_in.php',
            datatype:'json',
            data:{
            	class_code:class_code,
                class_name:class_name,
            },
            success:function(result){
               if (result==1) {
               	alert("successfully edit");
               	window.location.href = "class_master.php";
               };
                
            }
        })
	});
</script>