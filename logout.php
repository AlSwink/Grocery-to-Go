<?php
session_start();


 //Checks if there is a login cookie

if(isset($_POST['logout'])){
    $_SESSION=array();  
    session_destroy();
}
 header("Location: home_page.php");
?>
