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
$sql = "CREATE TABLE orders (
ordid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
shipping TEXT,
contents TEXT,
cardnum INT(20) UNSIGNED NOT NULL,
reg_date TIMESTAMP
)";
	if ($conn->query("SHOW TABLES LIKE 'orders'")->num_rows==0) {
	if($conn->query($sql) === TRUE)	{
		//echo "Table MyGuests created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	}

?>
<html>
<h1>Thank You For Your Order!</h1>
<a href="home_page.php">Click Here to return to the Catalog</a>
<a href="account_settings.php">Click Here to return to your Account</a>
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
	$content = "";
 foreach($_SESSION['cart_items'] as $value){

        $check = $conn->query("SELECT * FROM catalog WHERE prodid='$value'");
        $info = mysqli_fetch_array( $check );


        $name = $info['product'];
        $number=$info['prodid'];
        $descriptionA = $info['description1'];
        $descriptionB = $info['description2'];
        $descriptionC = $info['description3'];
		$price = $info['price'];
		$sql2="UPDATE catalog SET stock=stock-1 WHERE prodid='".$number."'";

		$update = $conn->query($sql2);
		$content.=$name;
		$content.= ", ";
        echo"
        <tr>
            <td>".$name."</td>
            <td>1</td>
            <td>$".$price."</td></tr>";
 }
 
$sql3="INSERT INTO orders (username, shipping, contents, cardnum) VALUES ('".$_SESSION['user']."','".$_SESSION['address']."','".$content."','".$_SESSION['cardnum']."')";
$add_order = $conn->query($sql3);

 ?>
	</tbody>
</table>

<div id="pricing">
	<p id="shipping">
		<strong>Shipping</strong>: <span id="sshipping"></span>
	</p>

	<p id="sub-total">
	<strong>Sub Total</strong>: <span id='stotal'>$<?php echo $_SESSION['total']; ?>.00</span>
	</p>
</div>

<div id="user-details">
	<h2>Your Data</h2>
		<div id="user-details-content"></div>
</div>


<form id="payment" action="" method="post">
	<input type="hidden" name="cmd" value="_cart" />
	<input type="hidden" name="upload" value="1" />
	<input type="hidden" name="business" value="" />

	<input type="hidden" name="currency_code" value="" />
	<input type="submit" id="pay-btn" class="btn" value="Pay with Card" />
</form>
</html>
