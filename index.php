<?php
    session_start();
    require_once('./controllers/home.select.controller.php');
?>
<!DOCTYPE html>
<!--
    Questions to ask Vik:
    - How to store BLOBs?
    - Do passwords need to be hashed and then stored?
    - Will the collection trigger work if making a purchase?
    - Help on the triggers.
    - Do we need an include for the header?
    - "display all products that are available to purchase on your site" so with stock > 0?
    - Sorting and filtering 3 each or 3 combined?
    - Where should the item quantity be?

    TODOs:
    - 3 filter & sorting for products.
    - Add to cart button for a prooduct if customer is logged in.
    - Cart stuff.
    - Checkout.
    - Collection stuff.

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
                <?php if(!isset($_SESSION['id'])){ ?>
                    <li class="navigationItem" class="userItem"><a href="registration.php">Sign Up</a></li>
                    <li class="navigationItem" class="userItem"><a href="login.php">Login</a></li>
                <?php }else{ ?>
                    <li class="navigationItem"><a href="./controllers/logout.controller.php">Log Out</a></li>
                    <li><span id="userDisplay">Welcome <?= $_SESSION['username'] ?>!</span></li>
                <?php }?>
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
                      echo " As id: ".$_SESSION['id']." and name: ".$_SESSION['username'];
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