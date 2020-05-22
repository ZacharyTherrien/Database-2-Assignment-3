<?php
require_once('./controllers/database.controller.php');
//CONTROLLER TO DISPLAY AMIIBOS ON HOMES PAGE, CONNECTION FILE LATER.
$query = "SELECT `id`, `name`, `series` FROM `product` ORDER BY `num_sold` DESC LIMIT 5";
$statement = $connection->prepare($query);
$statement->execute();
$statement->bind_result($id, $name,$series);
$products = [];
for($i = 0; $statement->fetch(); $i++){
    $products[$i] = ['id' => $id, 'name' => $name, 'series' => $series];
}
/*Blurt out the contents of the associative array, debugging only.*/
//echo print_r($products);    
$statement->close();