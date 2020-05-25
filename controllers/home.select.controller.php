<?php
require_once('database.controller.php');
$query = "SELECT `id`, `name`, `series` FROM `product` ORDER BY `num_sold` DESC LIMIT 5";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($id, $name, $series);
$products = [];
for($i = 0; $statement->fetch(); $i++){
    $products[$i] = ['id' => $id, 'name' => $name, 'series' => $series];
}    
$statement->close();