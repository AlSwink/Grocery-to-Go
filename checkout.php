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
	<tbody>
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
