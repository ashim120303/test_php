<?php
session_start();
require 'db.php'; // File with database connection

// Handle POST request for login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to fetch user data
    $sql = "SELECT id, username, password, role, first_name FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User found, verify password
        if (password_verify($password, $user['password'])) {
            // Password correct, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['first_name'] = $user['first_name'];

            // Redirect to the main page after successful login
            header('Location: index.php');
            exit();
        } else {
            // Incorrect password
            echo 'Incorrect password';
        }
    } else {
        // User not found
        echo 'User not found';
    }
}
?>
