<?php
require_once('database.controller.php');

$nameFilter = $_GET['search'];
if(!empty($nameFilter))
    $filter = " AND cus.`username` = '$nameFilter'";

$query =    "SELECT cus.`username`, COUNT(cus.`username`), cus.`id`
            FROM `collection` col, `customer` cus
            WHERE cus.`id` = col.`customer_id`";
$query .= $filter;
$query .= " GROUP BY cus.`username`;";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($username, $count, $id);
$usernames = [];
for($i = 0; $statement->fetch(); $i++){
    $usernames[$i] = ['username' => $username, 'count' => $count, 'id' => $id];
}
$statement->close();