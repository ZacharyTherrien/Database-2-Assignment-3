<?php
require_once('database.controller.php');
$query = "SELECT `quantity` FROM `cart` WHERE `product_id` = '$product_id' AND `customer_id` = '$customer_id'";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($current_quantity);
$statement->fetch();
$statement->close();