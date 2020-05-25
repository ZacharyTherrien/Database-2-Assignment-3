<?php
session_start();
require_once('database.controller.php');
$customer_id = $_SESSION['id'];
//Get associative array of all cart items. Get the items array.
require_once('cart.controller.php');
//Get the total cost. As total.
require_once('total.controller.php');
//Require controller to insert into order.
require_once('order.insert.controller.php');
//Get the order id.
require_once('order.id.get.controller.php');
//Require controller to insert into order_item
require_once('order_item.insert.controller.php');
//Set order id of session.
$_SESSION['order'] = $order_id;
//Delete from their cart.
require_once('receipt.cart.delete.controller.php');
//Head to receipt.
header('Location: ../receipt.php');