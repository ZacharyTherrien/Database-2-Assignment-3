<?php
    $host = 'mysql';
    $user = 'root';
    $password = 'rootpassword';
    $database = 'Amiibo_DB';
    $connection = new mysqli($host, $user, $password, $database);
    if($connection->$connect_errno){
         exit("Error: ".$connection->connect_errno);
    }