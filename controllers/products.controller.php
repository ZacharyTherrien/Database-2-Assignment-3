<?php
require_once('database.controller.php');
//Only shows products avilable to purchase (AKA stock than 0 in stock).
//DEFAULT QUERY DISPLAYS NEWEST AMIIBOS FIRST.
$query =   "SELECT `id`, `name`, `series`, AVG(`r`.`rating`) FROM `product` AS `p`
            LEFT OUTER JOIN `review` AS `r` ON `p`.`id` = `r`.`product_id`
            GROUP BY `id`";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($id, $name, $series, $rating);
$products = [];
for($i = 0; $statement->fetch(); $i++){
    $products[$i] = ['id' => $id, 'name' => $name, 'series' => $series, 'rating' => $rating];
}
$statement->close();