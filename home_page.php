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
        <head> <h1 style='color:lightgreen'><center>Grocery to Go</center></h1></head>
        <body>If you have an existing account, please log in here:
        <table>
        <form action='login.php' method='POST' name='login'>
        <tr><td> Username: </td><td> <input type='text' name='username'> </td><tr><br/>
        <tr><td> Password: </td><td> <input type='password' name='pass'> </td></tr><br/>
        </table>
        <input type='submit' name='submit' value='Login'>
        </form>
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

    // echo  "<div>First Name: {$_SESSION['firstname']}</div>";
}


 else{
   //catalog page
     

  

  echo" <h1><center> Grocery to Go Catalog Page </center></h1>
        <table style='width:100%'><tr>
        <td><a href='cart.html'><center> Shopping Cart </center></a></td>
        <td>
        <form action='logout.php' name='logout' method='POST'>
        <input type='hidden' value='doLogout' name='logout'>
        <input type='submit' value='Logout'></form>
        </td>
        </table><br>";

  if(isset($_GET['cart'])){
        echo"<p> Item added to cart. </p><br>";
  }

  include("catalog.php");

  echo  "<br>
        <table style='width:100%'><tr>
        <td></td>
        <td><a href='account_settings.php' > Account Settings </a></td>
        <td><a href='contact_us.html' > Contact Us </a></td>
        </tr></table>";
}
?>
</html>

