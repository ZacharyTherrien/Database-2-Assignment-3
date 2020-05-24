<?php
//This controller is called from another controller, all values should be provided 
//alongside connection to database and session start.
//Loop over the array of all items and insert them into the cart.
//items array holds each product id, quantity, name, series and price.
$insert = "INSERT INTO `order_item` (`product_id`, `order_id`, `quantity`, `total`) VALUES (?, ?, ?, ?)";
foreach($items as $item){
    //Calculate total.
    $product_total = $item['quantity'] * $item['price'];
    //Insert, bind, execute.
    $statement = $connection->prepare($insert);
    $statement->bind_param('iiii', $item['product_id'], $order_id, $item['quantity'], $product_total);
    $statement->execute();
}
//Close.
$statement->close();