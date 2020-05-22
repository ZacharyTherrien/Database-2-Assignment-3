<?php
require_once('database.controller.php');
//Only shows products avilable to purchase (AKA stock than 0 in stock).
//DEFAULT QUERY DISPLAYS NEWEST AMIIBOS FIRST.
$query = "SELECT `id`, `name`, `series` FROM `product`ORDER BY `id` DESC";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($id, $name, $series);
$products = [];
for($i = 0; $statement->fetch(); $i++){
    $products[$i] = ['id' => $id, 'name' => $name, 'series' => $series];
}
$statement->close();