<?php
include("master.php");
include("confs/auth.php");
include("master/sql.php");
session_start();
include("confs/config.php");
ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);
$sql = "SELECT * FROM customer_master";
$customer = mysql_query($sql,$conn);

$sql = "SELECT p.item_code,p.item_name,p.sales_price,c.class_name 
		FROM product_master p 
		LEFT JOIN class_master c ON c.class_code=p.class_code";
$product = mysql_query($sql,$conn);
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
	.qty{
		width: 107px;
	}
	.price,.amount,.total_qty,.total_amount{
		width: 107px;
		border-color: white;
    	border-style: none;
	}
	.item_code{
		width: 80px;
		border-color: white;
    	border-style: none;
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
					<select class="custom-select customer_name">
						<option>-</option>
						<?php 
							if (mysql_num_rows($customer) > 0) {

							while($row = mysql_fetch_assoc($customer)) {
						?>
						<option value= "<?php echo $row['customer_id'] ?>"><?php echo $row['customer_name'] ?></option>
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
					<label >売上日 :</label>
				</div>
				<div class="col-md-4">
					 <input type="text" class="form-control date" id="date">
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
					<a href="sale_list.php" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
					後ろ<br>
					(Back)</a>
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-2"> 
					<label >備考 :</label>
				</div>
				<div class="col-md-4">
					<textarea type="text" class="form-control comment"></textarea>  
				</div>
			</div>
		</div>
		<div class="card-footer">
			<table class="table table-bordered">
				<thead>
				<tr>
				  <th scope="col">コード(Code)</th>
				  <th scope="col">商品名(Product Name)</th>
				  <th scope="col">分類(Class)</th>
				  <th scope="col">価格(Price)</th>
				  <th scope="col">売上数量(Quantity)</th>
				  <th scope="col">売上金額(Amount)</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						if (mysql_num_rows($product) > 0) {

						while($row = mysql_fetch_assoc($product)) {
					?>	
					<tr class="products">
					  	<th scope="row"><input type="text" class="item_code"value="<?php echo $row['item_code'] ?>"></th>
					  	<td><?php echo $row['item_name'] ?></td>
					  	
					  	<td><?php echo $row['class_name'] ?></td>
					  	
					  	<td><input type="text" class="price" value="<?php echo $row['sales_price'] ?>"></td>
					  	<td>
						  	<select class="qty">
						  	<option value="0">0</option>
						  	<?php for ($i=1; $i <= 10 ; $i++) { ?>
						  	<option value="<?php echo $i ?>"><?php echo $i ?></option>
						  	<?php } ?>
						  	</select>
					  	</td>
					  	<td><input type="text" class="amount" value="0"></td>
					</tr>
					<?php    
					    }

						} else {
						    echo "0 results";
						}
					?>
					<tr>
						<td colspan="4" style="text-align:center;"> TOTAL</td>
						<td colspan="1"><input type="text" class="total_qty" value="0"></td>
						<td colspan="1"><input type="text" class="total_amount" value="0"></td>
					</tr>
				</tbody>
			</table>
	  	</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
$(function() {
    $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
$('tbody').delegate('.qty','change',function(){
            var x=$(this).parent().parent();
            var textValue1 = x.find('.qty').val();
            var textValue2 =x.find('.price').val();
            calc =textValue1*textValue2;
            x.find('.amount').val(calc);
            amount();
            qty();
});
function amount(){
    var sum = 0;
    $('.amount').each(function(){
    sum += +$(this).val();                           
    });                       
    $('.total_amount').val(sum);      
}
function qty(){
    var sum = 0;
    $('.qty').each(function(){
    sum += +$(this).val();                           
    });                       
    $('.total_qty').val(sum);      
}
$( ".insert" ).click(function() {
	var products = [];
	$('.products').each(function(){
            arr={
                item_code: $(this).find('.item_code').val(),
                qty: $(this).find('.qty').val(),
                price: $(this).find('.price').val(),
            };
            products.push(arr);
    });
    console.log(products);
	var comment = $('.comment').val();
	var customer_id = $('.customer_name').val();
	var date = $('.date').val();
	var total_amount = $('.total_amount').val();

    $.ajax({
        type:'post',
        url:'sale_in.php',
        datatype:'json',
        data:{
            comment:comment,
            customer_id:customer_id,
            date:date,
            total_amount:total_amount,
            products : products,
        },
        success:function(result){
        	console.log(result);
           if (result==1) {
           	alert("successfully save");
           	window.location.href = "sale_list.php";
           };
            
        }
    })
});
</script>