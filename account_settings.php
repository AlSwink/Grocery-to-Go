<!DOCTYPE html>
<html>
<?php

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
         }
         else{
            $result .=$line;
         }
      }
   file_put_contents("customer-account-info.txt",$result);

   }

echo "<title>{$_SESSION['title']}</title>
        <head>{$_SESSION['title']}</head>
        <body bgcolor={$_SESSION['color']}>
        <p>{$_SESSION['user']}has logged in with{$_SESSION['password']}</p>
        <img  src=";
  echo  $_SESSION['image'];
  echo  '   height="200px" width="200px"></img>
        <br><hr><br>';

  echo  "<form action='home_page.php' name='editAccount' method='GET'>
        First name:<input type='text' value='{$_SESSION['firstname']}' name='Accfname'>
        Last name:<input type='text' value='{$_SESSION['lastname']}' name='Acclname'>
        Color:<input type='text' value='{$_SESSION['color']}' name='AccColor'>
        Title:<input type='text' value='{$_SESSION['title']}' name='AccTitle'>
        Image:<input type='text' value='{$_SESSION['image']}' name='AccImage'>
        <input type='submit' value='Make Changes'></form>

        <center><a href='http://www.csce.uark.edu/~cwphilli/Grocery-to-Go/home_page.php'> Catalog Page </a></center>
        <div>First Name: {$_SESSION['firstname']}</div>
        </body>";

?>
</html>

