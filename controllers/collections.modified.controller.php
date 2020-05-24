<?php
require_once('database.controller.php');

$nameFilter = $_GET['name'];
if(!empty($nameFilter))
    $filter = "cus.`username` = '$nameFilter'";

$query =    "SELECT cus.`username`, COUNT(cus.`username`) 
            FROM `collection` col, `customer` cus
            WHERE cus.`id` = col.`customer_id` AND";
$query .= $filter;
$query .= " GROUP BY `id`";
echo ($query);
$statement = $connection->prepare($query);
$statement->execute();
if($statement){
    echo "donzo";
}
$statement->bind_result($id, $name, $series, $rating);
$usernames = [];
for($i = 0; $statement->fetch(); $i++){
    $usernames[$i] = ['username' => $username, 'count' => $count];
}
$statement->close();