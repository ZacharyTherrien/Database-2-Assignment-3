<?php
//This should only be called after making an order.
//Ergo, all variables, connctions, etc should already be provided.
$delete = "DELETE FROM `cart` WHERE `customer_id` = ?";
$statement = $connection->prepare($delete);
$statement->bind_param('i', $customer_id);
$statement->execute();
$statement->close();