<?php 
	include("master.php");
	session_start();
	$auth = isset($_SESSION['auth']);
 ?>
<html>
<head>
	<title> Login </title>
	<style type="text/css">
	.container{
		width: 400px;
	    border: 2px solid;
	    margin-top: 100px;
	}
	.login{
		margin-left: 150px;
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
	<?php if(!$auth) { ?>
	<form action="auth/login.php" method="post" id="loginForm">
		</br>
		<div class="row">
			<div class= "col-md-2">
				<label for="id">ID : </label>
			</div>
			<div class="col-md-10">
				<input type="text" class="form-control required"  minlength="1" name="id" id="id"  placeholder="Enter ID">
			</div>
		</div>
		</br>
		<div class="row">
			<div class= "col-md-2">
				<label for="psssword">PW :</label>
			</div>
			<div class="col-md-10">
				<input type="password" class="form-control required" id="psssword" name="password" placeholder=" Enter Password">
			</div>
		</div>
		</br>
		<button type="submit" class="btn btn-primary login">Login</button>
	</form>
	<?php } ?> 
	</div>
</body>
</html>