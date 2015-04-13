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

<form id='shopping-cart' action='update_cart.php' method='post'>
	<table class='shopping-cart'>
		<thead>
			<tr>
				<th scope='col'>Item</th>
				<th scope='col'>Qty</th>
				<th scope='col'>Price</th>
			</tr>
		</thead>
<tbody>
<?php
$total=0;
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
$total= $total+$price;
echo" <tr>
<td>".$name."</td>
<td>1</td>
<td>$".$price."</td></tr>";
}
$_SESSION['total']=$total;
?>
</tbody>
	</table>
	<p id='sub-total'>
		<strong>Sub Total</strong>: <span id='stotal'>$<?php echo $total; ?>.00</span>
	</p>
	<ul id='shopping-cart-actions'>
		
		<li>
			<input type='submit' name='delete' id='empty-cart' class='btn' value='Empty Cart' />
		</li>
		<li>
			<a href='home_page.php' class='btn'>Continue Shopping</a>
		</li>
		<li>
			<a href='checkout.php' class='btn'>Go To 
Checkout</a>
		</li>
	</ul>
</form>

</html>;
