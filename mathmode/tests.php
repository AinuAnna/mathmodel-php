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
    <script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <title>Личный кабинет | Тесты</title>
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
      </header>
      <!-- /Navbar -->
      <section class="slice bg-section-secondary">
        <div class="content will-help-you">
          <div class="container">
            <div class="row">
              <?php $query = "SELECT * FROM tests";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    
                    echo "
                    <div class = 'container-fluid p-0'>
                    <div class = 'table-responsive-md'>
                    <h4 style = 'margin-top: 40px; margin-top: 20px;'>Тесты:</h4>
                    <ol>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<li><a href = 'testpage.php?idtests=".$row['idtests']."'>".$row['testtitle']."</a></li>";
                    }
                    echo "</ul>
                    </div>
                    </div>";
                    // очищаем результат
                    mysqli_free_result($result);
                }
                ?>         
           </div>
           </header>
           <h4 style = "margin-top: 40px; margin-top: 20px;">Удаление теста:</h4>
           <div class="w-50 position-relative">
           <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="testtitle">Выберите тест, который хотите удалить:</label>
            <select class="custom-select" name = "deletetype">
            <?php $query = "SELECT * FROM tests";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    while($row = mysqli_fetch_array($result))
                    {
                            echo "<p><option value = ".$row['testtitle'].">".$row['testtitle']."</p>";
                    }
                    // очищаем результат
                    mysqli_free_result($result);
                }
                ?>         
            </select>    
        </div>
            <button class="btn btn-primary" name = "deleteButton" id = "deleteButton" type = "submit">Удалить</button>
            </form>
            </div>
            <?php
            if(isset($_POST["deleteButton"])){     
            if(!empty($_POST['deletetype'])) {
             $deletetype= htmlspecialchars($_POST['deletetype']);
             $query="DELETE FROM lectures WHERE theme ='$deletetype'";
             $result=mysqli_query($GLOBALS["db"], $query);
             
             if ($result)
             echo "<div class=\"alert alert-success alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Запись успешно удалена!</div>";
             else { echo "<div class=\"alert alert-danger alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Ошибка выполнения...</div>";
             }
            }
             else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
            }
            ?>
             <h4 style = "margin-top: 40px; margin-top: 20px;">Удаление вопроса:</h4>
           <div class="w-50 position-relative">
           <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="questiontext">Выберите вопрос, который хотите удалить:</label>
           <select class="custom-select" name = "deleteterm">
            <?php $query = "SELECT * FROM questions";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    while($row = mysqli_fetch_array($result))
                    {
                            echo "<p><option value = ".$row['questiontext'].">".$row['questiontext']."</p>";
                    }
                    // очищаем результат
                    mysqli_free_result($result);
                }
                ?>         
            </select>    
        </div>
            <button class="btn btn-primary" name = "deleteButton2" id = "deleteButton2" type = "submit">Удалить</button>
            </form>
            </div>
            <?php
            if(isset($_POST["deleteButton2"])){     
            if(!empty($_POST['deleteterm'])) {
             $deleteterm= htmlspecialchars($_POST['deleteterm']);
             $query="DELETE FROM topics WHERE nametopic ='$deleteterm'";
             $result=mysqli_query($GLOBALS["db"], $query);
             if ($result)
             echo "<div class=\"alert alert-success alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Запись успешно удалена!</div>";
             else { echo "<div class=\"alert alert-danger alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Ошибка выполнения...</div>";
             }
            }
             else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
            }
            ?>
             <h4 style = "margin-top: 40px; margin-top: 20px;">Редактирование вопроса:</h4>
             <div class="w-50 position-relative">
           <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="questiontext">Выберите вопрос, который хотите обновить:</label>
           <select class="custom-select" name = "edittype">
            <?php $query = "SELECT * FROM questions";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    while($row = mysqli_fetch_array($result))
                    {
                            echo "<p><option value = ".$row['idquestions'].">".$row['questiontext']."</p>";
                    }
                    // очищаем результат
                    mysqli_free_result($result);
                }
                ?>         
            </select>  
            <label class="form-label" for="questiontext">Новый вопрос:</label><input class="form-control" name="questiontext" id="questiontext" type="text" placeholder="Модель - это" autocomplete="off" required="" data-msg="Пожалуйста введите новый вопрос">
        </div>
        </div>
            <button class="btn btn-primary" name = "editButton" id = "editButton" type = "submit">Обновить</button>
            </form>
        <?php 
        if(isset($_POST['editButton'])){
            if (!$_POST["edittype"]) {
                echo "Вы не ввели критерии поиска. Вернитесь назад и попробуйте еще раз"; exit();
                }
            $query = "UPDATE questions SET questiontext = '".$_POST["questiontext"]."' WHERE idquestions = '".$_POST["edittype"]."'";
            $result = mysqli_query($GLOBALS["db"], $query);
            if(!$result) echo("Ошибка выполнения"); else echo("Запись успешно изменена");
        }
        ?>
    </section>
      </body>
</html>