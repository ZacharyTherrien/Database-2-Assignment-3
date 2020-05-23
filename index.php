<?php
    session_start();
    require_once('./controllers/home.select.controller.php');
?>
<!DOCTYPE html>
<!--
    Questions to ask Vik:
    - How to store BLOBs?

    TODOs:
    - Add average rating and reviews for individual products.
    -- ADD TO CART:
    - Add to cart button for a prooduct if customer is logged in.
    - A form should also allow to choose the amount to add.
    - Said form leads to a controller to insert into cart.
    - If less than 1 or over stock amount, send back to product with error message.
    - If user already has item in cart and purchases from product, add to quantity if possible.
    - After a vadlid amount entered send the user to the cart.
    --- CART:
    - In cart, let customer choose whether to continue shopping or checkout.
    - Display for each product its quantity and combined prices and the cart's total price.
    -- CHANGE CART QUANTITY:
    - Each product will have a number input with quantity as its placeholder.
    - A product's quantity can be changed based on input.
    - To finalize new quantities, add a submit button.
    - After submit button is clicked, use new update controller and head back to cart.
    *** In the new controller, have a foreach loop go over $_POST?
    -- REMOVE FROM CART:
    - Each product should have a remove button, completely removing it from customer's cart.
    - If a quantity is submitted as 0, than remove it.
    - Checkout.
    - Collection stuff.

    George TODOs:
    - Create includes of header & footer for each page (don't forget to start_session at top).
    - Create the collections page similarly to the product page.
    - Add images to the database through php.
    - Add better styling to some pages.

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
                <li class="navigationItem"><a href="index.php" class="navigationLink">Home</a></li>
                <li class="navigationItem"><a href="products.php" class="navigationLink">Products</a></li>
                <li class="navigationItem"><a href="collection.php" class="navigationLink">Collection</a></li>
                <?php if(!isset($_SESSION['id'])){ ?>
                    <li class="navigationItem" class="userItem"><a href="registration.php" class="navigationLink">Sign Up</a></li>
                    <li class="navigationItem" class="userItem"><a href="login.php" class="navigationLink">Login</a></li>
                <?php }else{ ?>
                    <li class="navigationItem"><a href="./controllers/logout.controller.php" class="navigationLink">Log Out</a></li>
                    <li class="navigationItem"><a href="./cart.php" class="navigationLink">Cart</a></li>
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
                    TEST AREA: Current user id is set: 
                    <?php if(isset($_SESSION['username']))
                    { echo "yes!";
                      echo " As id: ".$_SESSION['id']." and name: ".$_SESSION['username'];
                    } 
                    ?>
            </div>
        </main>
        <footer>
            <div>You can even find us on <a href="https://twitter.com/Niko_SSBU/status/1263687870935695371?s=20">Twitter</a> and <a href="https://youtu.be/bgTff9S2278">Youtube</a>!</div>
            <div>Amiibo Store ©2020 All Rights Reserved.</div>
        </footer>
    </body>
</container>
	<!-- 
        What should be displayed on the home page.

    -->
    <?php
	
    ?>