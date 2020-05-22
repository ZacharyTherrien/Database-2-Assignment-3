<?php
/*
Error numbers:
1. Empty field.
2. Passwords do not match
3. Non-unique username.
4. Non-unique email.
*/
?>
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
                                    echo "Passwords did not match.";
                                    break;
                                case 3:
                                    echo "User is already used.";
                                    break;
                                case 4:
                                    echo "Email is already used.";
                                    break;
                                case 5:
                                    echo "Username length is invalid";
                                    break;
                            }
                        }
                    ?>
                <div>
            </main>
        </body>
    </container>
</html>