<?php
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

    }
    $update = "UPDATE `cart` SET `quantity` = ? WHERE `product_id` = ? AND `customer_id` = ?";
    $statement = $connection->prepare($update);
    $statement->bind_param('iii', $quantity, $product_id, $customer_id);
    $statement->execute();
    $statement->close();
    header('Location: ../cart.php');
}
else if($quantity > 0){             //Update a product's quantity, if added through product page.
    $update = "UPDATE `cart` SET `quantity` = `quantity`+ ? WHERE `product_id` = ? AND `customer_id` = ?";
    $statement = $connection->prepare($update);
    $statement->bind_param('iii', $quantity, $product_id, $customer_id);
    $statement->execute();
    $statement->close();
}