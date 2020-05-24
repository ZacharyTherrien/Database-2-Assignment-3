<?php
//If we're coming from a product page, then we already have product id, customer id and quantity set.
//Otherwise, this controller is called from cart where the info is sent from a POST.

if($quantity != 0){         //Update a product's quantity
    $update = "UPDATE `cart` SET `quantity` = `quantity`+ ? WHERE `product_id` = ? AND `customer_id` = ?";
    $statement = $connection->prepare($update);
    $statement->bind_param('iii', $quantity, $product_id, $customer_id);
    $statement->execute();
    $statement->close();
}
else if($quantity == 0){    //Remove product from customer's cart.

}