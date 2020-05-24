<?php
//session should already be started that requires this controller.
//Values to bind to are found from files that require this controller.
$insert = "INSERT INTO `order` (`customer_id`, `grand_total`) VALUES (?, ?)";
$statement = $connection->prepare($insert);
$statement->bind_param('ii', $customer_id, $total);
$statement->execute();
$statement->close();