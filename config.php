
<?php

$dbname = "petshop_db";
$user = "root";
$pass = "";
$host = "127.0.0.1";

try{
    $conn = new PDO("mysql:host = $host; dbname=$dbname", $user, $pass);
}catch(PDOException $e){
echo    $e->getMessage();
}



