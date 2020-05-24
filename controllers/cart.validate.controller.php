<?php
$query = "SELECT `stock` FROM `product` WHERE `id` = '$product_id'";
$statement = $connection->prepare($query); 
$statement->execute();
$statement->bind_result($remaining);
$statement->fetch();
$statement->close();