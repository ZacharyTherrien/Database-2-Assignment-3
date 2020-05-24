<?php
require_once('database.controller.php');
//The $id is provided before this is called.
$query = "SELECT pro.`name`, pro.`series`, col.`recent_game`, col.`obtained_on`
FROM `collection` col, `product` pro
WHERE col.`customer_id` = $id AND col.`product_id` = pro.`id`";
//Old query, no longer need to get the review info since another controller does that.
//"SELECT `p`.`name`, `p`.`description`, `p`.`price`, `p`.`series`, `r`.`comment`, `r`.`rating`
//FROM `product` AS `p` LEFT OUTER JOIN `review` AS `r` ON `p`.`id` = `r`.`product_id` 
//WHERE `id` = '$id'";
//Old query, before adding reviews to the product page:
//"SELECT `name`, `description`, `price`, `series` FROM `product` WHERE `id` = $id";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($name, $series, $recent_game, $obtained_on);
$amiibos = [];
for($i = 0; $statement->fetch(); $i++){
    $amiibos[$i] = ['username' => $username, 'count' => $count, 'recent_game' => $recent_game, 'obtained_on' => $obtained_on];
}
$statement->close();

