<?php
include("master.php");
include("confs/auth.php");
include("master.php");
include("master/sql.php");
session_start();
include("confs/config.php");
ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);

$sql = "SELECT * FROM customer_master WHERE delete_flag!='1' ";
$customer = mysql_query($sql,$conn);

if (isset($_GET['name'])) {
	$name = $_GET['name'];
	$sql = "SELECT * FROM customer_master WHERE customer_name LIKE '%$name%' ";
	$customer = mysql_query($sql,$conn);
}
if (isset($_GET['tel'])) {
	$tel = $_GET['tel'];
	$sql = "SELECT *FROM customer_master WHERE tel LIKE '%$tel%' ";
	$customer = mysql_query($sql,$conn);
}
if (isset($_GET['name']) && isset($_GET['tel'])) {
	$name = $_GET['name'];
	$tel = $_GET['tel'];
	$sql = "SELECT *FROM customer_master WHERE customer_name LIKE '%$name%' AND tel LIKE '%$tel%' ";
	$customer = mysql_query($sql,$conn);
}

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
		font-size: 14px;
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
					 <input type="text" class="form-control customer_name" value="<?php if (isset($name))echo $name;?>">
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
					<a onclick="javascript:addURL(this);" href="customer_master.php?" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
					検索<br>
					(Search)</a>
				</div>
				<div class="col-md-2"> 
					<a href="./customer_insert.php" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
					登録<br>
					(Insert)</a>
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >Tel :</label>
				</div>
				<div class="col-md-4"> 
					 <input type="text" class="form-control tel" value="<?php if (isset($tel))echo $tel;?>">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<table class="table table-bordered">
				<thead>
				<tr>
				  <th scope="col">コード(Code)</th>
				  <th scope="col">顧客名(Customer Name)</th>
				  <th scope="col">Tel</th>
				  <th scope="col">住所(Address)</th>
				  <th scope="col">削除(Delete)</th>
				  <th scope="col">更新(Update)</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					if (mysql_num_rows($customer) > 0) {

					while($row = mysql_fetch_assoc($customer)) {			
				?>
				<tr>
				  <th scope="row"><?php echo $row['customer_id'] ?></th>
				  <td><?php echo $row['customer_name'] ?></td>
				  <td><?php echo $row['tel'] ?></td>
				  <td><?php echo $row['address'] ?></td>
				  <td>
						<button class="delete" item ="<?php echo $row['customer_id'] ?>" style="font-color:blue">
						削除
						</button>
					</td>
					<td>
						<button>
						<a href="customer_edit.php?id=<?php echo $row['customer_id']  ?>" style="text-decoration: none">更新</a>
						</button>
					</td>
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
	function addURL(element)
	{
	    $(element).attr('href', function() {
	    	var customer_name = $('.customer_name').val();
	   		var tel = $('.tel').val();
	        return this.href+'name='+customer_name+'&tel='+tel;
	    });
	}
 	$("tbody").delegate('.delete','click',function(){
        var del_confirm =  confirm("Are you sure you want to delete?");
	    if (del_confirm == false){
	        return false;
	    }
		var row_id = $(this).attr('item');
		  $.ajax({
            type:'post',
            url:'customer_in.php',
            datatype:'json',
            data:{
                del_id:row_id,
            },
            success:function(result){
            	if (result==1) {
            		alert("successfully delete");
            		window.location.reload();
            	};
            }
        })
	})
</script>