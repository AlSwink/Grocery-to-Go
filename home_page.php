<!DOCTYPE html>
<?php
  session_start();

//-----------------------------------------------------


//------------------------------------------------------

//-------------------------------------------------------
//first page
if(!isset($_SESSION['login']))
{
	
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
		
		</style>
		<head><center><h1>Grocery to Go</h1></center></head>
        <body>If you have an existing account, please log in here:
        <table>
        <form action='login.php' method='POST' name='login'>
        <tr><td> Username: </td><td> <input type='text' name='username'> </td><tr><br/>
        <tr><td> Password: </td><td> <input type='password' name='pass'> </td></tr><br/>
        </table>
        <input type='submit' name='submit' value='Login'>
        </form>
		<p>If you are a store employee, please log in here:</p>
		 <a href='employee_page.php'>Click Here</a>
        <p style='text-align:right'>
        <a href='about_us.html'> About Us </a>
        </p>
        <br><hr><br>
        Otherwise, please fill out this form to create an account:
        <table>
        <form action='register.php' method='POST' name='register'>
        <tr><td> Username: </td><td> <input type='text' name='newname'> </td></tr><br>
        <tr><td> Password: </td><td> <input type='password' name='newpass'> </td></tr><br>
		<tr><td> Retype Password: </td><td><input type='password' name='newpass2'> </td></tr><br>
        <tr><td> First name: </td><td> <input type='text' name='first'> </td></tr><br>
        <tr><td> Last name: </td><td> <input type='text' name='last'> </td></tr><br>
        <tr><td> Email: </td><td> <input type = 'text' name='email'> </td></tr><br>
        </table>
        <input type='hidden' name='create' value='true'>
        <input type='submit' value='Create account'>
        </form></body>";


}


 else{
   //catalog page
     

  

  echo" <style>
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
		<center><h1>Catalog Page </h1></center>
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
		</ul></center><br><br>";


  include("catalog.php");

}
?>
</html>

