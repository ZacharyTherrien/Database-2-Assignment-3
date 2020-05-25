<?php
/*
Error Numbers:
1. No email set
2. No password set.
3. Neither email nor password are set.
4. Either email or password are incorrect.
*/
require_once('database.controller.php');
$email = $_POST['email'];
$pwd = $_POST['password'];
if(empty($email) && empty($pwd)){
    header('Location: ../login.php?err=1');
}
else if(empty($email)){
    header('Location: ../login.php?err=2');
}
else if(empty($pwd)){
    header('Location: ../login.php?err=3');
}
else{
    $query = "SELECT `id`, `username` FROM `customer` WHERE `email` = '$email' AND `password` = '$pwd'";
    $statement = $connection->prepare($query);
    $statement->execute();
    $statement->bind_result($id, $username);
    $statement->store_result();
    if($statement->num_rows == 0){
        header('Location: ../login.php?err=4');
    }
    else{
        $statement->fetch();
        $statement->close();
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
    }
}