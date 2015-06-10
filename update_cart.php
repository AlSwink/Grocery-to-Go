<?php
session_start();
//if(isset($_POST['cart_add']){
// get the product id
 $id = isset($_POST['product_id']) ? $_POST['product_id'] : NULL;

/*
 * check if the 'cart' session array was created
 * if it is NOT, create the 'cart' session array
 */
if(!is_array($_SESSION['cart_items'])){
    $_SESSION['cart_items'] = array();
}
if(!is_array($_SESSION['item_qty'])){
    $_SESSION['item_qty'] = array();
}

$_SESSION['cart_items'][0]='blank';
$_SESSION['item_qty'][0]=1;
//adds item to cart if not there
if($_POST['product_id']!=NULL){
if(array_search($_POST['product_id'],$_SESSION['cart_items'])){
  $key=array_search($_POST['product_id'],$_SESSION['cart_items']);
  $_SESSION['item_qty'][$key]=$_SESSION['item_qty'][$key]+$_POST['amt'];
  }
else{
  array_push($_SESSION['cart_items'], $id);
  array_push($_SESSION['item_qty'], $_POST['amt']);
  }
}

if(isset($_POST['delete'])){
  unset($_SESSION['cart_items']);
  unset($_SESSION['item_qty']);
  $_SESSION['cart_items']=array();
  $_SESSION['item_qty']=array();
}


    // redirect to product list and tell the user it was added to cart
    header("Location: home_page.php");

?>
