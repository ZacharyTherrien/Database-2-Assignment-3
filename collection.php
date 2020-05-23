<?php
    session_start();
    require_once('./controllers/collection.controller.php');
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
				<ul class="lists">
                <?php
                    foreach($usernames as $username) { ?>
                        <li class="productDisplay">
                            <div><b>
								<?= $username['username']  ?>
                            </b></div>
							<div>
								<?= $username['count'] . " products" ?>
                            </div>
                        </li>
                <?php
                } ?>
				</ul>
            </main>
            <?php include './includes/include_footer.php';?>
        </body>
    </container>
</html>