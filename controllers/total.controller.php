<?php
//Get total cost of all items in a customer's cart.
require_once('database.controller.php');
$id = $_SESSION['id'];
$query =   "SELECT SUM(`quantity` * `price`) FROM `cart` JOIN `product` ON `product_id` = `id`
            WHERE `customer_id` = '$id'";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($total);
$statement->fetch();
$statement->close();