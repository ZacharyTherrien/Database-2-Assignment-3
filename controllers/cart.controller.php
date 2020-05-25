<?php
session_start();
require_once('database.controller.php');
$id = $_SESSION['id'];
$query =   "SELECT `c`.`product_id`, `c`.`quantity`, `p`.`name`, `p`.`series`, `p`.`price` FROM `cart` AS `c` 
            JOIN `product` AS `p` ON `c`.`product_id` = `p`.`id` 
            WHERE `customer_id` = '$id'";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($product_id, $quantity, $name, $series, $price);
//Grab number of rows:
$statement->store_result();
$numItems = $statement->num_rows;
$items = [];
for($i = 0; $statement->fetch(); $i++){
    $items[$i] = ['product_id' => $product_id, 'quantity' => $quantity, 'name' => $name, 'series' => $series, 'price' => $price];
}
$statement->close();