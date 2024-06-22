<?php
session_start(); // Обязательно начинаем сессию в начале файла

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    // Если не авторизован, перенаправляем на страницу авторизации
    header('Location: login.html');
    exit();
}

// Обработка выхода (logout)
if (isset($_POST['logout'])) {
    // Очищаем сессионные переменные
    session_unset();
    session_destroy();
    // Перенаправляем на страницу авторизации после выхода
    header('Location: login.html');
    exit();
}
?>
<?php include "foo.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="header__container">
            <form method="post" action="">
                <button type="submit" name="logout" class="header__item">Logout</button>
            </form>
            <a href="add-user.php" class="header__item">Добавить пользоватля</a>
        </div>
    </header>
    <main class="main">
        <div class="filter">
            <form method="get" action="">
                <div class="filter__item search">
                    <div for="username_search">Поиск по логину:</div>
                    <input type="text" name="username_search" id="username_search" placeholder="Введите логин" value="<?php echo htmlspecialchars($_GET['username_search'] ?? '', ENT_QUOTES); ?>">
                </div>
                <div class="filter__container">
                    <div class="filter__item">
                        <select name="alphabet" id="alphabet">
                            <option value="" disabled selected hidden>По алфавиту</option>
                            <option value="ASC" <?php if (isset($_GET['alphabet']) && $_GET['alphabet'] == 'ASC') echo 'selected'; ?>>От A до Я</option>
                            <option value="DESC" <?php if (isset($_GET['alphabet']) && $_GET['alphabet'] == 'DESC') echo 'selected'; ?>>От Я до A</option>
                        </select>
                    </div>
                    <div class="filter__item">
                        <select name="gender" id="gender">
                            <option value="" disabled selected hidden>По полу</option>
                            <option value="Male" <?php if (isset($_GET['gender']) && $_GET['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if (isset($_GET['gender']) && $_GET['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                        </select>
                    </div>
                    <div class="filter__item">
                        <select name="role" id="role">
                            <option value="" disabled selected hidden>По правам</option>
                            <option value="User" <?php if (isset($_GET['role']) && $_GET['role'] == 'User') echo 'selected'; ?>>User</option>
                            <option value="Admin" <?php if (isset($_GET['role']) && $_GET['role'] == 'Admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="filter__container date">
                    <div class="filter__item">
                        <label for="birthdate_start">Дата рождения от:</label>
                        <input type="date" name="birthdate_start" id="birthdate_start" value="<?php echo htmlspecialchars($_GET['birthdate_start'] ?? '', ENT_QUOTES); ?>">
                    </div>
                    <div class="filter__item">
                        <label for="birthdate_end">Дата рождения до:</label>
                        <input type="date" name="birthdate_end" id="birthdate_end" value="<?php echo htmlspecialchars($_GET['birthdate_end'] ?? '', ENT_QUOTES); ?>">
                    </div>
                </div>
                <div class="filter__container">
                    <div class="filter__button">
                        <button type="submit">Применить фильтр</button>
                    </div>
                    <div class="filter__button">
                        <button type="button" onclick="resetFilters()">Сбросить фильтры</button>
                    </div>
                </div>

            </form>
        </div>

        <script>
            function resetFilters() {
                document.getElementById('alphabet').selectedIndex = 0;
                document.getElementById('gender').selectedIndex = 0;
                document.getElementById('role').selectedIndex = 0;
                document.getElementById('birthdate_start').value = '';
                document.getElementById('birthdate_end').value = '';
                document.getElementById('username_search').value = '';
                window.location.href = window.location.pathname;
            }
        </script>

        <div class="user">
            <?php foreach ($result as $res) { ?>
                <div class="user__item">
                    <div class="user__buttons">
                        <a href="edit.php?id=<?php echo $res->id; ?>"><img src="img/edit.svg" alt="edit" class="user__icon"></a>
                        <img src="img/trash-red.svg" alt="delete" class="user__icon" onclick="openModal('myModal-<?php echo $res->id; ?>')">

                        <!-- Модальное окно -->
                        <div id="myModal-<?php echo $res->id; ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('myModal-<?php echo $res->id; ?>')">&times;</span>
                                <p>Вы действительно хотите удалить пользователя: <?php echo $res->username; ?>?</p>
                                <form action="?id=<?php echo $res->id; ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo $res->id; ?>">
                                    <button type="submit" name="delete" class="modal-button">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="user__info">
                        id: <?php echo $res->id; ?>
                    </div>
                    <div class="user__info">
                        Логин: <?php echo $res->username; ?>
                    </div>
                    <div class="user__info">
                        Имя: <?php echo $res->first_name; ?>
                    </div>
                    <div class="user__info">
                        Фамилия: <?php echo $res->last_name; ?>
                    </div>
                    <div class="user__info">
                        Пол: <?php echo $res->gender; ?>
                    </div>
                    <div class="user__info">
                        Дата рождения: <?php echo $res->birthdate; ?>
                    </div>
                    <div class="user__info">
                        Права: <?php echo $res->role; ?>
                    </div>
                </div>
            <?php }?>
        </div>

        <div class="pagination">
            <div class="pagination__container">
                <div class="pagination__count">
                    <p>Показано записей: <?php echo count($result); ?></p>
                    <p>Всего записей: <?php echo $total_records; ?></p>
                </div>
                <div class="pagination__buttons">
                    <?php if ($page > 1): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" class="pagination__button">Назад</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" class="pagination__button <?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                    <?php if ($page < $total_pages): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" class="pagination__button">Вперёд</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>
  <script src="js/app.js"></script>
</body>
</html>