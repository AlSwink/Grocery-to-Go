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
if($_POST['product_id']!=NULL){
  array_push($_SESSION['cart_items'], $id);
}

//if(isset($_POST['delete']){
//$_SESSION['cart_items']=array();


    // redirect to product list and tell the user it was added to cart
    header("Location: home_page.php");

?>
