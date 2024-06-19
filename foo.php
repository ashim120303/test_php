<?php
include 'db.php';

// Send user to db
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
        header("Location: /");
    } else {
        echo "Error to send user to db.";
    }
}

// Read user from db;
$sql = $pdo->prepare("SELECT * FROM user;");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);
if(!$result) {
    echo "No users found.";
}

// Update user
if (isset($_POST['edit'])) {
    $get_id = $_GET['id'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    // Обновление пароля, если он указан
    if (!empty($_POST['new_password'])) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $sql = ("UPDATE user SET username=?, password=?, first_name=?, last_name=?, gender=?, birthdate=? WHERE id=?;");
        $query = $pdo->prepare($sql);
        $query->execute([$username, $new_password, $first_name, $last_name, $gender, $birthdate, $get_id]);
    } else {
        $sql = ("UPDATE user SET username=?, first_name=?, last_name=?, gender=?, birthdate=? WHERE id=?;");
        $query = $pdo->prepare($sql);
        $query->execute([$username, $first_name, $last_name, $gender, $birthdate, $get_id]);
    }
    if ($query) {
        header("Location: /");
    } else {
        echo "Error to update user in db.";
    }
}

// Delete user
if(isset($_POST['delete'])){
    $get_id = $_POST['id']; // Получаем id пользователя из формы
    $sql = "DELETE FROM user WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$get_id]);

    if ($query) {
        header("Location: /");
        exit; // Важно завершить скрипт после перенаправления
    } else {
        echo "Error to delete user from db.";
    }
}

?>
