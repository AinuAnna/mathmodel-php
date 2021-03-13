<?php
    session_start();
    include ("bd.php");
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
    <title>Личный кабинет</title>
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
            <li class="nav-item"><a class="nav-link" href="admin.php">Профиль</a></li>
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
              <h2 class="display-5 text-shadow font-weight-bold" style = "margin-bottom: 50px; color:#00090b;">Добро пожаловать в личный кабинет администратора!</h2>
              <?php $query = "SELECT * FROM users";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    
                    echo "
                    <div class = 'container-fluid p-0'>
                    <div class = 'table-responsive-md'>
                    <table class = 'table'>
                    <tr><th>Идентификатор</th><th>Имя</th><th>Почта</th><th>Пароль</th><th>Роль</th></tr>";
                    for ($i = 0 ; $i < $rows ; ++$i)
                    {
                        $row = mysqli_fetch_row($result);
                        echo "<tr>";
                            for ($j = 0 ; $j < 5 ; ++$j) echo "<td>$row[$j]</td>";
                        echo "</tr>";
                    }
                    echo "</table>
                    </div>
                    </div>";
                    // очищаем результат
                    mysqli_free_result($result);
                }
                ?>         
           </div>
           <label class="form-label" for="idusers">Идентификатор пользователя:</label>
           <form class="form-validate" method="post">
                <input class="delete-id" name="idusers" id="idusers" type="text" placeholder="1" autocomplete="off" required="" data-msg="Пожалуйста введите идентификатор">
              <button class="btn btn-primary" name = "deleteButton" id = "deleteButton" type = "submit">Удалить</button>
            </form>
            <?php
            if(isset($_POST["deleteButton"])){     
            if(!empty($_POST['idusers'])) {
             $idusers= htmlspecialchars($_POST['idusers']);
             $query="DELETE FROM users WHERE idusers ='$idusers';";
             $result=mysqli_query($GLOBALS["db"], $query);
             if ($result)
             echo "<div class=\"alert alert-success alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Запись успешно удалена!</div>";
             else { echo "<div class=\"alert alert-danger alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Ошибка выполнения...</div>";
             }
            }
             else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
            }
            ?>
      </div>
      </div>
    </section>
    </body>
    </html>