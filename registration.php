<?php
/*
Error numbers:
1. Empty field.
2. Passwords do not match
3. Non-unique email.
4. Non-unique password.
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
                    <ul>
                        <li><input type="text" name="username" placeholder="Username"></li>
                        <li><input type="text" name="first_name" placeholder="First Name"></li>
                        <li><input type="test" name="last_name" placeholder="Last Name"></li>
                        <li><input type="text" name="email" placeholder="Email"></li>
                        <li><input type="password" name="password"></li>
                        <li><input type="password" name="password_confirmed"></li>
                        <li><input type="submit" value="Register!"></li>
                    </ul>
                </form>
                <div id="Error_Message">
                    Err=<?= $_GET['err']?>
                <div>
            </main>
        </body>
    </container>
</html>