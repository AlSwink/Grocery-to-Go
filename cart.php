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
	#cart {
		    box-shadow: 3px 3px 6px #000000;
		    font-family: 'Trebuchet MS', sans-serif;
    		    width: 100%;
    		    border-collapse: collapse;
		    border-radius: 20px;
		 
		    overflow: hidden;
	    }

	    #cart td, #cart th {
		    font-size: 1em;
		    text-align: center;
    		    border: 1px solid #98bf21;
    		    padding: 3px 7px 2px 7px;
	    }

	    #cart th {
		    width: 400px;
    		    font-size: 1.1em;
    		    text-align: center;
		    text-shadow: 2px 2px 4px #000000;
    		    padding-top: 5px;
    		    padding-bottom: 4px;
    		    background-color: #8AC007;
    		    color: #F2F2F2;
	    }

	    #cart tr.alt td {
		    width: 400px;
    		    color: #000000;
    		    background-color: #EAF2D3;
		    text-align: center;
	    }

	   #cart tbody, #cart thead {
		    display: block;
	   }

	   #cart tbody {
		    overflow: auto;
		    height: 250px;
	   }
	</style> 
	<center><h1>Shopping Cart </h1></center>
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
	
	<table id='cart'>
		<tr><th>Item</th><th>Qty</th><th>Price</th>	</tr>

<?php
$total=0;
$row=1;
foreach($_SESSION['cart_items'] as $value){

	$check = $conn->query("SELECT * FROM catalog WHERE prodid='$value'");
	$info = mysqli_fetch_array( $check );
	
	if($row%2==0){
		$class="class='alt'";
	}
	else{
		$class="";
	}

	$name = $info['product'];
	$number=$info['prodid'];
	$descriptionA = $info['description1'];
	$descriptionB = $info['description2'];
	$descriptionC = $info['description3'];

	$amount = $info['stock'];

	$price = $info['price'];
	
	$key=array_search($number,$_SESSION['cart_items']);
	
  


	$total= $total+($price*$_SESSION['item_qty'][$key]);

	if($value!='blank'){
		echo" <tr ".$class.">
		<td>".$name."</td>
		<td>".$_SESSION['item_qty'][$key]."</td>
		<td>$".$price."</td></tr>";
	}
	$row++;
}
$_SESSION['total']=$total;
?>
</tbody>
	</table>
	<p id='sub-total'>
		<strong>Sub Total</strong>: <span id='stotal'>$<?php echo $total; ?>.00</span>
	</p>
	<ul id='shopping-cart-actions'>
		
		<li><form id='shopping-cart' action='update_cart.php' method='post'>
			<input type='hidden' name='delete' value='delete'>
			<input type='submit' value='Empty Cart' ></form>
		</li>
		<li>
			<a href='home_page.php' class='btn'>Continue Shopping</a>
		</li>
		<li>
			<form action='order.php' method='post'>
			<input type='hidden' name='pay' value='pay'>
			<input type='number' value='".$_SESSION['cardnum']."' name='cardnum'>
			<input type='submit' value='Finish Order'></form>
		</li>
	</ul>


</html>
