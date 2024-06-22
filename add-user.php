<?php require 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/add-user.css">
</head>
<body>
<div class="wrapper">
    <form action="foo.php" method="post" class="form">
        <p class="form__text">Имя пользователя</p>
        <input type="text" class="form__input" name="username" required>

        <p class="form__text">Пароль</p>
        <input type="password" class="form__input" name="password" required>

        <p class="form__text">Имя</p>
        <input type="text" class="form__input" name="first_name" required>

        <p class="form__text">Фамилия</p>
        <input type="text" class="form__input" name="last_name" required>

        <p class="form__text">Пол</p>
        <div class="form__radio-block">
            <input type="radio" id="male" class="form__input" name="gender" value="Male" required>
            <label for="male">Male</label>
        </div>
        <div class="form__radio-block">
            <input type="radio" id="female" class="form__input" name="gender" value="Female" required>
            <label for="female">Female</label>
        </div>

        <p class="form__text">Дата рождения</p>
        <input type="date" class="form__input" name="birthdate" required>

        <p class="form__text">Права</p>
        <div class="form__radio-block">
            <input type="radio" id="admin" class="form__input" name="role" value="Admin" required>
            <label for="admin">Admin</label>
        </div>
        <div class="form__radio-block">
            <input type="radio" id="user" class="form__input" name="role" value="User" required>
            <label for="user">User</label>
        </div>

        <button class="form__button btn" name="add">Добавить</button>
    </form>
</div>
</body>
</html>
