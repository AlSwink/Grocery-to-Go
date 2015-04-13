<?php 
session_start();
 // Connects to your Database 
$servername = "localhost";
$username = "ajswink";
$password = "grocery";
$dbname = "ajswink";
$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error) {
	die("Connection failed: ".$conn->connect_error);
}


 //Checks if there is a login cookie

 if(isset($_SESSION['login']))


 //if there is, it logs you in and directes you to the members page

 { 
 	$username = $_SESSION['user']; 

 	$pass = $_SESSION['password'];
 	 	$check = $conn->query("SELECT password FROM information WHERE username = '$username'")or die(mysql_error());
 	while($info = mysqli_fetch_array( $check )) 	
 		{
 		if ($pass != $info['password']) 
 			{
 			 			}
 		else
 			{
 			header("Location: account_settings.php");
 			}
 		}
 }


 //if the login form is submitted 

 if (isset($_POST['submit'])) { // if form has been submitted
 // makes sure they filled it in
 	if(!$_POST['username'] | !$_POST['pass']) {
 		die('You did not fill in a required field.');
 	}
 	// checks it against the database
 	if (!get_magic_quotes_gpc()) {
 		$_POST['pass'] = addslashes($_POST['pass']);
 	}
 	$check = $conn->query("SELECT * FROM information WHERE username = '".$_POST['username']."'")or die(mysql_error());
 //Gives error if user dosen't exist
 $check2 = mysqli_num_rows($check);
 if ($check2 == 0) {
 		die('That user does not exist in our database. <a href=home_page.php>Click Here to Register</a>');
 				}
 while($info = mysqli_fetch_array( $check )) 	
 {
 $_POST['pass'] = stripslashes($_POST['pass']);
 	$info['password'] = stripslashes($info['password']);
 	
 //gives error if the password is wrong
 	if ($_POST['pass'] != $info['password']) {
 		die('Incorrect password, please try again.');
 	}
	else 
 { 
 // if login is ok then we add a cookie 
	
 	 $_POST['username'] = stripslashes($_POST['username']); 
 	 $hour = time() + 3600; 
	 $_SESSION['user']= $_POST['username']; 
	 $_SESSION['password']=$_POST['pass'];	 
	 $_SESSION['login']=true;
	$result=$conn->query("SELECT * FROM information WHERE username='".$_POST['username']."'");
	$row = $result->fetch_object();
	$_SESSION['user']=$_POST['username'];
	$_SESSION['password']=$_POST['pass'];
	$_SESSION['firstname']=$row->firstname;
	$_SESSION['lastname']=$row->lastname;
	$_SESSION['address']=$row->shipping;
	$_SESSION['billing']=$row->billing;
	$_SESSION['email']=$row->email;
 //then redirect them to the members area 
 $conn->close();
 header("Location: account_settings.php"); 

 } 

 } 

 } 

 else 

{	 

 

 // if they are not logged in 

header("Location: home_page.php")

 } 

 

 ?> 
