<?php
$dsn = "mysql:host=localhost;dbname=login_system";
$username = "root";
$pass = "";
try{
    $connect_db = new PDO($dsn,$username,$pass);
}catch(PDOException $ex){
    die("sorry, we can't connect to database" . $ex->getMessage());
}