<?php
//This controller should only be called from receipt,
//therefore, variables and a connection should already be provided.
$query =   "SELECT `p`.`name`, `p`.`series`, `p`.`price`, `oi`.`quantity` FROM `order_item` AS `oi` 
            JOIN `product` AS `p` ON `oi`.`product_id` = `p`.`id` 
            WHERE `order_id` = '$order_id'";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($name, $series, $price, $quantity);
$purchases = [];
for($i = 0; $statement->fetch(); $i++){
    $statement[$i] = ['name' => $name, 'series' => ];
}