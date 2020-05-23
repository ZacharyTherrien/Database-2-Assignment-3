<?php
session_start();
require_once('database.controller.php');
/*
Errors:
1. Invalid quantity provided
2. Insufficient remaining stock, sorry.
*/
$product_id = $_POST['id'];
$customer_id = $_SESSION['id'];
$quantity = $_POST['quantity'];
//echo $product_id." ".$customer_id." ".$quantity;
if($quantity < 1){
    header('Location: ../products.php?id='.$product_id.'&err=1');
}
else{
    $query = "SELECT `quantity` FROM `cart` WHERE `product_id` = '$product_id' AND `customer_id` = '$customer_id'";
    $statement = $connection->prepare($query); 
    $statement->bind_result($remaining);
    //echo $remaining;
    if($quantity > $remaining){
        //echo "TOO MUCH POWERRRR!";
        header('Location: ../products.php?id='.$product_id.'&err=2');
    }
    else{
        //Perform another query.
        //Check if product is already in cart by checking number of rows returned.
        //If not, use controller to insert.
        //Else, controller to update.
        //Finally, go to cart.
    }
}