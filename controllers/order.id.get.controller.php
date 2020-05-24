<?php
$query = "SELECT `id` FROM `order` WHERE `customer_id` = '$customer_id' ORDER BY `made_on` DESC";
//Query v.1 Did an all select and did not go by descending order.
//"SELECT * FROM `order` WHERE `customer_id` = '$customer_id' ORDER BY `made_on`";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($order_id);
$statement->fetch();
$statement->close();