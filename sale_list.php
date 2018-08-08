<?php
include("master.php");
include("confs/auth.php");
include("master/sql.php");
session_start();
include("confs/config.php");
ini_set('display_errors', 1);
$auth = isset($_SESSION['auth']);
$sql= "SELECT s.sales_number,s.customer_id,s.total_amount,s.sales_date,c.customer_name 
	   FROM sales_list s
	   LEFT JOIN customer_master c ON c.customer_id=s.customer_id";
$sales = mysql_query($sql);

$name=$_GET["name"];
$start_date= $_GET["start_date"];
$end_date=$_GET["end_date"];
if (isset($name)) {
	$sql="SELECT s.sales_number,s.customer_id,s.total_amount,s.sales_date,c.customer_name 
	  FROM sales_list s
	  LEFT JOIN customer_master c ON c.customer_id=s.customer_id
	  WHERE c.customer_name LIKE '%$name%'";
	$sales = mysql_query($sql);
}

if(isset($start_date)) {
	if ($end_date=="") {
		$end_date = date("Y-m-d");
	}
	$sql="SELECT s.sales_number,s.customer_id,s.total_amount,s.sales_date,c.customer_name 
	  FROM sales_list s
	  LEFT JOIN customer_master c ON c.customer_id=s.customer_id
	  WHERE s.sales_date BETWEEN '$start_date%' AND '$end_date%'";
	$sales = mysql_query($sql);
}
if (isset($start_date) && isset($end_date)) {
	$sql="SELECT s.sales_number,s.customer_id,s.total_amount,s.sales_date,c.customer_name 
  	FROM sales_list s
  	LEFT JOIN customer_master c ON c.customer_id=s.customer_id
  	WHERE s.sales_date BETWEEN '$start_date%' AND '$end_date%'";
	$sales = mysql_query($sql);
}
if (isset($start_date) && isset($end_date) && isset($name)) {
	$sql="SELECT s.sales_number,s.customer_id,s.total_amount,s.sales_date,c.customer_name 
  	FROM sales_list s
  	LEFT JOIN customer_master c ON c.customer_id=s.customer_id
  	WHERE c.customer_name LIKE '%$name%' AND s.sales_date BETWEEN '$start_date%' AND '$end_date%'";
	$sales = mysql_query($sql);
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
					 <input type="text" class="form-control customer_name" value="<?php if (isset($name))echo $name;?>">
				</div>
				<div class="col-md-2"> 
				</div>
				<div class="col-md-2"> 
					<a onclick="javascript:addURL(this);" href="sale_list.php?" class="btn btn-outline-dark" style="width:80px;height:40px;font-size:11px;">
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
				<div class="col-md-3"> 
					  <input type="text" class="form-control start_date" value="<?php if(isset($_GET["start_date"]))echo $_GET["start_date"];?>">
				</div>
				~
				<div class="col-md-3"> 
					  <input type="text" class="form-control end_date" value="<?php if(isset($_GET["end_date"]))echo $_GET["end_date"];?>">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<table class="table table-bordered">
				<thead>
				<tr>
				  <th scope="col">売上(No)</th>
				  <th scope="col">顧客ID(Customer Id)</th>
				  <th scope="col">顧客名(Customer Name)</th>
				  <th scope="col">売上金額(Amount)</th>
				  <th scope="col">売上日(sales Date)</th>
				  <th scope="col">精細(Detail)</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				if (mysql_num_rows($sales) > 0) {

				while($row = mysql_fetch_assoc($sales)) {
						
				?>
				<tr>
				  <th scope="row"><?php echo $row["sales_number"] ?></th>
				  <td><?php echo $row["customer_id"] ?></td>
				  <td><?php echo $row["customer_name"] ?></td>
				  <td><?php echo $row["total_amount"] ?></td>
				  <td><?php echo $row["sales_date"] ?></td>
				  <td><a href="product_detail.php?id=<?php echo $row["sales_number"] ?>" class="popup" style="text-decoration: none">精細</a></td>
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
$(function() {
    $( ".start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( ".end_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
function addURL(element){
    $(element).attr('href', function() {
    	var customer_name = $('.customer_name').val();
   		var start_date = $('.start_date').val();

   		var end_date = $('.end_date').val();
   		if (start_date == "" && end_date != "" ) {
   			alert("please insert start date");
   			$( ".end_date" ).datepicker.hide();
   		};
        return this.href+'name='+customer_name+'&start_date='+start_date+'&end_date='+end_date;
    });
}
$('.popup').click(function (event) {
    event.preventDefault();
    window.open($(this).attr("href"), "popupWindow", "width=992,height=600");
});
</script>