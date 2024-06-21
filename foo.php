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
    $role = $_POST['role'];

    $sql = "INSERT INTO user (username, password, first_name, last_name, gender, birthdate, role)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $query = $pdo->prepare($sql);
    $query->execute([$username, $password, $first_name, $last_name, $gender, $birthdate, $role]);

    if ($query) {
        header("Location: /");
    } else {
        echo "Error to send user to db.";
    }
}

// Update user
if (isset($_POST['edit'])) {
    $get_id = $_GET['id'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $role = $_POST['role'];

    // Отладочная информация
    echo "ID: " . htmlspecialchars($get_id) . "<br>";
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "First Name: " . htmlspecialchars($first_name) . "<br>";
    echo "Last Name: " . htmlspecialchars($last_name) . "<br>";
    echo "Gender: " . htmlspecialchars($gender) . "<br>";
    echo "Birthdate: " . htmlspecialchars($birthdate) . "<br>";
    echo "Role: " . htmlspecialchars($role) . "<br>";
    if (!empty($_POST['new_password'])) {
        echo "New Password is set<br>";
    }

    // Обновление пароля, если он указан
    if (!empty($_POST['new_password'])) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $sql = "UPDATE user SET username=?, password=?, first_name=?, last_name=?, gender=?, birthdate=?, role=? WHERE id=?;";
        $query = $pdo->prepare($sql);
        $result = $query->execute([$username, $new_password, $first_name, $last_name, $gender, $birthdate, $role, $get_id]);
    } else {
        $sql = "UPDATE user SET username=?, first_name=?, last_name=?, gender=?, birthdate=?, role=? WHERE id=?;";
        $query = $pdo->prepare($sql);
        $result = $query->execute([$username, $first_name, $last_name, $gender, $birthdate, $role, $get_id]);
    }

    if ($result) {
        header("Location: /");
    } else {
        echo "Error updating user in db.";
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

// filters
// Формируем SQL-запрос на основе фильтров
$sql = "SELECT * FROM user WHERE 1=1";

$filters = [];

if (!empty($_GET['gender'])) {
    $filters[] = "gender = :gender";
}
if (!empty($_GET['role'])) {
    $filters[] = "role = :role";
}
if (!empty($_GET['birthdate_start'])) {
    $filters[] = "birthdate >= :birthdate_start";
}
if (!empty($_GET['birthdate_end'])) {
    $filters[] = "birthdate <= :birthdate_end";
}
if (!empty($_GET['username_search'])) {
    $filters[] = "username LIKE :username_search";
}
if (!empty($_GET['alphabet'])) {
    $alphabet_order = ($_GET['alphabet'] == 'ASC') ? 'ASC' : 'DESC';
    $order_by = " ORDER BY username $alphabet_order";
} else {
    $order_by = "";
}

if (count($filters) > 0) {
    $sql .= " AND " . implode(" AND ", $filters);
}

$sql .= $order_by;

$query = $pdo->prepare($sql);

if (!empty($_GET['gender'])) {
    $query->bindParam(':gender', $_GET['gender'], PDO::PARAM_STR);
}
if (!empty($_GET['role'])) {
    $query->bindParam(':role', $_GET['role'], PDO::PARAM_STR);
}
if (!empty($_GET['birthdate_start'])) {
    $query->bindParam(':birthdate_start', $_GET['birthdate_start'], PDO::PARAM_STR);
}
if (!empty($_GET['birthdate_end'])) {
    $query->bindParam(':birthdate_end', $_GET['birthdate_end'], PDO::PARAM_STR);
}
if (!empty($_GET['username_search'])) {
    $username_search = '%' . $_GET['username_search'] . '%';
    $query->bindParam(':username_search', $username_search, PDO::PARAM_STR);
}

$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
?>
