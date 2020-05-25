<?php
    session_start();
    //require_once('./controllers/collections.controller.php');

$id=0;
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

if($id == 0) {
    //username id 0 = or not set, main catalogue any id > 0 is an individual collection.
    //If id == 0, check filter and sort.
    if(!isset($_GET['modified'])) {
        require_once('./controllers/collections.controller.php');
    }
    else{
        require_once('./controllers/collections.modified.controller.php');
        $search = $_GET['search'];
        echo "You searched for: ". $search;
    }
}
else {
    //Controller for a indiviudla collections.
    require_once('./controllers/collection.controller.php');
    echo "individual collection for " . $id;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <title>Amiibo Store - Collection</title>
    </head>
    <container>
        <body>
            <?php include './includes/include_header.php';?>
            <?php include './includes/include_nav.php';?>
            <main>
            <?php
                //INDIVIDUAL COLLECTION (put into an include)
                if($_GET['id'] && $_GET['id'] != 0) {
            ?>
            <div>
                <ul class="lists">
                <?php
                    foreach($amiibos as $amiibo) { ?>
                        <li class="productDisplay">
                            <div>
                                <?= '<b>' . $amiibo['username'] . '</b>' . "'s collection" ?>
                            </div>
                            <div>
                                <?= $username['count'] . " amiibo" ?>
                            </div>
                            <hr>
                        </li>
                    <?php
                    } ?>
                </ul>
            </div>
            <ul class="lists">
            <?php 
                } 
                else{   //COLLECTIONS LIST (put into an include) ?>
                    <ul class="lists">
                    <form action="./collection.php" methos="GET">
                        <input type="hidden" name="modified" value="modified">
                        <li><input type="text" name="search"></input></li>
                        <li><input type="submit" value="Search"></li>
                    </form>
                    <?php foreach($usernames as $username) { ?>
                            <li class="productDisplay">
                                <div>
                                    <?= '<b>' . $username['username'] . '</b>' . "'s collection" ?>
                                </div>
                                <div>
                                    <?= $username['count'] . " amiibo" ?>
                                </div>
                                <form action="./collection.php" method="GET">
                                    <input type="hidden" name="id" value='<?= $username['id'] ?>'>
                                    <input type="submit" value="Visit Page">
                                </form>
                                <hr>
                            </li>
                        <?php
                    } ?>
                    </ul>
                <?php 
                } ?>
            </main>
            <?php include './includes/include_footer.php';?>
        </body>
    </container>
</html>