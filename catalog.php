<!DOCTYPE html>
<html>
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
// sql to create table
$sql = "CREATE TABLE catalog (    
prodid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
product VARCHAR(30) NOT NULL, 
description1 VARCHAR(30) NOT NULL,
description2 VARCHAR(30),
description3 VARCHAR(30),
stock INT (6),
price FLOAT,    
reg_date TIMESTAMP
)";
echo "<title>Catalog</title>";
if ($conn->query("SHOW TABLES LIKE 'catalog'")->num_rows==0) {
if($conn->query($sql) === TRUE) {
//echo "Table MyGuests created successfully";
} else {
echo "Error creating table: " . $conn->error;
}
}

$check = $conn->query("SELECT * FROM catalog")or die(mysql_error());
 	while($info = mysqli_fetch_array( $check ))

{

$name = $info['product'];
$number=$info['prodid'];
$descriptionA = $info['description1'];
$descriptionB = $info['description2'];
$descriptionC = $info['description3'];

$amount = $info['stock'];

$price = $info['price'];


echo "
 <table border='1' style='width:100%'>
  <tr>
    <td>".$name."</td>
    <td><form method='post' action='update.php'>
	<input type='hidden' name=product_id value='".$number."'>
	<input type='submit' name='cart_add' value='Add to Cart'></form></td>
  </tr>
  <tr>
    <td>".$descriptionA.",".$descriptionB.",".$descriptionC."</td>
    <td>Stock available:".$amount."</td>
    <td>$".$price."</td>
  </tr>
</table>";
 

}

?>
</html>


