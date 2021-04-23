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
                    <div class="container-fluid p-0">
                        <div class="student-profile__right">
                            <div class="center-cont">
                                <div class="card-body" id="user-avatar" name="upload" area-label="user avatar" style="background: url('<?php echo "avatar.php"; ?>') center center/cover">
                                    <input id="upload" type="file" accept="image/*">
                                    <label for="upload" onClick="renderAvatar();">
                                        <span role="button" id="label" tabindex="0" aria-label="upload user profile">🡇</span>
                                    </label>
                                    <input class="dataup-label" id="dataup-label" type="text" data-browse="Выбрать" name="avatar">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" name="saveButton" id="saveButton" type="submit">add avatar</button>
                    </div>
                    <?php
                    if (isset($_POST['saveButton'])) {
                        if (!$_POST["dataup"]) {
                            echo "Вы не добавлили аватар";
                            exit();
                        }
                        $query = "INSERT INTO `users` (idusers, avatar) VALUES ('" . $_SESSION['idusers'] . "', '" . $_POST['avatar'] . "');";
                        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
                        echo $query;
                        if ($result) {
                            echo "Успешно добавлен аватар";
                        } else {
                            echo "Ошибка: " . $query . "<br>" . $GLOBALS["db"]->error;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>
    </section>
</body>

</html>