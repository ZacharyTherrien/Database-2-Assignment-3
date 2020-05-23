<?php
//If we're coming from a product page, then we already have product id, customer id and quantity set.
//Otherwise, this controller is called from cart where the info is sent from a POST.

$update = "UPDATE `cart` SET `quantity` = `quantity`+ ? WHERE `product_id` = ? AND `customer_id` = ?";
$statement = $connection->prepare($update);
$statement->bind_param('iii', $quantity, $product_id, $customer_id);
$statement->execute();
$statement->close();