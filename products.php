<?php
session_start();
//require_once('./controllers/database.controller.php');
$id=0;
$filter=0;
$sort=0;
if(isset($_GET['id'])){
    $id=$_GET['id'];
    echo "here!";
}
echo $id;
if($id == 0){
    require_once('./controllers/products.controller.php');
}
else{
    require_once('./controllers/product.controller.php');
    echo "AYOOO";
}
//Connections to each filter depending on $_GET:
//product id 0 = or not set, main catalogue any id > 0 is an individual product.
//If id == 0, check filter and sort.
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <title>Amiibo Store</title>
    </head>
    <container>
        <body>
            <main>
                <?php
                    //Test area:
                    //print_r($products);
                ?>
                <?php
                    //INDIVIDUAL PRODUCT (put into an include)
                    //$name, etc... are provided from the product controller.
                    //Entrance to here can only be done is product controller is reached too.
                    //echo "ID:".$id;
                    if($_GET['id'] && $_GET['id'] != 0){
                ?>
                    <div>
                        <ul>
                            <li><?= $name ?></li>
                            <li><?= $series ?></li>
                            <li><?= $description ?></li>
                            <li><?= $price ?></li>
                        </ul>
                    </div>
                <!-- ^ PRODUCT AND THEN PRODUCTS > -->
                <div>
                        
                </div>
                <ul>
                    <?php 
                    } 
                    else{   //PRODUCTS CATALOGUE (put into an include)
                        foreach($products as $product){ ?>
                            <li>
                                <span>
                                    <form action="./products.php" method="GET">
                                        <input type="hidden" name="id" value='<?= $product['id'] ?>'>
                                        <input type="submit" value='<?= $product['name'] ?>'>
                                    </form>
                                    <?= $product['series'] ?>
                                </span>
                            </li>
                    <?php 
                        }
                    } ?>
                </ul>
            </main>
        </body>
    </container>
</html>