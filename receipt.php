<?php
session_start();
$order_id = $_SESSION['order'];
require_once('controllers/database.controller.php');
require_once('controllers/receipt.order.controller.php');
$time;
$total = 0;
require_once('controllers/time.controller.php');
require_once('controllers/checkout.total.controller.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <title>Amiibo Store - Home</title>
    </head>
    <container>
        <body>
            <?php include './includes/include_header.php';?>
            <?php include './includes/include_nav.php';?>
            <main>
                <h1>Your receipt:</h1>
                <h3>Total Price: <?= $total ?></h3>
                <h4>Made on: <?= $time ?></h4>
                <ul class="lists">
                    <?php foreach($purchases as $purchase){ ?>
                        <li>Item name: <?= $purchase['name'] ?></li>
                        <li>Series: <?= $purchase['series'] ?></li>
                        <li>Price: <?= $purchase['price'] ?></li>
                        <li>Quantity: <?= $purchase['quantity'] ?></li>
                        <br>
                    <?php 
                    }?>
                </ul>
            </main>
        </body>
        <?php include './includes/include_footer.php';?>
    </container>
</html>