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
   //edits account info
   if(isset($_POST['change'])){
      $repfname=$_POST['Accfname'];
      $replname=$_POST['Acclname'];
      $repaddr=$_POST['AccAddr'];
      $repmail=$_POST['AccEmail'];
	  $repbill=$_POST['AccBill'];
	  $repcard=$_POST['AccCard'];
      $_SESSION['firstname']=$repfname;
      $_SESSION['lastname']=$replname;
      $_SESSION['address']=$repaddr;
      $_SESSION['email']=$repmail;
	  $_SESSION['billing']=$repbill;
	  $_SESSION['cardnum']=$repcard;
	 $sql="UPDATE information SET firstname='".$repfname."',lastname='".$replname."',email='".$repmail."',shipping='".$repaddr."',billing='".$repbill."',cardnum='".$repcard."' WHERE username='".$_SESSION['user']."'";

	if ($conn->query($sql) === TRUE) {
	header("Location: account_settings.php");
	} 	
	else {
    echo "Error updating record: " . $conn->error;
	}
   }

echo "<html>
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
        <body><center><h1> Account Page </h1></center>
        <center><ul>
	   <li> <a href='home_page.php'>Catalog</a></li>
	   <li> <a href='account_settings.php'>Account Settings</a></li>
	   <li> <a href='cart.php'>Shopping Cart</a></li>
	   <li> <a href='contact_us.html'>Contact Us</a></li>
	   <li><form action='logout.php' name='logout' align='center' method='post'><input type='hidden' value='doLogout' name='logout'><input type='submit' value='Logout'></form></li>
		</ul></center><br><br>
		<p>If you have not entered Shipping, Billing, or Card information, please do so below.</p>
		<form action='account_settings.php' name='editAccount' method='POST'>
        First name:<input type='text' value='".$_SESSION['firstname']."' name='Accfname'>
        Last name:<input type='text' value='".$_SESSION['lastname']."' name='Acclname'>
        Email:<input type='text' value='".$_SESSION['email']."' name='AccEmail'>
		<br><br>
		Shipping Address:<input type='text' value='".$_SESSION['address']."' name='AccAddr'>		
		Billing Address:<input type='text' value='".$_SESSION['billing']."' name='AccBill'>
		Card Number:<input type='number' value='".$_SESSION['cardnum']."' name='AccCard'>

        <br><br>
        <input type='submit' name='change' value='Make Changes'></form>
		<br><hr><br>
		<p>Previous orders</p>
					<table id='catalog'>
	<thead><th>Product and Quantity</th><th>Price</th><th>Shipping Address</th><th>Card number</th></thead><tbody>";
	$row=1;
$check = $conn->query("SELECT * FROM orders WHERE username='".$_SESSION['user']."'")or die(mysql_error());
 	while($info = mysqli_fetch_array( $check ))

{

$number = $info['ordid'];
$price = $info['prices'];
$product = $info['contents'];
$address = $info['shipping'];
$card = $info['cardnum'];
if($row%2==0){
	$class="";
}
else{
	$class="class='alt'";
	}

echo "<tr ".$class."><td>".$product."</td><td>$".$price."</td><td>".$address."</td><td>".$card."</td></tr>";
$row++;
}

?>
</tbody>
</table>
</body>
</html>