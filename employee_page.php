<!DOCTYPE html>
<?php

session_start();
$servername = "localhost";
$username = "ajswink";
$password = "grocery";
$dbname = "ajswink";
$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error) {
die("Connection failed: ".$conn->connect_error);

}
 if(isset($_POST['ustock'])&&$_POST['code']==89732){
      $sql="UPDATE catalog SET description1='".$_POST['desc1']."',description2='".$_POST['desc2']."',description3='".$_POST['desc3']."',stock='".$_POST['stock']."',price='".$_POST['price']."' WHERE product='".$_POST['item']."'";

	if ($conn->query($sql) === TRUE) {
	header("Location: employee_page.php");
	} 	
	else {
    echo "Error updating record: " . $conn->error;
	}
   }
   if(isset($_POST['nstock'])&&$_POST['code']==89732){
      $sql="INSERT INTO catalog (product, description1, description2, description3, stock, price)

 			VALUES ('".$_POST['item']."','".$_POST['desc1']."','".$_POST['desc2']."','".$_POST['desc3']."','".$_POST['stock']."','".$_POST['price']."')";

	if ($conn->query($sql) === TRUE) {
	header("Location: employee_page.php");
	} 	
	else {
    echo "Error updating record: " . $conn->error;
	}
   }
?>
<html>
<title>Grocery to Go</title>
<table id="checkout-cart" class="shopping-cart">
	<thead>
		<tr>
			<th scope="col">Item</th>
			<th scope="col">Qty</th>
			<th scope="col">Price</th>
		</tr>
	</thead>
	<tbody><style>
		body{
			background-color: #F2F2F2;
			border-radius: 25px;
			border: 2px solid #8AC007;
			margin: 10px;
			padding: 20px;
			width: 1215px;
			height: 100%;
			font-family: 'Trebuchet MS', sans-serif;
		}
		h1{
			text-shadow: 2px 2px 4px #000000;
			font-size: 50px;
			color: #F2F2F2;
			border-radius: 25px;
			box-shadow: 6px 6px 3px #000000;
			background: #8AC007;
			padding:20px;
			width: 500px;
			height: 50px;
			background-image: url('http://www.gardenweasel.com/wp-content/uploads/2014/01/shopping-cart.png');
			background-size: 65px;
			background-repeat: no-repeat;
			background-position: 450px, 150px;
			position: relative;
		}
		ul{
			list-style-type: none;
			margin: 0px
			padding: 0;
			overflow: hidden;

			box-shadow: 1px 1px 1px #000000;
			border-collapse: collapse;
			border-radius: 20px;
			border: 1px solid #A4A4A4;
			}
		li{
			float: left;
			width: 220px;
			}
		a:link, a:visited{
			display: block;
			width: 120px;
			color: #000000
			background-color: #F2F2F2;
			text-align: center;
			padding: 4px;
			text-decoration:none;
		}

		a:hover, a:active{
			background-color: #8AC007;
		}
	</style>
	 <body><center><h1> Employee Page </h1></center>
       

		<p>Update existing stock below.</p>
		<form action='employee_page.php' name='editstock' method='POST'>
        Item:<input type='text' name='item'>
        Description:<input type='text'  name='desc1'><input type='text'  name='desc2'><input type='text'  name='desc3'>
        Stock:<input type='number' name='stock'>
		Price:<input type='number'  name='price'>
		Password:<input type='number' name='code'>
		<input type='hidden' name='ustock' value='1'>
        <input type='submit' name='upstock' value='Make Changes'></form>
		<p>Input stock below.</p>
		<form action='employee_page.php' name='make stock' method='POST'>
        Item:<input type='text' name='item'>
        Description:<input type='text'  name='desc1'><input type='text'  name='desc2'><input type='text'  name='desc3'>
        Stock:<input type='number' name='stock'>
		Price:<input type='number'  name='price'>
		Password:<input type='number' name='code'>
		<input type='hidden' name='nstock' value='1'>
        
        <input type='submit' name='upstock' value='Make Changes'></form>
		</html>