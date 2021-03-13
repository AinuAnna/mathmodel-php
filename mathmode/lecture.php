<?php
    session_start();
    include ("bd.php");
    mysqli_query($GLOBALS['db'], "ALTER TABLE topics AUTO_INCREMENT = 0");
    mysqli_query($GLOBALS['db'], "ALTER TABLE lectures AUTO_INCREMENT = 0");
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
    <title>Личный кабинет | Лекции</title>
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
              <?php $query = "SELECT * FROM lectures";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    
                    echo "
                    <div class = 'container-fluid p-0'>
                    <div class = 'table-responsive-md'>
                    <h4 style = 'margin-top: 40px; margin-top: 20px;'>Разделы:</h4>
                    <ol>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<li>".$row['theme']."</li>";
                        if($row["idlectures"] != null){
                            $query2 = "SELECT * FROM topics WHERE idlectures = ".$row['idlectures']."";
                            $result2 = mysqli_query($GLOBALS['db'], $query2);
                            echo "<ul>";
                            while($row2 = mysqli_fetch_array($result2)){
                                echo "<li><a href = 'file.php?idlectures=".$row['idlectures']."'>".$row2['nametopic']."</a></li>";
                            }
                            echo "</ul>";
                        }
                    }
                    echo "</ul>
                    </div>
                    </div>";
                    // очищаем результат
                    mysqli_free_result($result);
                }
                ?>         
           </div>
           <h4 style = "margin-top: 40px; margin-top: 20px;">Удаление раздела:</h4>
           <div class="w-50 position-relative">
           <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="theme">Выберите раздел, который хотите удалить:</label>
            <select class="custom-select" name = "deletetype">
            <?php $query = "SELECT * FROM lectures";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    while($row = mysqli_fetch_array($result))
                    {
                            echo "<p><option value = ".$row['theme'].">".$row['theme']."</p>";
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
             <h4 style = "margin-top: 40px; margin-top: 20px;">Удаление темы:</h4>
           <div class="w-50 position-relative">
           <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="idtopics">Идентификатор темы:</label>
           <select class="custom-select" name = "deleteterm">
            <?php $query = "SELECT * FROM topics";
              //Делаем запрос к БД, результат запроса пишем в $result:
              $result = mysqli_query($GLOBALS['db'], $query) or die( mysqli_error($GLOBALS['db']));

                if($result)
                {
                    $rows = mysqli_num_rows($result); // количество полученных строк
                    while($row = mysqli_fetch_array($result))
                    {
                            echo "<p><option value = ".$row['nametopic'].">".$row['nametopic']."</p>";
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
             <h4 style = "margin-top: 40px; margin-top: 20px;">Редактирование раздела:</h4>
             <div class="w-50 position-relative">
           <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="idlectures">Идентификатор раздела:</label><input class="form-control" name="idlectures" id="idlectures" type="text" placeholder="1" autocomplete="off" required="" data-msg="Пожалуйста введите идентификатор раздела">
           <label class="form-label" for="theme">Название раздела:</label><input class="form-control" name="theme" id="theme" type="text" placeholder="Теория графов" autocomplete="off" required="" data-msg="Пожалуйста введите новое название">
           </div><button class="btn btn-primary" name = "editButton" id = "editButton" type = "submit">Обновить</button>
            </form>
        </div>
        <?php 
        if(isset($_POST['editButton'])){
            if (!$_POST["idlectures"] || !$_POST["theme"]) {
                echo "Вы не ввели критерии поиска. Вернитесь назад и попробуйте еще раз"; exit();
                }
            $query = "UPDATE lectures SET theme = '".$_POST["theme"]."' WHERE idlectures = '".$_POST["idlectures"]."'";
            $result = mysqli_query($GLOBALS["db"], $query);
            if(!$result) echo("Ошибка выполнения"); else echo("Запись успешно изменена");
        }
        ?>
          <h4 style = "margin-top: 40px; margin-top: 20px;">Редактирование темы:</h4>
             <div class="w-50 position-relative">
           <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="idtopics">Идентификатор темы:</label><input class="form-control" name="idtopics" id="idtopics" type="text" placeholder="1" autocomplete="off" required="" data-msg="Пожалуйста введите идентификатор темы">
           <label class="form-label" for="nametopic">Название темы:</label><input class="form-control" name="nametopic" id="nametopic" type="text" placeholder="Определения" autocomplete="off" required="" data-msg="Пожалуйста введите новую тему">
           </div><button class="btn btn-primary" name = "editButton2" id = "editButton2" type = "submit">Обновить</button>
            </form>
        </div>
        <?php
        if(isset($_POST['editButton2'])){
            if (!$_POST["idtopics"] || !$_POST["nametopic"]) {
                echo "Вы не ввели критерии поиска. Вернитесь назад и попробуйте еще раз"; exit();
                }
            $query = "UPDATE topics SET nametopic = '".$_POST["nametopic"]."' WHERE idtopics = '".$_POST["idtopics"]."'";
            $result = mysqli_query($GLOBALS["db"], $query);
            if(!$result) echo("Ошибка выполнения"); else echo("Запись успешно изменена");
        }
         ?>
        <h4 style = "margin-top: 40px; margin-top: 20px;">Добавление лекции:</h4>
             <div class="w-50 position-relative">
           <form class="form-validate" method="post">
           <div class="form-group">
           <label class="form-label" for="idlectures">Идентификатор раздела:</label><input class="form-control" name="idlectures" id="idlectures" type="text" placeholder="1" autocomplete="off" required="" data-msg="Пожалуйста введите идентификатор раздела">
           <label class="form-label" for="theme">Название раздела:</label><input class="form-control" name="theme" id="theme" type="text" placeholder="Теория игр" autocomplete="off" required="" data-msg="Пожалуйста введите новое название">
           <label class="form-label" for="nametopic">Название темы:</label><input class="form-control" name="nametopic" id="nametopic" type="text" placeholder="Матричные игры" autocomplete="off" required="" data-msg="Пожалуйста введите новую тему">
           <div class="custom-file mt-3">
           <input type="file" class = "custom-file-input" name = "file" id="filename"/>
            <label class="custom-file-label" data-browse="Выбрать" for="filename">Файл не выбран</label>
            </div>
            <script type="text/javascript">
            $('.custom-file input').change(function (e) {
                var files = [];
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    files.push($(this)[0].files[i].name);
                }
                $(this).next('.custom-file-label').html(files.join(', '));
            });
            </script>
        </div><button class="btn btn-primary" name = "addButton" id = "addButton" type = "submit">Добавить</button>
           </form>
        </div>
        <?php
        if(isset($_POST['addButton'])){
            if (!$_POST["nametopic"]|| !$_POST["theme"]) {
                echo "Вы не ввели критерии поиска. Вернитесь назад и попробуйте еще раз"; exit();
                }
            $sql = "INSERT INTO topics (idtopics, idlectures, nametopic, file)
            VALUES (NULL, '".$_POST['idlectures']."', '".$_POST['nametopic']."', '".$_POST['file']."');";

            $sql .= "INSERT INTO lectures (idlectures, theme)
            VALUES (NULL, '".$_POST['theme']."');";

            if ($GLOBALS["db"]->multi_query($sql) === TRUE) {
                echo "Успешно созданы новые записи";
            } else {
               echo "Ошибка: " . $sql . "<br>" . $GLOBALS["db"]->error;
            }
        }
         ?>
      </div>
      </div>
    </section>
      </body>
</html>