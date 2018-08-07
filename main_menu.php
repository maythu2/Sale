<?php
include("confs/auth.php");
include("master.php");
include("master/sql.php");
session_start();
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
	.card-body{
		margin-left: 250px;
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
			<a href="./sale_list.php" class="btn btn-outline-dark">(Sales)</a>
			</br>
			</br>
			</br>
			<?php if ($_SESSION['middle']==1) { ?>
				<a href="./product_master.php" class="btn btn-outline-dark">(Product Master)</a>
				</br>
				</br>
				<a href="./class_master.php" class="btn btn-outline-dark">(Classification Master)</a>
				</br>
				</br>
				<a href="./customer_master.php" class="btn btn-outline-dark">(Customer Master)</a>
			<?php } ?>
		</div>
	</div>
</div>
</body>
</html>