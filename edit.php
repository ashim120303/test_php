<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/add-user.css">
</head>
<body>
<div class="wrapper">
    <?php
    include 'db.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM user WHERE id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        if (!$user) {
            die("User not found.");
        }

        // Данные пользователя
        $username = $user->username;
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $gender = $user->gender;
        $birthdate = $user->birthdate;
    }
    ?>

    <form action="foo.php?id=<?php echo $id; ?>" method="post" class="form">
        <p class="form__text">Имя пользователя</p>
        <input type="text" class="form__input" name="username" value="<?php echo $username; ?>" required>
        <p class="form__text">Новый пароль</p>
        <input type="password" class="form__input" name="new_password">
        <p class="form__text">Имя</p>
        <input type="text" class="form__input" name="first_name" value="<?php echo $first_name; ?>" required>
        <p class="form__text">Фамилия</p>
        <input type="text" class="form__input" name="last_name" value="<?php echo $last_name; ?>" required>
        <p class="form__text">Пол</p>
        <div class="form__radio-block">
            <input type="radio" class="form__input" name="gender" value="male" <?php if ($gender === 'male') echo 'checked'; ?> required>
            <label for="Male">Male</label>
        </div>
        <div class="form__radio-block">
            <input type="radio" class="form__input" name="gender" value="female" <?php if ($gender === 'female') echo 'checked'; ?> required>
            <label for="Female">Female</label>
        </div>

        <p class="form__text">Дата рождения</p>
        <input type="date" class="form__input" name="birthdate" value="<?php echo $birthdate; ?>" required>
        <button class="form__button btn" name="edit">Обновить</button>
    </form>
</div>
</body>
</html>
