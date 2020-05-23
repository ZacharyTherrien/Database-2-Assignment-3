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