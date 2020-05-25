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
if($quantity < 1){
    header('Location: ../products.php?id='.$product_id.'&err=1');
}
else{
    //Check if the product has enough remaining for the quantity specified.
    //$remaining comes from here.
    require_once('cart.validate.controller.php');
    if($quantity > $remaining){
        header('Location: ../products.php?id='.$product_id.'&err=2');
    }
    else{
        //Perform another query to check whether the product is already in the cart.
        $query = "SELECT `customer_id`, `product_id` FROM `cart` WHERE `product_id` = '$product_id' AND `customer_id` = '$customer_id'";
        $statement = $connection->prepare($query);
        $statement->execute();
        $statement->store_result();
        if($statement->num_rows == 0){   //Check if product is already in cart by checking number of rows returned.
            //If not, use controller to insert.
            require_once('cart.insert.controller.php');
            //Finally, go to cart.
            header('Location: ../cart.php');
        }
        else{                           //Else, require controller to update.
            require_once('cart.update.controller.php');
            //Header depends on updating the cart, so the relocation is done in the controller.
        }
    }
}