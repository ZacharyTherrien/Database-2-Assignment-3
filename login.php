<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <title>Amiibo Store - Login</title>
    </head>
    <container>
        <body>
            <?php include './includes/include_header.php';?>
            <?php include './includes/include_nav.php';?>
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
            <?php include './includes/include_footer.php';?>
        </body>
    </container>
</html>