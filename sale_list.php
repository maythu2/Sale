<?php
include("master.php");
include("confs/auth.php");
include("master/sql.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include("confs/config.php");
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
					 <input type="text" class="form-control">
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
					<a href="" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
					検索<br>
					(Search)</a>
				</div>
				<div class="col-md-2"> 
					<a href="./sale_insert.php" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
					登録<br>
					(Insert)</a>
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >売上日 :</label>
				</div>
				<div class="col-md-2"> 
					  <input type="text" class="form-control">
				</div>
				~
				<div class="col-md-2"> 
					  <input type="text" class="form-control">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<table class="table table-bordered">
				<thead>
				<tr>
				  <th scope="col">コード(Code)</th>
				  <th scope="col">顧客ID(Customer Id)</th>
				  <th scope="col">顧客名(Customer Name)</th>
				  <th scope="col">売上金額(Amount)</th>
				  <th scope="col">売上日(sales Date)</th>
				  <th scope="col">削除(Delete)</th>
				  <th scope="col">更新(Update)</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				  <th scope="row">1</th>
				  <td>Mark</td>
				  <td>Otto</td>
				  <td>Otto111</td>
				  <td><a href="" style="text-decoration: none">削除</a></td>
				  <td><a href="" style="text-decoration: none">更新</a></td>
				</tr>
				</tbody>
			</table>
	  	</div>
	</div>
</div>
</body>
</html>