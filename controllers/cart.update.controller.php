<?php
/* Possible errors:
1. Invalid quantity specified.
2. Insufficient stock remaining.
*/
require_once('database.controller.php');
//If we're coming from a product page, then we already have product id, customer id and quantity set.
//Otherwise, this controller is called from cart where the info is sent from a POST.
//echo $_POST['customer_id'];
if(isset($_POST['customer_id'])){   //Goes here if update through cart.
    //echo "YES!";
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    //echo $quantity;
    if($quantity == 0){    //Remove product from customer's cart.
        //Require once the cart delete controller.
    }
    else if($quantity < 0){
        header('Location: ../cart.php?err=1');
    }
    else{
        //First validate amount.
        require_once('cart.validate.controller.php');
        if($quantity > $remaining){
            header('Location: ../cart.php?err=2');
        }
        else{
            $update = "UPDATE `cart` SET `quantity` = ? WHERE `product_id` = ? AND `customer_id` = ?";
            $statement = $connection->prepare($update);
            $statement->bind_param('iii', $quantity, $product_id, $customer_id);
            $statement->execute();
            $statement->close();
            header('Location: ../cart.php');
        }
    }
}
else if($quantity > 0){             //Update a product's quantity, if added through product page. Validation already done.
    //VALIDATION HERE PLEASE!
    //Find the current product's quantity first.
    $query = "SELECT `quantity` FROM `cart` WHERE `product_id` = '$product_id' AND `customer_id` = '$customer_id'";
    $statement = $connection->prepare($query);
    $statement->execute();
    $statement->bind_result($current_quantity);
    $statement->fetch();
    $statement->close();
    //Add current amount to new amount.
    $quantity = $quantity + $current_quantity;
    //echo $current_quantity." ";
    //echo $quantity;
    //Then validate the new amount.
    require_once('cart.validate.controller.php');
    if($quantity > $remaining){
        header('Location: ../cart.php?err=2');
    }
    else{                           //Quantity to add to current is good, update and go to cart and collect 200!
        $update = "UPDATE `cart` SET `quantity` = ? WHERE `product_id` = ? AND `customer_id` = ?";
        $statement = $connection->prepare($update);
        $statement->bind_param('iii', $quantity, $product_id, $customer_id);
        $statement->execute();
        $statement->close();
        header('Location: ../cart.php');
    }
}