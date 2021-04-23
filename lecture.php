<?php
session_start();
include ("bd.php");
mysqli_query($GLOBALS['db'], "ALTER TABLE topics AUTO_INCREMENT = 0");
mysqli_query($GLOBALS['db'], "ALTER TABLE lectures AUTO_INCREMENT = 0");
?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('head.php') ?>
  <title>Личный кабинет | Лекции</title>
</head>

<body>
  <?php include('headerAdmin.php') ?>
  <section class="slice bg-section-secondary">
    <div class="content will-help-you">
      <div class="container">
        <div class="row">
          <?php $query = "SELECT * FROM lectures";
          //Делаем запрос к БД, результат запроса пишем в $result:
          $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

          if ($result) {
            $rows = mysqli_num_rows($result); // количество полученных строк

            echo "
                    <div class = 'container-fluid p-0'>
                    <div class = 'table-responsive-md'>
                    <h4 style = 'margin-top: 40px; margin-top: 20px;'>Разделы:</h4>
                    <ol>";
            while ($row = mysqli_fetch_array($result)) {
              echo "<li>" . $row['theme'] . "</li>";
              if ($row["idlectures"] != null) {
                $query2 = "SELECT * FROM topics WHERE idlectures = " . $row['idlectures'] . "";
                $result2 = mysqli_query($GLOBALS['db'], $query2);
                echo "<ul>";
                while ($row2 = mysqli_fetch_array($result2)) {
                  echo "<li><a href = 'file.php?idlectures=" . $row['idlectures'] . "'>" . $row2['nametopic'] . "</a></li>";
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
        <h4 style="margin-top: 40px; margin-top: 20px;">Удаление раздела:</h4>
        <div class="w-50 position-relative">
          <form class="form-validate" method="post">
            <div class="form-group">
              <label class="form-label" for="theme">Выберите раздел, который хотите удалить:</label>
              <select class="custom-select" name="deletetype">
                <?php $query = "SELECT * FROM lectures";
                //Делаем запрос к БД, результат запроса пишем в $result:
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result); // количество полученных строк
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idlectures'] . ">" . $row['theme'] . "</p>";
                  }
                  // очищаем результат
                  mysqli_free_result($result);
                }
                ?>
              </select>
            </div>
            <button class="btn btn-primary" name="deleteButton" id="deleteButton" type="submit">Удалить</button>
          </form>
        </div>
        <?php
        if (isset($_POST["deleteButton"])) {
          if (!empty($_POST['deletetype'])) {
            $query = "DELETE FROM lectures WHERE idlectures =" . $_POST['deletetype'] . "";
            $result = mysqli_query($GLOBALS["db"], $query);

            if ($result)
              echo "<div class=\"alert alert-success alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Запись успешно удалена!</div>";
            else {
              echo "<div class=\"alert alert-danger alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Ошибка выполнения...</div>";
            }
          } else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
        }
        ?>
        <h4 style="margin-top: 40px; margin-top: 20px;">Удаление темы:</h4>
        <div class="w-50 position-relative">
          <form class="form-validate" method="post">
            <div class="form-group">
              <label class="form-label" for="idtopics">Выберите тему, которую хотите удалить:</label>
              <select class="custom-select" name="deleteterm">
                <?php $query = "SELECT * FROM topics";
                //Делаем запрос к БД, результат запроса пишем в $result:
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result); // количество полученных строк
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idtopics'] . ">" . $row['nametopic'] . "</p>";
                  }
                  // очищаем результат
                  mysqli_free_result($result);
                }
                ?>
              </select>
            </div>
            <button class="btn btn-primary" name="deleteButton2" id="deleteButton2" type="submit">Удалить</button>
          </form>
        </div>
        <?php
        if (isset($_POST["deleteButton2"])) {
          if (!empty($_POST['deleteterm'])) {
            $query = "DELETE FROM topics WHERE idtopics =" . $_POST['deleteterm'] . "";
            echo $query;
            $result = mysqli_query($GLOBALS["db"], $query);
            if ($result)
              echo "<div class=\"alert alert-success alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Запись успешно удалена!</div>";
            else {
              echo "<div class=\"alert alert-danger alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Ошибка выполнения...</div>";
            }
          } else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
        }
        ?>
        <h4 style="margin-top: 40px; margin-top: 20px;">Редактирование раздела:</h4>
        <div class="w-50 position-relative">
          <form class="form-validate" method="post">
            <div class="form-group">
              <label class="form-label" for="theme">Выберите раздел, который хотите изменить:</label>
              <select class="custom-select" name="editterm">
                <?php $query = "SELECT * FROM lectures";
                //Делаем запрос к БД, результат запроса пишем в $result:
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result); // количество полученных строк
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idlectures'] . ">" . $row['theme'] . "</p>";
                  }
                  // очищаем результат
                  mysqli_free_result($result);
                }
                ?>
              </select>
              <label class="form-label" for="theme">Новый раздел:</label><input class="form-control" name="theme" id="theme" type="text" placeholder="Модели" autocomplete="off" required="" data-msg="Пожалуйста введите новый вопрос">
            </div><button class="btn btn-primary" name="editButton" id="editButton" type="submit">Обновить</button>
          </form>
        </div>
        <?php
        if (isset($_POST['editButton'])) {
          if (!$_POST["editterm"]) {
            echo "Вы не ввели критерии поиска. Вернитесь назад и попробуйте еще раз";
            exit();
          }
          $query = "UPDATE lectures SET theme = '" . $_POST["theme"] . "' WHERE idlectures = '" . $_POST["editterm"] . "'";
          $result = mysqli_query($GLOBALS["db"], $query);
          if (!$result) echo ("Ошибка выполнения");
          else echo ("Запись успешно изменена");
        }
        ?>
        <h4 style="margin-top: 40px; margin-top: 20px;">Редактирование темы:</h4>
        <div class="w-50 position-relative">
          <form class="form-validate" method="post">
            <div class="form-group">
              <label class="form-label" for="nametopic">Выберите тему, которую хотите изменить:</label>
              <select class="custom-select" name="edittype">
                <?php $query = "SELECT * FROM topics";
                //Делаем запрос к БД, результат запроса пишем в $result:
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result); // количество полученных строк
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idtopics'] . ">" . $row['nametopic'] . "</p>";
                  }
                  // очищаем результат
                  mysqli_free_result($result);
                }
                ?>
              </select>
              <label class="form-label" for="nametopic">Новая тема:</label><input class="form-control" name="nametopic" id="nametopic" type="text" placeholder="Модели" autocomplete="off" required="" data-msg="Пожалуйста введите новый вопрос">
            </div><button class="btn btn-primary" name="editButton2" id="editButton2" type="submit">Обновить</button>
          </form>
        </div>
        <?php
        if (isset($_POST['editButton2'])) {
          if (!$_POST["edittype"]) {
            echo "Вы не ввели критерии поиска. Вернитесь назад и попробуйте еще раз";
            exit();
          }
          $query = "UPDATE topics SET nametopic = '" . $_POST["nametopic"] . "' WHERE idtopics = '" . $_POST["edittype"] . "'";
          $result = mysqli_query($GLOBALS["db"], $query);
          if (!$result) echo ("Ошибка выполнения");
          else echo ("Запись успешно изменена");
        }
        ?>
        <h4 style="margin-top: 40px; margin-top: 20px;">Добавление лекции:</h4>
        <div class="w-50 position-relative">
          <form class="form-validate" method="post">
            <div class="form-group">
              <select class="custom-select" name="addtype">
                <?php $query = "SELECT * FROM lectures";
                //Делаем запрос к БД, результат запроса пишем в $result:
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result); // количество полученных строк
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idlectures'] . ">" . $row['theme'] . "</p>";
                  }
                  // очищаем результат
                  mysqli_free_result($result);
                }
                ?>
              </select>
              <label class="form-label" for="nametopic">Название темы:</label><input class="form-control" name="nametopic" id="nametopic" type="text" placeholder="Матричные игры" autocomplete="off" required="" data-msg="Пожалуйста введите новую тему">
              <div class="custom-file mt-3">
                <input type="file" class="custom-file-input" name="file" id="filename" />
                <label class="custom-file-label" data-browse="Выбрать" for="filename">Файл не выбран</label>
              </div>
              <script type="text/javascript">
                $('.custom-file input').change(function(e) {
                  var files = [];
                  for (var i = 0; i < $(this)[0].files.length; i++) {
                    files.push($(this)[0].files[i].name);
                  }
                  $(this).next('.custom-file-label').html(files.join(', '));
                });
              </script>
            </div><button class="btn btn-primary" name="addButton" id="addButton" type="submit">Добавить</button>
          </form>
        </div>
        <?php
        if (isset($_POST['addButton'])) {
          if (!$_POST["nametopic"]) {
            echo "Вы не ввели критерии поиска. Вернитесь назад и попробуйте еще раз";
            exit();
          }
          $query = "INSERT INTO topics (idtopics, idlectures, nametopic, file)
            VALUES (NULL, '" . $_POST['addtype'] . "', '" . $_POST['nametopic'] . "', '" . $_POST['file'] . "');";
          $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
          if ($result) {
            echo "Успешно созданы новые записи";
          } else {
            echo "Ошибка: " . $query . "<br>" . $GLOBALS["db"]->error;
          }
        }
        ?>
        <h4 style="margin-top: 40px; margin-top: 20px;">Добавление раздела:</h4>
        <div class="w-50 position-relative">
          <form class="form-validate" method="post">
            <div class="form-group">
              <label class="form-label" for="theme">Название раздела:</label><input class="form-control" name="theme" id="theme" type="text" placeholder="Матричные игры" autocomplete="off" required="" data-msg="Пожалуйста введите новый раздел">
            </div>
            <button class="btn btn-primary" name="addButton2" id="addButton2" type="submit">Добавить</button>
          </form>
        </div>
        <?php
        if (isset($_POST['addButton2'])) {
          if (!$_POST["theme"]) {
            echo "Вы не ввели критерии поиска. Вернитесь назад и попробуйте еще раз";
            exit();
          }
          $query = "INSERT INTO lectures (idlectures, theme) VALUES (NULL, '" . $_POST['theme'] . "');";
          $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));
          if ($result) {
            echo "Успешно созданы новые записи";
          } else {
            echo "Ошибка: " . $query . "<br>" . $GLOBALS["db"]->error;
          }
        }
        ?>
      </div>
    </div>
  </section>
</body>

</html>