<?php
    session_start();
    include ("bd.php");
    if(isset( $_POST["submit"])){
        $query = "insert into message(name, email, text) values('".$_POST["name"]."','".$_POST["email"]."','".$_POST["message"]."');";
        $result = mysqli_query($GLOBALS["db"], $query);
        if(!$result) echo("Ошибка выполнения"); else echo("Запись успешно добавлена");
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "./style.css">
    <link rel="shortcut icon" href="assets/math.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src = "./avatar.js"></script>
    <title>Личный кабинет | Профиль</title>
</head>
<body>
<header class="header">
      <!-- Navbar-->
      <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
        <div class="container-fluid">
          <div class="d-flex align-items-center"><a class="navbar-brand py-1" href="main.php">
           <img src="./assets/math.svg" width = 30px style = "margin-right: 21px;" alt="logo">Математическое моделирование</a>
          </div>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="student.php">Профиль</a></li>
              <li class="nav-item"><a class="nav-link" href="lectureStudent.php">Лекции</a></li>
              <li class="nav-item"><a class="nav-link" href="testsStudent.php">Тесты</a></li>
              <li class="nav-item"><a class="nav-link" href="result.php">Результаты тестов</a></li>
               <li class="nav-item"><a class="btn btn-primary" href="logout.php">Выйти</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- /Navbar -->
      </header>
      <section class="slice bg-section-secondary">
        <div class="content will-help-you">
          <div class="container">
            <div class="row" style = "flex-direction: column; align-items: center;">
             <h2 class="display-5 text-shadow font-weight-bold" style = "margin-bottom: 50px; color:#00090b;">Добро пожаловать в личный кабинет!</h2>
              <div class="container-fluid p-0">
               <div class="student-profile__right">
                <div class="center-cont">
                 <div class="card-body" id="user-avatar" area-label="user avatar">
                   <input id="upload" type="file" accept="image/*">
                   <label for="upload" onClick = "renderAvatar();">
                    <span role="button" tabindex="0" aria-label="upload user profile">🡇</span>
                    </label>
                  </div>
                </div>
             </div>
            </div>
           <div class="w-50 position-relative">
           <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="fullname">Имя пользователя: </label>
           <input class="form-control" name="fullname" id="fullname" type="text" placeholder="Анна Андреевна Терешко" autocomplete="on" required="" data-msg="Пожалуйста введите новое имя"/>
            </div>
            <button class="btn btn-primary" name = "editButton" id = "editButton" type = "submit">Изменить</button>
            </form>
            </div>
            <div class="w-50 position-relative">
            <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="email">Эл. Почта: </label>
           <input class="form-control" name="" id="email" type="email" placeholder="name@example.com" autocomplete="on" required="" data-msg="Пожалуйста введите новую почту"/>
        </div>
            <button class="btn btn-primary" name = "editButton" id = "editButton" type = "submit">Изменить</button>
            </form>
            </div>
            <div class="w-50 position-relative">
            <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="password1">Старый пароль: </label>
           <input class="form-control" name="password1" id="password1" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
           <label class="form-label" for="password2">Новый пароль: </label>
           <input class="form-control" name="password2" id="password2" type="password" autocomplete="off" required="" data-msg="Пожалуйста введите новый пароль">
        </div>
            <button class="btn btn-primary" name = "editButton" id = "editButton" type = "submit">Изменить</button>
            </form>
            </div>
            </div>
           </div>
          </div>
      </div>
    </section>
</body>
</html>
