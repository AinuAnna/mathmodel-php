<?php
session_start();
include("bd.php");
include("confirm.php");
mysqli_query($GLOBALS['db'], "ALTER TABLE topics AUTO_INCREMENT = 0");
mysqli_query($GLOBALS['db'], "ALTER TABLE lectures AUTO_INCREMENT = 0");
?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<script type='text/javascript'>
  document.addEventListener('DOMContentLoaded', function() {
    window.setTimeout(document.querySelector('svg').classList.add('animated'), 1000);
  })
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('head.php') ?>
  <?php if ($_SESSION['roleid'] == 1) {
    echo ' <title>Панель администратора | Лекции</title>';
  } else {
    echo ' <title>Кабинет преподавателя | Лекции</title>';
  } ?>
</head>

<body>
  <?php if ($_SESSION['roleid'] == 1) {
    include('headerAdmin.php');
  } else {
    include('headerTeacher.php');
  } ?>
  <div class="content will-help-you">
    <div class="container">
      <div class="row" style="flex-direction: column; margin-bottom: 6rem;">
        <?php $query = "SELECT * FROM lectures";
        $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

        if ($result) {
          $rows = mysqli_num_rows($result);

          echo "
            <div style = 'height: 30rem;'>
            <div class=' position-relative'>
            <h2 class='display-5 text-shadow font-weight-bold' style='margin-bottom: 50px; color:#00090b; margin-bottom: 3rem;'>
            Лекции</h2>
            <div class = 'table-responsive-md' style = 'max-width: 30rem;'>
                    <ol>";
          while ($row = mysqli_fetch_array($result)) {
            echo "<li>" . $row['theme'] . "</li>";
            if ($row["idlectures"] != null) {
              $query2 = "SELECT * FROM topics WHERE idlectures = " . $row['idlectures'] . "";
              $result2 = mysqli_query($GLOBALS['db'], $query2);
              echo "<ul>";
              while ($row2 = mysqli_fetch_array($result2)) {
                echo "<li><a href = 'file.php?idtopics=" . $row2['idtopics'] . "'>" . $row2['nametopic'] . "</a></li>";
              }
              echo "</ul>";
            }
          }
          echo "</ol>
            <div class='position-absolute d-md-block image-container' style = 'top: 0; right: 0;'>
              <img alt='lecture image' src='../assets/mathematics-animate.svg' style = 'width: 40rem !important;'>
            </div>
          </div>
         </div>
       </div>";
          mysqli_free_result($result);
        }
        ?>
      </div>
      <div class="row" style="flex-direction: column; align-items: center;">
        <h4 style="margin-top: 40px; margin-top: 20px;">Удаление раздела:</h4>
        <div class="w-100">
          <form class="form-validate" method="post" onsubmit="return confirmDesactiv()">
            <div class="form-group">
              <label class="form-label" for="theme">Выберите раздел, который хотите удалить:</label>
              <select class="custom-select" name="deletetype">
                <?php $query = "SELECT * FROM lectures";
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result);
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idlectures'] . ">" . $row['theme'] . "</p>";
                  }
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
            include("notification.php");
          } else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
        }
        ?>
        <h4 style="margin-top: 40px; margin-top: 20px;">Удаление темы:</h4>
        <div class="w-100">
          <form class="form-validate" method="post" onsubmit="return confirmDesactiv()">
            <div class="form-group">
              <label class="form-label" for="idtopics">Выберите тему, которую хотите удалить:</label>
              <select class="custom-select" name="deleteterm">
                <?php $query = "SELECT * FROM topics";
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result);
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idtopics'] . ">" . $row['nametopic'] . "</p>";
                  }
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
            include("notification.php");
          } else echo "<div class=\"alert alert-warning alert-dismissible text-center\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Все поля должны быть заполнены!</div>";
        }
        ?>
        <h4 style="margin-top: 40px; margin-top: 20px;">Редактирование раздела:</h4>
        <div class="w-100">
          <form class="form-validate" method="post" onsubmit="return confirmEdit()">
            <div class="form-group">
              <label class="form-label" for="theme">Выберите раздел, который хотите изменить:</label>
              <select class="custom-select" name="editterm">
                <?php $query = "SELECT * FROM lectures";
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result);
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idlectures'] . ">" . $row['theme'] . "</p>";
                  }
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
          include("notification.php");
        }
        ?>
        <h4 style="margin-top: 40px; margin-top: 20px;">Редактирование темы:</h4>
        <div class="w-100">
          <form class="form-validate" method="post" onsubmit="return confirmEdit()">
            <div class="form-group">
              <label class="form-label" for="nametopic">Выберите тему, которую хотите изменить:</label>
              <select class="custom-select" name="edittype">
                <?php $query = "SELECT * FROM topics";
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result);
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idtopics'] . ">" . $row['nametopic'] . "</p>";
                  }
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
          include("notification.php");
        }
        ?>
        <h4 style="margin-top: 40px; margin-top: 20px;">Добавление лекции:</h4>
        <div class="w-100">
          <form class="form-validate" method="post" onsubmit="return confirmActiv()" enctype="multipart/form-data">
            <div class="form-group">
              <label class="form-label" for="addtype">Выберите название раздела:</label>
              <select class="custom-select" name="addtype">
                <?php $query = "SELECT * FROM lectures";
                $result = mysqli_query($GLOBALS['db'], $query) or die(mysqli_error($GLOBALS['db']));

                if ($result) {
                  $rows = mysqli_num_rows($result);
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<p><option value = " . $row['idlectures'] . ">" . $row['theme'] . "</p>";
                  }
                  mysqli_free_result($result);
                }
                ?>
              </select>
              <label class="form-label" for="nametopic">Название темы:</label><input class="form-control" name="nametopic" id="nametopic" type="text" placeholder="Матричные игры" autocomplete="off" required="" data-msg="Пожалуйста введите новую тему">
              <div class="custom-file mt-3" style="margin-bottom: 1rem;">
                <label for="file-upload" class="custom-file-upload">
                  Загрузите лекцию
                </label>
                <input type="file" id="file-upload" name="uploaded_file" accept="application/pdf" multiple><span id="nameFile"></span><br>
              </div><button class="btn btn-primary" name="addButton" id="addButton" type="submit">Добавить</dutton>
          </form>
          <script>
            $("#file-upload").change(function() {
              var filename = $(this).val().replace(/.*\\/, "");
              $("#nameFile").text(filename);
            });
          </script>
        </div>
      </div>
      <?php
      // Check if a file has been uploaded
      if (isset($_POST['addButton'])) {
        // Make sure the file was sent without errors
        if ($_FILES['uploaded_file']['error'] == 0) {
          $name = $GLOBALS['db']->real_escape_string($_FILES['uploaded_file']['name']);
          $mime = $GLOBALS['db']->real_escape_string($_FILES['uploaded_file']['type']);
          $data = $GLOBALS['db']->real_escape_string(file_get_contents($_FILES['uploaded_file']['tmp_name']));
          $size = intval($_FILES['uploaded_file']['size']);

          // Create the SQL query
          $query = "INSERT INTO topics (idtopics, idlectures, nametopic, file)
                VALUES (NULL, '" . $_POST['addtype'] . "', '" . $_POST['nametopic'] . "', ' $data ');";

          // Execute the query
          $result = $GLOBALS['db']->query($query);
          include("notification.php");
        } else {
          echo 'An error accured while the file was being uploaded. '
            . 'Error code: ' . intval($_FILES['uploaded_file']['error']);
        }

        // Close the mysql connection
        $GLOBALS['db']->close();
      }
      ?>
      <h4 style="margin-top: 40px; margin-top: 20px;">Добавление раздела:</h4>
      <div class="w-100">
        <form class="form-validate" method="post" onsubmit="return confirmActiv()">
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
        include("notification.php");
      }
      ?>
    </div>
  </div>
  </div>
  </section>
</body>

</html>