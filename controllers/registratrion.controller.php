<?php
require_once('./database.controller.php');
//GET NEW USER'S FROM registration.php THROUGH POST.
/*
Error numbers:
1. Empty field.
2. Username too short.
3. Passwords do not match
4. Non-unique username.
5. Non-unique email.
*/
$user = $_POST['username'];
$f_name = $_POST['first_name'];
$l_name = $_POST['last_name'];
$email = $_POST['email'];
$pwd = $_POST['password'];
$pwd_confirmed = $_POST['password_confirmed'];

//echo $pwd." ".$pwd_confirmed;  //Note: having an echo statement makes it so that the header() gives an error.
//echo "|||".$_POST['first_name']."|||";
//echo "|||".$_POST['last_name']."|||";
//echo $user." ".$f_name." ".$l_name." ".$email;
//print_r($_POST);

//Check for empty field or passwords not macthing.
if(empty($user) || empty($f_name) || empty($l_name) || empty($email) || empty($pwd) || empty($pwd_confirmed)){
    //echo "owo";
    header('Location: ../registration.php?err=1');
}
else if(strlen($user) <= 5){
    header('Location: ../registration.php?err=2');
}
else if($pwd !== $pwd_confirmed){
    //echo "uwu";
    header('Location: ../registration.php?err=3');
}
else{
    //Check for already existing username:
    $query = "SELECT `username` FROM `customer` WHERE `username` = '$user'";
    $statement = $connection->prepare($query);
    $statement->execute();
    $statement->store_result();
    //echo "result 1: ".$statement->num_rows;
    if($statement->num_rows > 0){
        header('Location: ../registration.php?err=4');
        //echo "copy username";
    }
    else{
        //Check for already existing email:
        $query = "SELECT `email` FROM `customer` WHERE `email` = '$email'";
        $statement = $connection->prepare($query);
        $statement->execute();
        $statement->store_result();
        //echo "result 2: ".$statement->num_rows;
        if($statement->num_rows > 0){
            header('Location: ../registration.php?err=5');
            //echo "copy email";
        }
        else{
            //Insert fields and add customer.
            $insert = "INSERT INTO `customer` (`username`, `first_name`, `last_name`, `email`, `password`)
                        VALUES (?, ?, ?, ?, ?)";
            //echo $insert;
            $statement = $connection->prepare($insert);
            $statement->bind_param('sssss', $user, $f_name, $l_name, $email, $pwd_confirmed);
            $statement->execute();
            $statement->close();
            //echo "yyyyyyy";
            //NOW LOG IN  THE USER?
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            header('Location: ../registration.php?err=0');
            //header('Location: ./login.controller.php');
            //header('Location: ../index.php');
        }
    }
}