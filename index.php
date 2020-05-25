<?php
    session_start();
    require_once('./controllers/home.select.controller.php');
?>
<!DOCTYPE html>
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
            <fieldset>
            <b><p>Store Description.</p></b>
            <p>As the name implies, we are the ‘Amiibo Store’. Our establishment specializes 
            in selling amiibo figures. Our target demographic consists mostly of young children and 
            young adults who enjoy gaming on compatible Nintendo consoles.</p>
            </fieldset>
            <fieldset>
                <b><p>Store Description</p></b>
                <p>As the name implies, we are the ‘Amiibo Store’. Our establishment specializes 
                in selling amiibo figures. Our target demographic consists mostly of young children 
                and young adults who enjoy gaming on compatible Nintendo consoles.</p>
            </fieldset>
            <fieldset>
                <b><p>Hottest Products</p></b>
                <p>Here are our the bestselling, literally flying off the shelves. 
                Make sure to lock your purchase before it's too late!</p>
            </fieldset>
            <div class="content">
                <ul class="lists">
                <?php foreach ($products as $product) { ?>
                    <li class="productDisplay">
                        <span>
                            <?= "||".$product['name']." Series:".$product['series'] ?>
                            <form action="./products.php" method="GET">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <input type="submit" value="Visit Page">
                            </form>
                        </span>
                    </li>
                 <?php } ?>
                </ul>
            </div>
            <div>
        </main>
        <?php include './includes/include_footer.php';?>
    </body>
</container>