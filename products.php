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
    //Connections to each filter depending on $_GET:
    //Filter on name, price, review avg (WHERE)
    //Sort by name, review avg, price (ORDER BY)
    $filter;
    $sort;
    //product id 0 = or not set, main catalogue any id > 0 is an individual product.
    //If id == 0, check filter and sort.
    if(!isset($_GET['modified'])){
        require_once('./controllers/products.controller.php');
    }
    else{
        $sort = $_GET['sort'];
        echo "Eyy, her my sort: ".$sort;
        $filter1;
        $filter2;
        $filter3;
        //require_once('./controllers/products.modified.php');
        require_once('./controllers/products.controller.php');
    }
    //Get average ratings.
    require_once('./controllers/review.averages.controller.php');
}
else{
    require_once('./controllers/product.controller.php');
}
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
                <!-- ^ PRODUCT AND THEN PRODUCTS STARTING AFTER THE ELSE> -->
                <div>
                </div>
                <ul>
                    <?php 
                    } 
                    else{   //PRODUCTS CATALOGUE (put into an include) ?>
                    <div>
                        <ul>
                        <form action="./products.php" methos="GET">
                            <li><label>Sort By: </label></li>
                            <input type="hidden" name="modified" value="modified">
                            <li><select name="sort">
                                <option value="name">Name</option>
                                <option value="series">Series</option>
                                <option value="review">Review Score</option>
                            </select></li>
                            <li><label>Filter By:</label></li>
                            <li>Name <input type="text" name="filterName"></input></li>
                            <li>Price <input type="number" name="filterPrice"></input></li>
                            <li>Average Rating <input type="number" name="filterRating"></input></li>
                            <li><input type="submit" value="Use Parameters"></li>
                            <li><a href="./products.php">Use Default</a></li>
                        </form>
                        </ul>
                    </div>
                    <ul class="lists">
                    <?php
                        foreach($products as $product){ ?>
                            <li class="ProductDisplay">
                                <div>
                                    <?= "||".$product['name']." Series: ".$product['series']  ?>
                                    <?php
                                        $productReview =$avgRatings[$product['id']];
                                        if($product['id'] == $productReview['productID']) {
                                            echo "Rating: ".$productReview['avgRating'];
                                        }   
                                        else{
                                            echo "Rating: ";
                                        }
                                    ?>
                                    <form action="./products.php" method="GET">
                                        <input type="hidden" name="id" value='<?= $product['id'] ?>'>
                                        <input type="submit" value="Visit Page">
                                        <!------->
                                    </form>
                                </div>
                            </li>
                    <?php 
                        } ?>
                    </ul>
                    <?php 
                    } ?>
                </ul>
            </main>
        </body>
    </container>
</html>