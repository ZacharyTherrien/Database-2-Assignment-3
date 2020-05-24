<?php
require_once('database.controller.php');
//Check if the values are coming from the post.
if(isset($_POST['customer_id'])){
    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id'];
}
//Otherwise, it is coming from cart.update.controller where the variables are already set.
$delete = "DELETE FROM `cart` WHERE `product_id` = ? AND `customer_id` = ?";
$statement = $connection->prepare($delete);
$statement->bind_param('ii', $product_id, $customer_id);
$statement->execute();
$statement->close();
//echo $product_id." ".$customer_id;
header('Location: ../cart.php');