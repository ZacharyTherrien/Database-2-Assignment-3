<?php
require_once('./database.controller.php');
//GET NEW USER'S FROM registration.php THROUGH POST.
/*
Error numbers:
1. Empty field.
2. Passwords do not match
3. Non-unique email.
4. Non-unique password.
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
else if($pwd !== $pwd_confirmed){
    //echo "uwu";
    header('Location: ../registration.php?err=2');
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
    header('Location: ../index.php');
}