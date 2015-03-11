<!DOCTYPE html>
<html>
<?php

   //edits account info
   if(isset($_GET['Accfname'])){
      $repfname=$_GET['Accfname'];
      $replname=$_GET['Acclname'];
      $repemail=$_GET['AccEmail']
      $repcard=$_GET['AccCard'] 
    //  $repcolor=$_GET['AccColor'];
   //   $reptitle=$_GET['AccTitle'];
    //  $repimage=$_GET['AccImage'];
      $data=file("customer-account-info.txt");
      $search=$_SESSION['user'].";".$_SESSION['password'].";";
      $result='';
      foreach($data as $line){
         if(substr($line,0,strlen($search))==$search){
            $result .=$search.$repfname.";".$replname.";".$repemail.";".$repcard.PHP_EOL;
         }
         else{
            $result .=$line;
         }
      }
   file_put_contents("customer-account-info.txt",$result);

   }

echo "<title>User Settings</title>
        <head>User Setings</head>
        <body bgcolor=#A9F5D0}>
        <p>Welcome, {$_SESSION['user']}.</p>
       
        <br><hr><br>';

  echo  "<form action='home_page.php' name='editAccount' method='GET'>
        First name:<input type='text' value='{$_SESSION['firstname']}' name='Accfname'>
        Last name:<input type='text' value='{$_SESSION['lastname']}' name='Acclname'>
        Email: <input type='text' value='{$_SESSION['email']}' name='AccEmail'>
       
        <input type='submit' value='Make Changes'></form>
          
        <center><a href='http://www.csce.uark.edu/~cphilli/Grocery-to-Go/home_page.php'> Catalog Page </a></center>
        <div>First Name: {$_SESSION['firstname']}</div>
        </body>";

?>
</html>

