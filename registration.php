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
                        <li><input type="text" name="first_name" placeholder="first_name"></li>
                        <li><input type="test" name="last_name" placeholder="last_name"></li>
                        <li><input type="email" name="email" placeholder="email"></li>
                        <li><input type="password" name="password"></li>
                        <li><input type="password" name="password_confirmed"></li>
                        <li><input type="submit" value="Register!"></li>
                    </ul>
                </form>
            </main>
        </body>
    </container>
</html>