<?php
include 'db.php';

if(isset($_POST['add'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хэширование пароля
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    $sql = "INSERT INTO user (username, password, first_name, last_name, gender, birthdate)
            VALUES (?, ?, ?, ?, ?, ?)";
    $query = $pdo->prepare($sql);
    $query->execute([$username, $password, $first_name, $last_name, $gender, $birthdate]);

    if ($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Ошибка при добавлении данных в базу данных.";
    }
} else {
    echo "Форма не была отправлена корректно.";
}
?>
