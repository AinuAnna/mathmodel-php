<?php
session_start();
include ("bd.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php') ?>
    <title>Кабинет преподавателя | Профиль</title>
</head>

<body>
    <header class="header">
        <!-- Navbar-->
        <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
            <div class="container-fluid">
                <div class="d-flex align-items-center"><a class="navbar-brand py-1" href="main.php">
                        <img src="./assets/math.svg" width=30px style="margin-right: 21px;" alt="logo">Математическое моделирование</a>
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
                <div class="row" style="flex-direction: column; align-items: center;">
                    <h2 class="display-5 text-shadow font-weight-bold" style="margin-bottom: 50px; color:#00090b;">Добро пожаловать в кабинет преподавателя!</h2>
                    <?php include('profile.php')?>
                </div>
            </div>
        </div>
        </div>
    </section>
</body>

</html>