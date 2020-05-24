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
//echo $id;
if($id == 0){
    //Get average ratings.
    //require_once('./controllers/review.averages.controller.php');
    //Connections to each filter depending on $_GET:
    //Filter on name, price, review avg (WHERE)
    //Sort by name, series, price (ORDER BY)
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
        require_once('./controllers/products.modified.controller.php');
    }
}
else{
    //Controller for a product's info.
    require_once('./controllers/product.controller.php');
    //Controller for reviews of the product.
    require_once('./controllers/review.controller.php');
    echo "AAAAAAAAAAAAAAAAAAAAAAAAA";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <title>Amiibo Store - Products Page</title>
    </head>
    <container>
        <body>
            <?php include './includes/include_header.php';?>
            <?php include './includes/include_nav.php';?>
            <main>
                <?php
                    //Test area:
                    print_r($reviews);
                    echo $avgRating;
                ?>
                <?php
                    //INDIVIDUAL PRODUCT (put into an include)
                    //$name, etc... are provided from the product controller.
                    //Entrance to here can only be done is product controller is reached too.
                    //echo "ID:".$id;
                    if($_GET['id'] && $_GET['id'] != 0){
                ?>
                    <div>
                        <ul class="lists">
                            <li><?= $name ?></li>
                            <li><?= $series ?></li>
                            <li><?= $description ?></li>
                            <li><?= $price ?></li>
                            <?php if(isset($_SESSION['id']) && $stock > 0) { ?>
                                <form action="./controllers/cart.check.controller.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <li><input type="number" name="quantity" value="0"></li>
                                    <li><input type="submit" value="Make Purchase"></li>
                                </form>
                            <li>
                                <?php
                                    $err = $_GET['err'];
                                    if(isset($_GET['err'])){
                                        switch ($_GET['err']){
                                            case 1:
                                                echo "Invalid amount entered.";
                                                break;
                                            case 2:
                                                echo "Apologies, inssufficient stock remaining.";
                                                break;
                                        }
                                    }
                                ?>
                            </li>
                            <?php } 
                            else if ($stock < 1){ ?>
                                <li>Sorry, but this Amiibo is out of stock.</li>
                            <?php }
                            else { ?>
                                <li>You must be logged in order to purchase this item.</li>
                            <?php } ?>
                            <li>Overall Rating: <?= $avgRating ?></li>
                            <li>Reviews:</li>
                        </ul>
                        <ul>
                            <?php foreach($reviews as $review){ ?>                          
                                <li>User Rating: <?= $review['ratings'] ?></li>
                                <li>Comment: <?= $review['comments'] ?></li>
                                <br>
                            <?php } ?>
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
                        <ul class="lists">
                        <form action="./products.php" methos="GET">
                            <input type="hidden" name="modified" value="modified">
                            <li><label>Sort By: </label></li>
                            <li><select name="sort">
                                <option value="None">None</option>
                                <option value="name">Name</option>
                                <option value="series">Series</option>
                                <option value="price">Price</option>
                            </select></li>
                            <li><label>Filter By:</label></li>
                            <li>Name <input type="text" name="name"></input></li>
                            <li>Price <input type="number" name="price"></input></li>
                            <li>Average Rating <input type="number" name="rating"></input></li>
                            <li><input type="submit" value="Use Parameters"></li>
                            <li><a href="./products.php">Use Default</a></li>
                        </form>
                        </ul>
                    </div>
                    <ul class="lists">
                    <?php
                        foreach($products as $product){ ?>
                            <li class="productDisplay">
                                <div>
                                    <?= "||".$product['name']." Series: ".$product['series']." Rating: ".$product['rating'] ?>
                                    <?php
                                        // $product = $avgRatings[$product['id']];
                                        // if($product['id'] == $productReview['productID']) {
                                        //     echo "Rating: ".$productReview['avgRating'];
                                        // }   
                                        // else{
                                        //     echo "Rating: ";
                                        // }
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
        <?php include './includes/include_footer.php';?>
        </body>
    </container>
</html>