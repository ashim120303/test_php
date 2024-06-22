<?php
session_start();
require 'db.php'; // Файл с подключением к базе данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Подготовка SQL запроса для выборки данных о пользователе
    $sql = "SELECT id, username, password, role, first_name FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Пользователь найден, проверяем пароль
        if (password_verify($password, $user['password'])) {
            // Пароль верный, устанавливаем сессионные переменные
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['first_name'] = $user['first_name'];

            // Перенаправляем на главную страницу после успешной авторизации
            header('Location: index.php');
            exit();
        } else {
            // Неверный пароль
            echo 'Неправильный пароль';
        }
    } else {
        // Пользователь не найден
        echo 'Пользователь не найден';
    }
}
?>
