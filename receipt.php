<?php
session_start();
require_once('database.controller.php');
$order_id = $_SESSION['order'];
$time;
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
                <h3>Made on: <?= $time ?></h3>
                
            </main>
        </body>
        <?php include './includes/include_footer.php';?>
    </container>
</html>