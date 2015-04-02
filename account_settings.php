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
      $_SESSION['firstname']=$repfname;
      $_SESSION['lastname']=$replname;
      $_SESSION['address']=$repaddr;
      $_SESSION['email']=$repmail;
	 $sql="UPDATE information SET firstname='".$repfname."',lastname='".$replname."',email='".$repmail."',shipping='".$repaddr."' WHERE username='".$_SESSION['user']."'";

	if ($conn->query($sql) === TRUE) {
	header("Location: account_settings.php");
	} 	
	else {
    echo "Error updating record: " . $conn->error;
	}
   }

echo "<html>
		<title>Grocery to Go</title>
        <head>Account Settings</head>
        <body>
        <p>You have logged in.</p>
       
        <br><hr><br>";

 echo" <h1><center> Grocery to Go Account Page </center></h1>
        <table style='width:100%'><tr>
        <td><a href='cart.html'><center> Shopping Cart </center></a></td>
        <td>
        <form action='logout.php' name='logout' method='POST'>
        <input type='hidden' value='doLogout' name='logout'>
        <input type='submit' value='Logout'></form>
        </td>
        </table><br>";
echo "<form action='account_settings.php' name='editAccount' method='POST'>
        First name:<input type='text' value='".$_SESSION['firstname']."' name='Accfname'>
        Last name:<input type='text' value='".$_SESSION['lastname']."' name='Acclname'>
        Address:<input type='text' value='".$_SESSION['address']."' name='AccAddr'>
        Title:<input type='text' value='".$_SESSION['email']."' name='AccEmail'>
        
        <input type='submit' name='change' value='Make Changes'></form>";

 echo   "<center><a href='home_page.php'> Catalog Page </a></center>
        
        </body>
		</html>";



?>
