<?php
session_start();

// Check if user is not logged in or is not an admin; redirect to login page if conditions are not met
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header('Location: login.html');
    exit();
}
?>
