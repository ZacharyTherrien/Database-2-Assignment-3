<?php
session_start();
require_once('./controllers/database.controller.php');
$id=0;
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
if($id == 0){
}
else{
    require_once('./controllers/product.controller.php');
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
                    //$name, etc... are provided from the product controller.
                    //Entrance to here can only be done is product controller is reached too.
                    $product_id = $_GET['id'];
                    echo "ID:".$product_id;
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
                <?php } ?>
            </main>
        </body>
    </container>
</html>