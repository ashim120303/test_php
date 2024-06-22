<?php require 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/add-user.css">
</head>
<body>
<div class="wrapper">
    <?php
    // Include database connection
    include 'db.php';

    // Initialize variables for form fields
    $username = '';
    $first_name = '';
    $last_name = '';
    $gender = '';
    $birthdate = '';
    $role = '';

    // Check if ID is provided in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM user WHERE id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        // Populate form fields with user data
        if ($user) {
            $username = $user->username;
            $first_name = $user->first_name;
            $last_name = $user->last_name;
            $gender = $user->gender;
            $birthdate = $user->birthdate;
            $role = $user->role;
        } else {
            // Handle case where user with given ID is not found
            echo '<p>User not found.</p>';
            exit; // Exit script
        }
    } else {
        // Handle case where ID is not provided in the URL
        echo '<p>User ID not provided.</p>';
        exit; // Exit script
    }
    ?>

    <form action="foo.php?id=<?php echo htmlspecialchars($id); ?>" method="post" class="form">
        <p class="form__text">Username</p>
        <input type="text" class="form__input" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
        <p class="form__text">New Password</p>
        <input type="password" class="form__input" name="new_password">
        <p class="form__text">First Name</p>
        <input type="text" class="form__input" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
        <p class="form__text">Last Name</p>
        <input type="text" class="form__input" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
        <p class="form__text">Gender</p>
        <div class="form__radio-block">
            <input type="radio" class="form__input" name="gender" value="Male" <?php if ($gender === 'Male') echo 'checked'; ?> required>
            <label for="Male">Male</label>
        </div>
        <div class="form__radio-block">
            <input type="radio" class="form__input" name="gender" value="Female" <?php if ($gender === 'Female') echo 'checked'; ?> required>
            <label for="Female">Female</label>
        </div>
        <p class="form__text">Birthdate</p>
        <input type="date" class="form__input" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" required>
        <p class="form__text">Role</p>
        <div class="form__radio-block">
            <input type="radio" class="form__input" name="role" value="User" <?php if ($role === 'User') echo 'checked'; ?> required>
            <label for="User">User</label>
        </div>
        <div class="form__radio-block">
            <input type="radio" class="form__input" name="role" value="Admin" <?php if ($role === 'Admin') echo 'checked'; ?> required>
            <label for="Admin">Admin</label>
        </div>
        <button class="form__button btn" name="edit">Update</button>
    </form>
</div>
</body>
</html>
