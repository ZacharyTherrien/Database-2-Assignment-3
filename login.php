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
                <form action="./controllers/login.controller.php" method="POST">
                    <input type="text" name="email" placeholder="email">
                    <input type="password" name="password" placeholder="password">
                    <input type="submit" value="Log in">
                </form>
                <div class="Error_Message">
                <?php 
                    if(isset($_GET['err'])){
                        switch ($_GET['err']){
                            case 1:
                                echo "Neither email nor password set";
                                break;
                            case 2:
                                echo "No email set.";
                                break;
                            case 3:
                                echo "No password set.";
                                break;
                            case 4:
                                echo "Either email or password are invalid.";
                                break;
                        }
                    }
                ?>
                </div>
            </main>
        </body>
    </container>
</html>