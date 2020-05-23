<?php
//echo "heyhey hey. We made it! Wait up Tails.";
$insert = "INSERT INTO `cart` (`product_id`, `customer_id`, `quantity`) VALUES (?, ?, ?)";
$statement = $connection->prepare($insert);
//echo $product_id." ";
//secho $customer_id." ";
//echo $quantity;
$statement->bind_param('iii', $product_id, $customer_id, $quantity);
$statement->execute();
$statement->close();