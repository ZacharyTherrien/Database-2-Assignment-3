<?php
/* Possible errors:
1. Invalid quantity specified.
2. Insufficient stock remaining.
*/
require_once('database.controller.php');
//If we're coming from a product page, then we already have product id, customer id and quantity set.
//Otherwise, this controller is called from cart where the info is sent from a POST.
if(isset($_POST['customer_id'])){   //Goes here if update through cart.
    //echo "YES!";
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    if($quantity == 0){    //Remove product from customer's cart.
        //Require once the cart delete controller.
        //Header is in the controller.
        require_once('cart.delete.controller.php');
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
    require_once('cart.quantity.check.controller.php');
    //Add current amount to new amount.
    $quantity = $quantity + $current_quantity;
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