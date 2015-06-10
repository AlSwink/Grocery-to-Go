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
echo"
<style>
	#catalog {
		    box-shadow: 3px 3px 6px #000000;
		    font-family: 'Trebuchet MS', sans-serif;
    		    width: 100%;
    		    border-collapse: collapse;
		    border-radius: 20px;
		   
		    overflow: hidden;
	    }

	    #catalog td, #catalog th {
		    font-size: 1em;
		    text-align: center;
    		    border: 1px solid #98bf21;
    		    padding: 3px 7px 2px 7px;
	    }

	    #catalog th {
		    width: 400px;
    		    font-size: 1.1em;
    		    text-align: center;
		    text-shadow: 2px 2px 4px #000000;
    		    padding-top: 5px;
    		    padding-bottom: 4px;
    		    background-color: #8AC007;
    		    color: #F2F2F2;
	    }

	    #catalog tr.alt td {
		    width: 400px;
    		    color: #000000;
    		    background-color: #EAF2D3;
		    text-align: center;
	    }

	   #catalog tbody, #catalog thead {
		    display: block;
	   }

	   #catalog tbody {
		    overflow: auto;
		    height: 250px;
	   }
	</style> 
	<table id='catalog'>
	<thead><th>Products</th><th>Description</th><th>Stock</th><th>Price</th><th>Add to Shopping cart</th></thead><tbody>";
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

if($number%2==0){
	$class="";
}
else{
	$class="class='alt'";
	}
echo "

  <tr ".$class.">
    <td>".$name."</td><td>".$descriptionA.",".$descriptionB.",".$descriptionC."</td><td>".$amount."</td><td>$".$price."</td>
	<td><form method='post' action='update_cart.php'>
	<input type='number' name=amt min=1 max=10>
	<input type='hidden' name=product_id value='".$number."'>
	<input type='submit' name='cart_add' value='Add to Cart'></form></td>
  </tr>";
 
}

?>
</tbody>
</table>
</html>


