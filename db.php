<?php
$host = 'localhost';
$db = 'user_management';
$user = 'php_user';
$pass = '123';

try{
    // Connect to db
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
}catch (PDOException $e){
    // displaying error of connection
    echo "Error connection to db ".$e->getMessage();
}
?>
