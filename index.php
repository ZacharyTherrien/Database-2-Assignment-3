<?php
    session_start();
    require_once('./controllers/database.controller.php');
    //CONTROLLER TO DISPLAY AMIIBOS ON HOMES PAGE, CONNECTION FILE LATER.
    $query = "SELECT `id`, `name`, `series` FROM `product` ORDER BY `num_sold` DESC LIMIT 5";
    $statement = $connection->prepare($query);
    $statement->execute();
    $statement->bind_result($id, $name,$series);
    $products = [];
    for($i = 0; $statement->fetch(); $i++){
        $products[$i] = ['id' => $id, 'name' => $name, 'series' => $series];
    }
    /*Blurt out the contents of the associative array, debugging only.*/
    //echo print_r($products);    
    $statement->close();
?>
<!DOCTYPE html>
<!--
    Questions to ask Vik:
    - How to store BLOBs?
    - Do passwords need to be hashed and then stores?
    - Will the collection trigger work if making a purchase?
    - When inserting a new customer, how do we check for unique fields?
    - Help for registrations.
    **NOTE, customer & admins now have INSERT rights on customer table.
    - Current session does not display id.

    Ideas:
    - A collection home page: demonstrate a bunch of collections.
    - A page for individual collections.
-->
<head>
    <!-- SHOULD THIS ALSO BE IN A SNIPPET OF CODE?!? -->
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
    <title>Amiibo Store</title>
</head>
<container>
    <body>
        <header>
            <h1>🗦 Amiibo Store 🗧</h1>
        </header>
        <nav>
            <ul id="navigationBar">
                <li class="navigationItem"><a href="index.php">Home</a></li>
                <li class="navigationItem"><a href="products.php">Prodcuts</a></li>
                <li class="navigationItem"><a href="collection.php">Collection</a></li>
				<li class="navigationItem" class="userItem"><a href="registration.php">Sign Up</a></li>
                <li class="navigationItem" class="userItem"><a href="login.php">Login</a></li>
            </ul>
        </nav>
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
                <ul>
                <?php foreach ($products as $product) { ?>
                    <li>
                        <span>
                            <form action="./products.php" method="GET">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <input type="submit" value="<?= $product['name'] ?>">
                            </form>
                            <?= " || ".$product['series'] ?>
                        </span>
                    </li>
                 <?php } ?>
                </ul>
            </div>
            <div>
                    TEST AREA: Current user id is set: 
                    <?php if(isset($_SESSION['username']))
                    { echo "yes!";
                    } 
                    ?>
            </div>
        </main>
        <footer>
            <span>Amiibo Store ©2020 All Rights Reserved.</span>
        </footer>
    </body>
</container>
	<!-- 
        What should be displayed on the home page.

    -->
    <?php
	
    ?>