<?php
require_once('database.controller.php');

$query = "SELECT cus.`username`, COUNT(cus.`username`), cus.`id`
FROM `collection` col, `customer` cus
WHERE cus.`id` = col.`customer_id`
GROUP BY cus.`username`;";

$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($username, $count, $id);
$usernames = [];
for($i = 0; $statement->fetch(); $i++){
    $usernames[$i] = ['username' => $username, 'count' => $count, 'id' => $id];
}
$statement->close();