<!DOCTYPE html>
<?php
  session_start();
  $fh=fopen("customer-account-info.txt","a");
 // rewind($fh);
  fclose($fh);
?>
<html>
<?php
//-----------------------------------------------------
//destroys session
if(isset($_GET['status'])){
	$_SESSION=array();

	session_destroy();
}

//------------------------------------------------------
//creates account and sets initial info
   if(isset($_GET['create'])){
     $namecheck=0;
     $userlines=file('customer-account-info.txt');
     foreach($userlines as $uline){
      $userdata=explode(";", $uline);
      if($userdata[0]==$_GET['newname']){
	$namecheck=1;
      }
      }
     if($namecheck==0){
       $user=$_GET['newname'];
       $passw=$_GET['newpass'];
       $fname=$_GET['first'];
       $lname=$_GET['last'];
       $default="white;Welcome to Alan Swink's Assignment 11 PHP page!;http://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Stick_Figure.svg/170px-Stick_Figure.svg.png".PHP_EOL;
       $fh=fopen("customer-account-info.txt","a+");
       fwrite($fh,$user.";".$passw.";".$fname.";".$lname.";".$default);
       fclose($fh);
       $_SESSION['login']='true';
       $_SESSION['user']=$user;
       $_SESSION['password']=$passw;
       $_SESSION['firstname']=$fname;
       $_SESSION['lastname']=$lname;
       $_SESSION['color']='white';
       $_SESSION['title']="Welcome to Alan Swink's Assignment 11 PHP page!";
       $_SESSION['image']='http://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Stick_Figure.svg/170px-Stick_Figure.svg.png';
}
else{
echo '<script>alert("User name already in use")</script>';
}

}
//---------------------------------------------------------
//checks the username and password, sets session variables
if(isset($_GET['username'])){
 $check1=$_GET['username'];
 $check2=0;
 
 if(empty($_GET['username'])||empty($_GET['pass'])){
     echo '<script> alert("Please enter a username and a password");</script>';}
 else{
 
   $userlines=file('customer-account-info.txt');
   foreach($userlines as $uline){
     $userdata=explode(";", $uline);
     if($userdata[0]==$check1){
     
       if($userdata[1]==$_GET['pass']){
  	  $_SESSION['user']=$_GET['username'];
	  $_SESSION['password']=$_GET['pass'];
	  $_SESSION['login']='true';
	  $_SESSION['firstname']=$userdata[2];
	  $_SESSION['lastname']=$userdata[3];
	  $_SESSION['color']=$userdata[4];
	  $_SESSION['title']=$userdata[5];
	  $_SESSION['image']=$userdata[6];
       }
       else{
	  echo '<script> alert("Incorrect password");</script>';
       }
        $check2=1;
     }
   }
   if($check2==0){ echo '<script> alert("User not found");</script>';}
 }
}
//-------------------------------------------------------
//edits account info
if(isset($_GET['Accfname'])){
  $repfname=$_GET['Accfname'];
  $replname=$_GET['Acclname'];
  $repcolor=$_GET['AccColor'];
  $reptitle=$_GET['AccTitle'];
  $repimage=$_GET['AccImage'];
  $data=file("customer-account-info.txt");
  $search=$_SESSION['user'].";".$_SESSION['password'].";";
  $result='';
  foreach($data as $line){
    if(substr($line,0,strlen($search))==$search){
	$result .=$search.$repfname.";".$replname.";".$repcolor.";".$reptitle.";".$repimage.PHP_EOL;
    }else{
	$result .=$line;
    }
  }
  file_put_contents("customer-account-info.txt",$result);
  
}



//--------------------------------------------------------
//first page
   if(!isset($_SESSION['login']))
   {
     echo "<title>Welcome to Alan Swink's Assignment 11 PHP page!</title>
	<head>Welcome to Alan Swink's Assignment 11 PHP page!</head>
	<a href='customer-account-info.txt'>Check file</a>
	<body>If you have an existing account, please log in here:
	<form action='assignment11.php' method='GET' name='login'>
	Username:<input type='text' name='username'><br/>
	Password:<input type='password' name='pass'><br/>
	<input type='submit' value='Login'>
	</form>
	<br><hr><br>
	Otherwise, please fill out this form to create an account:
	<form action='assignment11.php' method='GET' name='register'>
	Username:<input type='text' name='newname'><br>
	Password:<input type='password' name='newpass'><br>
	First name:<input type='text' name='first'><br>
	Last name:<input type='text' name='last'><br>
	<input type='hidden' name='create' value='true'>
	<input type='submit' value='Create account'>
	</form></body>";
}
else{//personal page
 // $_SESSION['login']='true';
  $lines=file('customer-account-info.txt');
  $pagedata=array();
  
  foreach($lines as $line){
   $fields=explode(";",$line);
   if(($fields[0]==$_SESSION['user'])&&($fields[1]==$_SESSION['password'])){
     $pagedata=$fields;
   }
  } 
 echo "<div>{$_SESSION['title']}</div>"; 
  $_SESSION['firstname']=$pagedata[2];
  $_SESSION['lastname']=$pagedata[3];
  $_SESSION['color']=$pagedata[4];
  $_SESSION['title']=$pagedata[5];
  $_SESSION['image']=$pagedata[6];  
  fclose('customer-account-info.txt');

  echo "<title>{$_SESSION['title']}</title>
	<head>{$_SESSION['title']}</head>
	<body bgcolor={$_SESSION['color']}>
	<p>{$_SESSION['user']}has logged in with{$_SESSION['password']}</p>
	<form action='assignment11.php' name='logout' method='get'>
	<input type='hidden' value='doLogout' name='status'>
	<input type='submit' value='Logout'></form>
	<img  src=";
  echo	$_SESSION['image'];
  echo  '   height="200px" width="200px"></img>
	<br><hr><br>';

  echo  "<form action='assignment11.php' name='editAccount' method='GET'>
	First name:<input type='text' value='{$_SESSION['firstname']}' name='Accfname'>
	Last name:<input type='text' value='{$_SESSION['lastname']}' name='Acclname'>
	Color:<input type='text' value='{$_SESSION['color']}' name='AccColor'>
	Title:<input type='text' value='{$_SESSION['title']}' name='AccTitle'>
	Image:<input type='text' value='{$_SESSION['image']}' name='AccImage'>
	<input type='submit' value='Make Changes'></form>
	</body>";
}
?>
</html>
