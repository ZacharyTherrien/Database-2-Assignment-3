<?php
session_start();
require_once('./controllers/cart.controller.php');
//NO NEED TO SEND ID AS A HIDDEN VALUE AS, SOME PLACES LIKE RECEIPT
//THEY MUST BE LOGGED IN FOR TO ENTER.
$total = 0;
require_once('./controllers/total.controller.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <title>Amiibo Store - Cart</title>
    </head>
    <container>
        <body>
            <!-- Find way *use controller and require* to display TOTAL PRICE! -->
            <?php include './includes/include_header.php';?>
            <?php include './includes/include_nav.php';?>
            <main>
            <h1>Your Cart</h1>
            <form action="products.php">
                <input type="submit" value="Continue?..">
            </form>
            <form action="./controllers/receipt.controller.php" method="POST">
                <input type="submit" value="Purchase!">
            </form>
            <h4>Total Price: <?= $total ?></h4>
            <?php if(isset($_SESSION['id'])){ 
                foreach($items as $item){?>
                    <table>
                        <tr>
                            <td><h3><?= "Amiibo: ".$item['name']; ?></h3></td>
                            <td><h5><?= "Series: ".$item['series']; ?></h4></td>
                        </tr>
                        <tr>
                            <td>
                                <form action="./controllers/cart.update.controller.php" method="POST">
                                    <input type="hidden" name="customer_id" value="<?= $_SESSION['id'] ?>">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>">
                                    <input type="submit" value="Change Quantity">
                                </form>
                            <td>
                            <td>
                                <form action="./controllers/cart.delete.php" method="POST">
                                    <input type="submit" value="Remove From Cart">
                                </form>
                            </td>
                        </tr>
                    </table>
                <?php 
                } ?>
            <?php }
            else { ?>
                <p>In order to view your cart, please make sure to log in.</p>
            <?php 
            } ?>
            </main>
            <?php include './includes/include_footer.php';?>
        </body>
    </container>
</html>