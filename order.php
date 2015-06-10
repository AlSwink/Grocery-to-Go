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
prices TEXT,
cardnum BIGINT(20) UNSIGNED NOT NULL,
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
<title>Grocery to Go</title>
		<style>
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
		<center><h1>Review Order</h1></center>
       <center><ul>
	   <li> <a href='home_page.php'>Catalog</a></li>
	   <li> <a href='account_settings.php'>Account Settings</a></li>
	   <li> <a href='cart.php'>Shopping Cart</a></li>
	   <li> <a href='contact_us.html'>Contact Us</a></li>
	   <li>
			<form action='logout.php' name='logout' align='center' method='post'>
			<input type='hidden' value='doLogout' name='logout'>
			<input type='submit' value='Logout'></form>
		</li>
		</ul></center><br><br>
<table id="catalog" >
	<thead><th>Item</th><th>Qty</th><th>Price</th>
		</thead><tbody>
	
	<?php      
	$content = "";
	$prices = "";
	$send ="";
 foreach($_SESSION['cart_items'] as $value){
		$class="";
        $check = $conn->query("SELECT * FROM catalog WHERE prodid='$value'");
        $info = mysqli_fetch_array( $check );
		

        $name = $info['product'];
        $number=$info['prodid'];
		$key=array_search($number,$_SESSION['cart_items']);
		$price = $info['price'];
		$sql2="UPDATE catalog SET stock=stock-'".$_SESSION['item_qty'][$key]."' WHERE prodid='".$number."'";

		$update = $conn->query($sql2);
		
		if($number%2==0){
			$class="";
		}
		else{
			$class="class='alt'";
		}

        if($value!='blank'){
		$content.=$name."  ".$_SESSION['item_qty'][$key];
		$content.= ",";
		$prices+=$price*$_SESSION['item_qty'][$key];
		$send.="<tr ".$class.">
            <td>".$name."</td>
            <td>".$_SESSION['item_qty'][$key]."</td>
            <td>$".$price."</td></tr>";
		echo"
        <tr ".$class.">
            <td>".$name."</td>
            <td>".$_SESSION['item_qty'][$key]."</td>
            <td>$".$price."</td></tr>";
		}
 }
 
$sql3="INSERT INTO orders (username, shipping, contents, prices, cardnum) VALUES ('".$_SESSION['user']."','".$_SESSION['address']."','".$content."','".$prices."','".$_POST['cardnum']."')";
$add_order = $conn->query($sql3);


$to  = $_SESSION['email']; // note the comma

// subject
$subject = 'Grocery to Go Order';

// message
$message = '
<html>
<head>
  <title>Grocery to Go Order</title>
</head>
<body>
  <p>Here are the contents of your order</p>
  <table>
    <tr><th>Item</th><th>Qty</th><th>Price</th>
		</tr>';
$message.=$send;
$message.="</table><p>Card Number: ".$_POST['cardnum']."</p><p>Shipping Address: ".$_SESSION['address']."</p></body></html>";


// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: Webmaster<ajswink@email.uark.com>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
unset($_SESSION['cart_items']);
  unset($_SESSION['item_qty']);
  $_SESSION['cart_items']=array();
  $_SESSION['item_qty']=array();
 ?>
	</tbody>
</table>

<div id="pricing">
	<p id="shipping">
		<strong>Shipping</strong>: <span id="sshipping"><?php echo $_SESSION['address'];?></span>
	</p>

	<p id="sub-total">
	<strong>Sub Total</strong>: <span id='stotal'>$<?php echo $_SESSION['total']; ?>.00</span>
	</p>
</div>

<div id="user-details">
	<h2>Your Data</h2>
		<div id="user-details-content">
		<p><strong>Billing</strong>:<?php echo $_SESSION['billing'];?></p>
		<p><strong>Card Number</strong>:<?php echo $_POST['cardnum'];?></p>
		</div>
</div>

</html>
