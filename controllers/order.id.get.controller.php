<?php
$query = "SELECT `id` FROM `order` WHERE `customer_id` = '$customer_id' ORDER BY `made_on` DESC";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($order_id);
$statement->fetch();
$statement->close();