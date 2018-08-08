<?php
include("confs/auth.php");
include("master.php");
include("master/sql.php");
session_start();
include("confs/config.php");
ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);

$sql = "SELECT * FROM product_master WHERE delete_flag!='1' ";
$product = mysql_query($sql,$conn);

if (isset($_GET['code'])) {
	$code = $_GET['code'];
	$sql = "SELECT * FROM product_master WHERE class_code LIKE '%$code%' ";
	$product = mysql_query($sql,$conn);
}
if (isset($_GET['name'])) {
	$name = $_GET['name'];
	$sql = "SELECT *FROM product_master WHERE item_name LIKE '%$name%' ";
	$product = mysql_query($sql,$conn);
}
if (isset($_GET['name']) && isset($_GET['code'])) {
	$name = $_GET['name'];
	$code = $_GET['code'];
	$sql = "SELECT *FROM product_master WHERE item_name LIKE '%$name%' AND class_code LIKE '%$code%' ";
	$product = mysql_query($sql,$conn);
 	
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
					<label >分類 :</label>
				</div>
				<div class="col-md-4"> 
					<select class="custom-select" id="classification">
						<option> </option>
						<?php 
							if (mysql_num_rows($class) > 0) {

							while($row = mysql_fetch_assoc($class)) {
						?>
						<option value= "<?php echo $row['class_code'] ?>" <?php if($code==$row['class_code']): ?> selected="selected"<?php endif; ?>><?php echo $row['class_name'] ?></option>
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
					<a onclick="javascript:addURL(this);" href="product_master.php?" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
					検索<br>
					(Search)</a>
				</div>
				<div class="col-md-2"> 
					<a href="./product_insert.php" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
					登録<br>
					(Insert)</a>
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >商品名 :</label>
				</div>
				<div class="col-md-4"> 
					  <input type="text" class="form-control item_name" value="<?php if (isset($name))echo $name;?>">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<table class="table table-bordered">
				<thead>
				<tr>
				  <th scope="col">コード(Code)</th>
				  <th scope="col">商品名(Product Name)</th>
				  <th scope="col">価格(Price)</th>
				  <th scope="col">削除(Delete)</th>
				  <th scope="col">更新(Update)</th>
				</tr>
				</thead>
				<tbody id='item'>
				<?php 
					if (mysql_num_rows($product) > 0) {

					while($row = mysql_fetch_assoc($product)) {			
				?>
				<tr>
					<th scope="row"><?php echo $row['item_code'] ?></th>
					<td><?php echo $row['item_name'] ?></td>
					<td><?php echo $row['sales_price'] ?></td>
					<td>
						<button class="delete" item ="<?php echo $row['item_code'] ?>" style="font-color:blue">
						削除
						</button>
					</td>
					<td>
						<button>
						<a href="product_edit.php?id=<?php echo $row['item_code']  ?>" style="text-decoration: none">更新</a>
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
	    	var classification = $('#classification').val();
	   		var item_name = $('.item_name').val();
	        return this.href+'code='+classification+'&name='+item_name;
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
            url:'product_in.php',
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