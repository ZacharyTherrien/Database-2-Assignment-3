<?php
//Get cost of cart after purchasing
$query = "SELECT SUM(`total`) FROM `order_item` WHERE `order_id` = '$order_id'";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($total);
$statement->fetch();
$statement->close();