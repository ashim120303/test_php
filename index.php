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
        <a href="auth.html"><div class="header__item">Выход</div></a>
        <a href="add-user.html" class="header__item">Добавить пользоватля</a>
      </div>
    </header>
    <main class="main">
      <div class="filter">
        <div class="filter__container">
          <div class="filter__genter">

          </div>
          <div class="filter__date"></div>
          <div class="filter__premissions">

          </div>
        </div>

      </div>
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
                      <p>Вы действительно хотите удалить пользователя <?php echo $res->username; ?>?</p>
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
            Права:
          </div>
        </div>
        <?php }?>
        </div>
    </main>
  </div>
  <script src="js/app.js"></script>
</body>
</html>