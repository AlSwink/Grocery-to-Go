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
			background-position: 95% 60%;

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
			width: 240px;
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
<?php      
 foreach($_SESSION['cart_items'] as $value){

        $check = $conn->query("SELECT * FROM catalog WHERE prodid='$value'");
        $info = mysqli_fetch_array( $check );


        $name = $info['product'];
        $number=$info['prodid'];
        $descriptionA = $info['description1'];
        $descriptionB = $info['description2'];
        $descriptionC = $info['description3'];

        $amount = $info['stock'];

        $price = $info['price'];
        echo"
        <tr>
            <td>".$name."</td>
            <td>1</td>
            <td>$".$price."</td>";
 }
 ?>
 </tr>
</tbody>
</table>

<div id="pricing">
	<p id="shipping">
		<strong>Shipping</strong>: <span id="sshipping"></span>
	</p>

	<p id="sub-total">
		<strong>Total</strong>: <span id='stotal'>$<?php echo $_SESSION['total']; ?>.00</span>
	</p>
</div>

<form action="order.php" method="post" id="checkout-order-form">
	<h2>Your Details</h2>
		<fieldset id="fieldset-billing">
			<legend>Billing and Shipping</legend>
				<!-- Name, Email, Address -->
<?php
     
echo"<div>
	<label for='name'>Name</label>
	<input type='text' name='name' id='name' data-type='string' value = '".$_SESSION['user']."' data-message='This field may not be empty' />
</div>

<div>
	<label for='email'>Email</label>
	<input type='text' name='email' id='email' data-type='expression' value = '".$_SESSION['email']."' data-message='Not a valid email address' />
</div>


<div>
	<label for='address'>Address</label>
		<input type='text' name='address' id='address' data-type='string' value = '".$_SESSION['address']."' data-message='This field may not be empty' />
</div>


</fieldset>


<p><input type='submit' id='submit-order' value='Order' class='btn' /></p>

</form>";
?>
</html>
