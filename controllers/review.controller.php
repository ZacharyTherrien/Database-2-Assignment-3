<?php
require_once('database.controller.php');
$query = "SELECT `rating`, `comment` FROM `review` WHERE `product_id` = '$id'";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($ratings, $comments);
$reviews = [];
for($i = 0; $statement->fetch(); $i++){
    $reviews[$i] = ['ratings' => $ratings, 'comments' => $comments];
    echo $ratings;
    echo $comments;
}
$query = "SELECT AVG(`rating`) FROM `review` WHERE `product_id` = '$id'";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($avgRating);
$statement->fetch();
$statement->close();