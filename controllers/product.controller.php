<?php
require_once('database.controller.php');
//The $id is provided before this is called.
$query = "SELECT `name`, `description`, `price`, `series`, `stock` FROM `product` WHERE `id` = '$id'";
//Old query, no longer need to get the review info since another controller does that.
//"SELECT `p`.`name`, `p`.`description`, `p`.`price`, `p`.`series`, `r`.`comment`, `r`.`rating`
//FROM `product` AS `p` LEFT OUTER JOIN `review` AS `r` ON `p`.`id` = `r`.`product_id` 
//WHERE `id` = '$id'";
//Old query, before adding reviews to the product page:
//"SELECT `name`, `description`, `price`, `series` FROM `product` WHERE `id` = $id";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($name, $description, $price, $series, $stock);
$statement->fetch();
$statement->close();

