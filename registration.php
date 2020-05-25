<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <title>Amiibo Store - Sign Up</title>
    </head>
    <container>
        <body>
            <?php include './includes/include_header.php';?>
            <?php include './includes/include_nav.php';?>
            <main>
                <form action="./controllers/registratrion.controller.php" method="POST">
                    <ul class="lists">
                        <li><input type="text" name="username" placeholder="Username"></li>
                        <li><input type="text" name="first_name" placeholder="First Name"></li>
                        <li><input type="text" name="last_name" placeholder="Last Name"></li>
                        <li><input type="text" name="email" placeholder="Email"></li>
                        <li><input type="password" name="password" placeholder="password"></li>
                        <li><input type="password" name="password_confirmed" placeholder="confirm password"></li>
                        <li><input type="submit" value="Register!"></li>
                    </ul>
                </form>
                <?php if(isset($_GET['err']) && $_GET['err'] == 0){ ?>
                    <div class="Successful_Action">Registration successful!</div>
                <?php } ?>
                <div id="Error_Message">
                    <?php 
                        if(isset($_GET['err'])){
                            switch ($_GET['err']){
                                case 1:
                                    echo "One or more fields were empty.";
                                    break;
                                case 2:
                                    echo "Username length is invalid";
                                    break;
                                case 3:
                                    echo "Passwords did not match.";
                                    break;
                                case 4:
                                    echo "User is already used.";
                                    break;
                                case 5:
                                    echo "Email is already used.";
                                    break;
                            }
                        }
                    ?>
                <div>
            </main>
            <?php include './includes/include_footer.php';?>
        </body>
    </container>
</html>