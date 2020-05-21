<?php
require_once('database.controller.php');
//The $id is provided before this is called.
$query = "SELECT `name`, `description`, `price`, `series` FROM `product` WHERE `id` = $id";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($name, $description, $price, $series);
$statement->fetch();
$statement->close();

