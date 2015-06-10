
<?php 
 // Connects to your Database 
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

$sql = "CREATE TABLE information (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
firstname VARCHAR(30),
lastname VARCHAR(30),
email VARCHAR(50),
billing TEXT,
cardnum BIGINT(20) UNSIGNED NOT NULL,
reg_date TIMESTAMP
)";

	if ($conn->query("SHOW TABLES LIKE 'information'")->num_rows==0) {
	if($conn->query($sql) === TRUE)	{
		//echo "Table MyGuests created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	}
	

 //This code runs if the form has been submitted

 if (isset($_POST['create'])) { 



 //This makes sure they did not leave any fields blank

 if (!$_POST['newname'] | !$_POST['newpass'] | !$_POST['newpass2'] ) {

 		die('You did not complete all of the required fields');

 	}



 // checks if the username is in use

 	if (!get_magic_quotes_gpc()) {

 		$_POST['newname'] = addslashes($_POST['newname']);

 	}

 $usercheck = $_POST['newname'];

 $check = $conn->query("SELECT username FROM information WHERE username = '$usercheck'") 

or die(mysql_error());

 $check2 = mysqli_num_rows($check);



 //if the name exists it gives an error

 if ($check2 != 0) {

 		die('Sorry, the username '.$_POST['newname'].' is already in use.');

 				}


 // this makes sure both passwords entered match

 	if ($_POST['newpass'] != $_POST['newpass2']) {

 		die('Your passwords did not match. ');

 	}



 	// here we encrypt the password and add slashes if needed

 	

 	if (!get_magic_quotes_gpc()) {

 		$_POST['newpass'] = addslashes($_POST['newpass']);

 		$_POST['newname'] = addslashes($_POST['newname']);

 			}



 // now we insert it into the database

 	$insert = "INSERT INTO information (username, password, firstname, lastname, email)

 			VALUES ('".$_POST['newname']."','".$_POST['newpass']."','".$_POST['first']."','".$_POST['last']."','".$_POST['email']."')";
//
	
 	$add_member = $conn->query($insert);
	$_SESSION['login']='true';
	$result=$conn->query("SELECT * FROM information WHERE username='".$_POST['newname']."'");
	$row = $result->fetch_object();
	$_SESSION['user']=$_POST['newname'];
    $_SESSION['password']=$_POST['newpass'];
    $_SESSION['firstname']=$row->firstname;
    $_SESSION['lastname']=$row->lastname;
    $_SESSION['email']=$row->email;
    
	header("Location: account_settings.php");
 
 } 

 else 
 {	
   // header("Location: home_page.php")
 }
 ?> 