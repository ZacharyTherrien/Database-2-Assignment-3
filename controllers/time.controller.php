<?php
//Get the current time through SQL.
require_once('database.controller.php');
$query = "SELECT NOW()";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($time);
$statement->fetch();
$statement->close();