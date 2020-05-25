<?php
require_once('database.controller.php');

$query = "SELECT pro.`name`, pro.`series`, col.`recent_game`, col.`obtained_on`, cus.`username`
FROM `collection` col, `product` pro, `customer` cus
WHERE col.`customer_id` = $id AND col.`product_id` = pro.`id` AND cus.`id` = $id";

$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($name, $series, $recent_game, $obtained_on, $username);
$amiibos = [];
for($i = 0; $statement->fetch(); $i++){
    $amiibos[$i] = ['name' => $name, 'series' => $series, 'recent_game' => $recent_game, 'obtained_on' => $obtained_on, 'username' => $username];
}
$statement->close();

