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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
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
              <li class="nav-item"><a class="nav-link" href="lecture.php">Лекции</a></li>
              <li class="nav-item"><a class="nav-link" href="tests.php">Тесты</a></li>
              <li class="nav-item"><a class="nav-link" href="testResult.php">Результаты тестов</a></li>
               <li class="nav-item"><a class="btn btn-primary" href="logout.php">Выйти</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- /Navbar -->
      <section class="slice bg-section-secondary">
        <div class="content will-help-you">
          <div class="container">
            <div class="row">
              <h2 class="display-5 text-shadow font-weight-bold" style = "margin-bottom: 50px; color:#00090b;">Добро пожаловать в личный кабинет!</h2>
              <ul class="large-list">
              <li>На данной странице Вы можете изменить логин, пароль и почту</li>
              <li>Нажав на пункты верхего меню, Вы сможете прочитать лекции, пройти тесты или же просмотреть свои результаты</li>
              <li>Так же всегда можете выйти из кабинета</li>
              </ul>
           </div>
          </div>
      </div>
    </section>
</body>
</html>
