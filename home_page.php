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
       $default="lightgreen;Welcome to Grocery to Go!;http://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Stick_Figure.svg/170px-Stick_Figure.svg.png".PHP_EOL;
       $fh=fopen("customer-account-info.txt","a+");
       fwrite($fh,$user.";".$passw.";".$fname.";".$lname.";".$default);
       fclose($fh);
       $_SESSION['login']='true';
       $_SESSION['user']=$user;
       $_SESSION['password']=$passw;
       $_SESSION['firstname']=$fname;
       $_SESSION['lastname']=$lname;
       $_SESSION['color']='lightgreen';
       $_SESSION['title']="Welcome to Grocery to Go!";
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
//first page
if(!isset($_SESSION['login']))
{
     echo "
        <title>Grocery 2 Go</title>
        <head> <h1 style='color:lightgreen'><center>Grocery to Go</center></h1></head>
        <body>If you have an existing account, please log in here:
        <table>
        <form action='home_page.php' method='GET' name='login'>
        <tr><td> Username: </td><td> <input type='text' name='username'> </td><tr><br/>
        <tr><td> Password: </td><td> <input type='password' name='pass'> </td></tr><br/>
        </table>
        <input type='submit' value='Login'>
        </form>
        <p style='text-align:right'>
        <a href='http://www.csce.uark.edu/~cwphilli/Grocery-to-Go/about_us.html'> About Us </a>
        </p>
        <br><hr><br>
        Otherwise, please fill out this form to create an account:
        <table>
        <form action='home_page.php' method='GET' name='register'>
        <tr><td> Username: </td><td> <input type='text' name='newname'> </td></tr><br>
        <tr><td> Password: </td><td> <input type='password' name='newpass'> </td></tr><br>
        <tr><td> First name: </td><td> <input type='text' name='first'> </td></tr><br>
        <tr><td> Last name: </td><td> <input type='text' name='last'> </td></tr><br>
        <tr><td> Email: </td><td> <input type = 'text' name='email'> </td></tr><br>
        </table>
        <input type='hidden' name='create' value='true'>
        <input type='submit' value='Create account'>
        </form></body>";

     echo  "<div>First Name: {$_SESSION['firstname']}</div>";
}


 else{
   //catalog page
      $lines=file('customer-account-info.txt');
      $pagedata=array();

      foreach($lines as $line){
      $fields=explode(";",$line);
      if(($fields[0]==$_SESSION['user'])&&($fields[1]==$_SESSION['password'])){
               $pagedata=$fields;
      }
      }
 //echo "<div>{$_SESSION['title']}</div>";
  $_SESSION['firstname']=$pagedata[2];
  $_SESSION['lastname']=$pagedata[3];
  $_SESSION['color']=$pagedata[4];
  $_SESSION['title']=$pagedata[5];
  $_SESSION['image']=$pagedata[6];
  fclose('customer-account-info.txt');

  echo  "<div>First Name: {$_SESSION['firstname']}</div>";

  echo" <h1><center> Grocery to Go Catalog Page </center></h1>
        <table style='width:100%'><tr>
        <td><a href='http://www.csce.uark.edu/~cwphilli/grocery-to-go.php'><center> Shopping Cart </center></a></td>
        <td>
        <form action='home_page.php' name='logout' method='get'>
        <input type='hidden' value='doLogout' name='status'>
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
        <td><a href='http://www.csce.uark.edu/~cwphilli/Grocery-to-Go/account_settings.php' > Account Settings </a></td>
        <td><a href='http://www.csce.uark.edu/~cwphilli/Grocery-to-Go/contact_us.html' > Contact Us </a></td>
        </tr></table>";
}
?>
</html>

